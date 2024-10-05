<html>
    <head>
        <title>update </title>
    </head>
    <body>
        <h2>manage officer</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>dob</th>
                <th>Mobile</th>
                <th>Email</th>
            </tr>
            <?php
            $conn=mysqli_connect("localhost","root","","complainreg");
            if(!$conn){
                echo "db not connect";
            }
            $sql="SELECT * from officer";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                    $id=$row['officerid'];
                    echo "<tr>";
                         echo "<td>".$row['officerid']."</td>";
                         echo "<td>".$row['name']."</td>";
                         echo "<td>".$row['position']."</td>";
                         echo "<td>".$row['dob']."</td>";
                         echo "<td>".$row['phonenum']."</td>";
                         echo "<td>".$row['email']."</td>";
                         echo "<td><form method='post'><button value='{$id}' name='delofficer' type='submit'>DELETE</button></form></td>";
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
if(isset($_POST['delofficer'])){
    $id=$_POST['delofficer'];
    if(!empty($_POST['delofficer'])){
    $sql ="DELETE FROM `officer` WHERE `officerid` = '$id'";
    // echo "$sql";
    $data=mysqli_query($conn,$sql);
        // echo "<script>alert('Officer deleted successfully')</script>";
        echo "<script>window.replace.location('../complainreg/updateofficer.php')</script>";
}
}
?>