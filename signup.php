<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=.main, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
     <nav class="aaaa">
        <div class="ssss">
            <h1 class="iii">WOMEN COMPLAINT REGISTRATION</h1>
            <div class="vvvv">
               <a class="anan" href="login.php">Login</a>
                <a class="anan" href="signup.php">Signup</a>
                <a class="anan" href="">Feedback</a>
                <a class="anan" href="index.html">Home</a>
            </div>
        </div>
    </nav>
    <div class="mainpart">
    <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            // echo "<p>Registration successful!</p>";
        }
        ?>
        <form action="" method="post">
            <div class="subpart">
        <h1 class="sign1">Sign Up</h1>
        <div class="sss">
        <input class="inp1" type="text" name="name" placeholder="Username">
        <img class="img1" src="./user.png" alt="">
        </div>
        <div class="sss">
        <input class="inp1" type="text" name="phonenum" placeholder="Phone no">
        <img class="img1" src="./phone-call.png" alt="">
        </div>
        <div class="sss">
        <input class="inp1" type="text" name="email" placeholder="Email">
        <img class="img1" src="./email.png" alt="">
        </div>
        <div class="sss">
        <input class="inp1" type="password" name="password" placeholder="Password">
        <img class="img1" src="./padlock.png" alt="">
        </div>
        <div class="sss">
        <input class="inp1" type="password" name="cnfrmpassword" placeholder="Confirm Password ">
        <img class="img1" alt="">
        </div>
        <div class="vvv"> 
        <button class="inp2" name="button" >Sign in</button>   
    </div>
</form>
    </div>
    </div>
    
</body>
</html>
 
<?php
require_once("connect.php");
if (isset($_POST['button'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cnpassword = $_POST['cnfrmpassword'];
    $phonenum = $_POST['phonenum'];
    $type = 0;

    if ($password == $cnpassword) {
        // Insert into user table
        $sql = "INSERT INTO `user`(`username`, `phoneno`, `email`, `password`) VALUES ('$name', '$phonenum', '$email', '$password')";
        $data = mysqli_query($conn, $sql);
        
        // Check if user was successfully added
        if ($data) {
            // Get the user ID of the last inserted record
            $userId = mysqli_insert_id($conn);
            
            // Insert into login table with the user ID
            $sql1 = "INSERT INTO `login`(`user_id`, `email`, `password`, `usertype`) VALUES  ('$userId', '$email', '$password', '$type')";
            $data1 = mysqli_query($conn, $sql1);
            
            if ($data1) {
                echo "<script>alert('Record added successfully')</script>";
                header("Location: signup.php?success=1");
            } else {
                echo "<script>alert('Error adding to login table')</script>";
            }
        } else {
            echo "<script>alert('Error adding user')</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match')</script>";
    }
} else {
    // echo "Invalid form";
}
?>
