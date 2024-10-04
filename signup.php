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
        <input class="inp2" type="submit" name="button" value="Sign in">    
    </div>
</form>
    </div>
    </div>
    
</body>
</html>
 


<?php
require_once("connect.php");
if(isset($_POST['button'])){
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$cnpassword = $_POST['cnfrmpassword'];
$phonenum = $_POST['phonenum'];
$type=0;
if($password == $cnpassword)
{
$sql = "INSERT INTO `user`(`username`, `phoneno`, `email`, `password`) VALUES ('$name','$phonenum','$email','$password')";
$data = mysqli_query($con,$sql);
$sql1="INSERT INTO `login`(`email`, `password`, `usertype`) VALUES ('$email','$password','$type')";
$data1 = mysqli_query($con,$sql1);
if($data && $data1){
echo "<script>alert('Record added')</script>";
header("Location: signup.php?success=1");
}
else{
echo "<script>alert('Invalid added')</script>";
}
}
else{
echo "<script>alert('password does not match')</script>";
}
}
else {
// echo "Invalid form";
}
?>
