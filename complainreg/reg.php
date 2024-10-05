<!DOCTYPE html>
<html>
<head>
    <title>Complaint Register</title>
    <link rel="stylesheet" type="text/css" href="reg.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Add your CSS styles here for visibility and layout adjustments */
    </style>
</head>
<body>
    <nav>
        <div class="navlinks">
        <img src="./Assets/logowomen.png" alt="">
        <div class="Links">
        <ul>
                    <li><a href="home.html">HOME</a></li>
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="">ABOUT</a></li>
                    <li><a href="contactus.html">CONTACT</a></li>
                </ul>
               
        </div>
        </div>
    </nav>
    <div id="page" class="site">
        <div class="container">
            <div class="form-box">
                <div class="progress">
                    <div class="logo"><a href="/"><span>.let's</span>complaint</a></div>
                    <ul class="progress-steps">
                        <li class="step active">
                            <span>1</span>
                            <p>personal<br><span>enter the personal details</span></p>
                        </li>
                        <li class="step">
                            <span>2</span>
                            <p>complaint<br><span>enter the complaint details</span></p>
                        </li>
                        <li class="step">
                            <span>3</span>
                            <p>suspect<br><span>enter the suspect details</span></p>
                        </li>
                    </ul>
                </div>
                <form action="" method="post">
                    <div class="form-one form-step active">
                        <div class="bg-svg"></div>
                        <h2>Personal Information</h2>
                        <p>Enter your personal information correctly</p>
                        <div>
                            <label>Full name</label>
                            <input type="text" placeholder="e.g. Annmaria Josh" name="name" required>
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" placeholder="e.g. abcd@gmail.com" name="email"  >
                        </div>
                        <div class="birth">
                            <label>Date Of Birth</label>
                            <div>
                                <input type="date" name="dob" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>
                        <div>
                            <label>Address</label><br>
                            <textarea name="address" rows="7" cols="50" placeholder="e.g. house name, p.o, city"></textarea>
                        </div>
                        <div>
                            <label>Mobile</label>
                            <input type="text" placeholder="e.g. +91xxxxxxxxxx" name="mobile">
                        </div>
                    </div>
                    <div class="form-two form-step">
                        <div class="bg-svg"></div>
                        <h2>Complaint Details</h2>
                        <p>Enter the complaint details correctly</p>
                        <div>
                            <label>Select Complaint Type</label>
                            <select class="complaintregistername" name="complainttype" id="complainttype" required>
                                <option value=""> </option>
                                <option value="Blackmail">Blackmail</option>
                                <option value="Threats">Threats</option>
                                <option value="Sexual Harassment">Sexual Harassment</option>
                                <option value="Domestic Violence">Domestic Violence</option>
                            </select>
                        </div>
                        <div>
                            <label>Date</label>
                            <input type="date" name="date" placeholder="dd/mm/yyyy" required>
                        </div>
                        <div class="complaintbody">
                            <label>Type Your Complaint Here</label><br>
                            <textarea class="complaintregisterarea" name="complainttext" rows="8" cols="50" required></textarea>
                        </div>
                        <div>
                            <label>Upload Photos</label>
                            <input class="complaintregistername" type="file" name="photo">
                        </div>
                        <div class="voice-recording">
        <h3>Record Your Voice (Optional)</h3>
        <button type="button" id="recordButton">Start Recording</button>
        <button type="button" id="stopButton" disabled>Stop Recording</button>
        <audio controls id="audioPlayback" style="display:none;"></audio>
        <input type="hidden" name="voiceRecording" id="voiceRecording">
    </div>
                    </div>
                    <div class="form-three form-step">
                        <div class="bg-svg"></div>
                        <h2>Suspect Details</h2>
                        <p>Enter the suspect details</p>
                        <div>
                            <label>Name</label>
                            <input class="complaintregistername" type="text" name="suspectname">
                        </div>
                        <div>
                            <label>Other Details (if any)</label><br>
                            <textarea class="complaintregisterarea" name="suspectdetail" rows="8" cols="50"></textarea>
                        </div>

                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn-prev" disabled>Back</button>
                        <button type="button" class="btn-next">Next</button>
                        <button type="submit" class="btn-submit" style="display: none;" name="register">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formSteps = document.querySelectorAll('.form-step');
            const progressSteps = document.querySelectorAll('.progress-steps .step');
            const btnPrev = document.querySelector('.btn-prev');
            const btnNext = document.querySelector('.btn-next');
            const btnSubmit = document.querySelector('.btn-submit');
            
            let currentStep = 0;
            
            function updateFormSteps() {
                formSteps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });
                
                progressSteps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });
                
                btnPrev.disabled = currentStep === 0;
                btnNext.style.display = currentStep === formSteps.length - 1 ? 'none' : 'inline-block';
                btnSubmit.style.display = currentStep === formSteps.length - 1 ? 'inline-block' : 'none';
            }
            
            btnNext.addEventListener('click', () => {
                if (currentStep < formSteps.length - 1) {
                    currentStep++;
                    updateFormSteps();
                }
            });
            
            btnPrev.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateFormSteps();
                }
            });
            
            updateFormSteps(); 
        });
    </script>
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
        reader.onloadend = function() {
            document.getElementById("voiceRecording").value = reader.result;
        };
        reader.readAsDataURL(audioBlob);
    };
    audioChunks = [];
    document.getElementById("stopButton").disabled = true;
    document.getElementById("recordButton").disabled = false;
});

// New function to reset for re-recording
function resetRecording() {
    document.getElementById("audioPlayback").src = "";
    document.getElementById("audioPlayback").style.display = "none";
    audioChunks = []; // Clear previous audio chunks
}

// Add event listener to the record button to reset
document.getElementById("recordButton").addEventListener("click", resetRecording);

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
    $suspect_name = $_POST['suspectname'];
    $suspect_detail = $_POST['suspectdetail'];
    $email = $_POST['email'];
    $voiceFilePath = ''; // Initialize the variable

    if (!empty($_POST['voiceRecording'])) {
        $voiceRecording = $_POST['voiceRecording'];
        $voiceRecording = str_replace('data:audio/wav;base64,', '', $voiceRecording);
        $voiceRecording = base64_decode($voiceRecording);
        $voiceFilePath = 'uploads/audio/' . uniqid() . '.mp3'; 
        file_put_contents($voiceFilePath, $voiceRecording);
    }

    $sql_complaints = "INSERT INTO `complaints`(`name`, `dob`, `address`, `phno`, `complaint_type`, `date`, `complaint_detail`, `photo`, `suspect_name`, `details`, `email`, `status`, `officerid`, `voice`) 
    VALUES ('$name','$dob','$address','$mobile','$complaint_type','$date','$complaint_detail','$_POST[photo]','$suspect_name','$suspect_detail','$email','pending',0,'$voiceFilePath')";

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
