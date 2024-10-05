<html>
<head>
    <title>Complaint Registration</title>
    <link rel="stylesheet" href="complaint_register.css">
</head>
<body>
    <nav class="navbarcmpreg">
            <h1 class="navheadcmpreg">YOUR VOICE MATTERS!</h1>
            <ul class="navulcmpreg">
                <li><a class="navacmpre" href="home.html">Home</a></li>
                <li><a class="navacmpre" href="aboutvoice.html">About us</a></li>
                    <li><a class="navacmpre" href="contactvoice.html">Contact us</a></li>
                <li><a class="navacmpre" href="">Logout</a></li>   
            </ul>
     </nav>
    <div class="complaintregistercontainer">
        <form method="post" action="">
            <div class="complaintregisterform">
                <div class="complaintbody">
                    <h1 class="complaintregisterhead">Register Your Complaint Here!</h1>
                    <b>Name:</b><input class="complaintregistername" type="text" name="name" placeholder="Full Name" required>
                    <b>Email:</b><input class="complaintregistername" type="email" name="email"  required>
                    <b>Date Of Birth:</b><input class="complaintregistername" type="date" name="dob" required>
                    <b>Address:</b><textarea class="complaintregisterarea" name="address" rows="7" cols="50" required></textarea>
                    <b>Mobile:</b><input class="complaintregistername" type="number" name="mobile" required>
                    <label for="complaint"><b>Select Complaint:</b></label>
                    <select class="complaintregistername" name="complainttype" id="complainttype" required>
                        <option value="">

                        </option>
                        
                        <option value="Blackmail">Blackmail</option>
                        <option value="Threats">Threats</option>
                        <option value="Sexual Harassment">Sexual Harassment</option>
                        <option value="Domestic Violence">Domestic Violence</option>
                    </select>
                    <b>Date:</b><input class="complaintregistername" type="date" name="date" required>
                </div>
                <div class="complaintbody">
                    <h1></h1>
                    <b>Type Your Complaint Here:</b><textarea class="complaintregisterarea" name="complainttext" rows="8" cols="50" required></textarea> 
                    <b>Upload Photos:</b><input class="complaintregistername" type="file" name="photo">
                    <h3 class="complaintregistername">Suspect Details (if any)</h3>
                    <b>Name:</b><input class="complaintregistername" type="text" name="suspectname">
                    <b>Other Details (if any):</b><textarea class="complaintregisterarea" name="suspectdetail" rows="8" cols="50"></textarea>
                    <div class="voice-recording">
    <h3>Record Your Voice (Optional)</h3>
    <button type="button" id="recordButton">Start Recording</button>
    <button type="button" id="stopButton" disabled>Stop Recording</button>
    <audio controls id="audioPlayback" style="display:none;"></audio>
    <input type="hidden" name="voiceRecording" id="voiceRecording">
</div>
                    <input class="complaintregistersubmit" type="submit" name="register" value="Register">  
                </div>  
            </div>
        </form>
    </div>
    <script>
    let mediaRecorder;
    let audioChunks = [];

    document.getElementById("recordButton").addEventListener("click", async () => {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        mediaRecorder = new MediaRecorder(stream);
        mediaRecorder.start();

        mediaRecorder.ondataavailable = event => {
            audioChunks.push(event.data);
        };

        document.getElementById("stopButton").disabled = false;
        document.getElementById("recordButton").disabled = true;
    });

    document.getElementById("stopButton").addEventListener("click", () => {
        mediaRecorder.stop();
        mediaRecorder.onstop = () => {
            const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
            const audioUrl = URL.createObjectURL(audioBlob);
            document.getElementById("audioPlayback").src = audioUrl;
            document.getElementById("audioPlayback").style.display = "block";

            const reader = new FileReader();
            reader.onloadend = function () {
                document.getElementById("voiceRecording").value = reader.result;
            };
            reader.readAsDataURL(audioBlob);
        };
        audioChunks = [];
        document.getElementById("stopButton").disabled = true;
        document.getElementById("recordButton").disabled = false;
    });
</script>

</body>
</html>


<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "complainreg"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: ");
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $complaint_type = $_POST['complainttype'];
    $date = $_POST['date'];
    $complaint_detail = $_POST['complainttext'];
    $image = $_POST['photo'];
    $suspect_name = $_POST['suspectname'];
    $suspect_detail = $_POST['suspectdetail'];
    $email=$_POST['email'];
    $type=0;
    $voiceFilePath = '';
    if (!empty($_POST['voiceRecording'])) {
        $voiceRecording = $_POST['voiceRecording'];
        $voiceRecording = str_replace('data:audio/wav;base64,', '', $voiceRecording);
        $voiceRecording = base64_decode($voiceRecording);
        $voiceFilePath = 'uploads/audio/' . uniqid() . '.wav';
        file_put_contents($voiceFilePath, $voiceRecording);
    }

    $sql_complaints = "INSERT INTO `complaints`(`name`, `dob`, `address`, `phno`, `complaint_type`, `date`, `complaint_detail`, `photo`, `suspect_name`, `details`, `email`, `status`, `officerid`,`voice`) VALUES ('$name','$dob','$address','$mobile','$complaint_type','$date','$complaint_detail','$image','$suspect_name','$suspect_detail','$email'.'Pending','0','$voiceFilePath')";
    $data_complaints = mysqli_query($conn, $sql_complaints);

    $sql_users = "INSERT INTO `users`(`name`, `email`, `dob`, `address`, `phno`, `password`) VALUES ('$name','$email','$dob','$address','$mobile',$mobile)";
    $data_users = mysqli_query($conn, $sql_users);

    $sql_login = "INSERT INTO `login`(`email`, `password`, `usertype`) VALUES ('$email',$mobile,'$type')";
    $data_login = mysqli_query($conn, $sql_login);


    if($data_complaints && $data_users && $data_login){
        echo "<script>alert('Complaint Registered Successfully.  Use your Phone Number to Login to your account')</script>";
    }
}

$conn->close();
?>

