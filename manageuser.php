<html>
    <head>
        <title>Manage Users</title>
        <link rel="stylesheet" href="manageuser.css">
    </head>
    <body>
        <nav class="ViewCandidatesNav">
            <h1 class="ViewCandidatesNavHeading">view users</h1>
            <div class="ViewCandidatesNavContainer">
            <a href="adminhome.html">Home</a>
               
            </div>
        </nav>
        <div class="ViewCandidatesBodyContainer">
            <h1>staff</h1>

            <?php
    $conn = mysqli_connect("localhost", "root", "", "wcr");
    if(!$conn){
        echo "Database not connected";
    }

    $sql = "SELECT * FROM user";
    $data=mysqli_query($conn,$sql);
    if(mysqli_num_rows($data)>0){
    
        echo "<table border=1 >";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Phone Number</th>";
        echo "<th>User ID</th>";
        echo "</tr>";

        while($row=mysqli_fetch_assoc($data)){
            $email = $row['email'];
            echo "<tr>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['phoneno']."</td>";
            echo "<td>".$row['id']."</td>";
            echo "<td>
                    <form method='POST'>
                        <button value='$email' name='userdel' type='submit'>Delete</button>
                    </form>
                </td>";
                
        
       }  
        echo "</table>";
    }
        
 ?>


        </div>
    </body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "wcr");
if(!$conn){
    echo "Database not connected";
}

if(isset($_POST['userdel'])){
    $email = $_POST['userdel'];
    if(!empty($_POST['userdel'])){
        $sql = "DELETE FROM users WHERE email='$email'";
        $data = mysqli_query($conn, $sql);
        $sql1 = "DELETE FROM login WHERE email='$email'";
        $data1 = mysqli_query($conn, $sql1);
         echo "<script>window.location.replace('manageuser.php');</script>";
    }
}
?>
