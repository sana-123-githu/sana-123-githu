<html>
    <head>
        <title>update </title>
    </head>
    <body>
        <h2>manage user</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>dob</th>
                <th>Mobile</th>
                <th>Email</th>
            </tr>
            <?php
            $conn=mysqli_connect("localhost","root","","complainreg");
            if(!$conn){
                echo "db not connect";
            }
            $sql="SELECT * from users";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                    $id=$row['usid'];
                    echo "<tr>";
                         echo "<td>".$row['usid']."</td>";
                         echo "<td>".$row['name']."</td>";
                         echo "<td>".$row['dob']."</td>";
                         echo "<td>".$row['phno']."</td>";
                         echo "<td>".$row['email']."</td>";
echo "<td><form method='post'><button value='{$id}' name='deluser' type='submit'>DELETE</button></form></td>";
                         echo "</tr>";
                }
            }
            else{
                echo "record not found";
            }
            ?>
        </table>
    </body>
</html>

<?php
if(isset($_POST['deluser'])){
    $id=$_POST['deluser'];
    if(!empty($_POST['deluser'])){
    $sql ="DELETE FROM `users` WHERE `usid` = '$id'";
    // echo "$sql";
    $data=mysqli_query($conn,$sql);
        // echo "<script>alert('Officer deleted successfully')</script>";
        echo "<script>window.replace.location('../complainreg/deleteuser.php')</script>";
}
}
?>