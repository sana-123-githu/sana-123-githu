<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css"> 
    <title>LOGIN</title>
</head>
<body>
    
    <nav class="nanbar">
        <div class="nanbar">
        <a href="#">women complaint registration system</a>
        <div class="link">
            <a href="index.html">Home</a>
        </div>
</div>
    </nav>
    <div class="div1">
        <form class="log" action="login.php" method="POST">
            <h1 class="head">LOGIN</h1> 
            <input class="word" type="email" name="email" placeholder="Email" required>
            <input class="word" type="password" name="password" placeholder="Password" required>
            <input class="submit" type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>

<?php

$conn = mysqli_connect("localhost", "root", "", "wcr");


if (!$conn) {
    echo "Database not connected.";
    exit(); 
}

if (isset($_POST['login'])) {
    // Get user inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
    $data = mysqli_query($conn, $sql);

    if ($data) {
        if (mysqli_num_rows($data) > 0) {
            $value= mysqli_fetch_assoc($data);
            if($value['usertype']== 0){
            header('Location: userhome.html');
            echo $value['usertype'];
            exit();
        }
            elseif($value['usertype']== 1){
                header('Location: staffhome.html');
                echo $value['usertype'];
                exit();
            }
            else{
                header('Location: adminhome.html');
                echo $value['usertype'];
                exit();
         }
                     
        } else {
            echo "<script>alert('Invalid user');</script>";
        }
    }
}

mysqli_close($conn);
?>
