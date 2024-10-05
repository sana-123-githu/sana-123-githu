<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admindashboard.css">
    <link rel="stylesheet" href="view_complaints.css">
</head>   
<body>
    <nav class="navbar">
        <h1 class="navheading">YOUR VOICE MATTERS!</h1>
        <ul class="navuladmin">
            <li class="dropdown">
                <a href="#" class="nava">Complaint Management</a>
                <div class="dropdown-content">
                    <a href="view_complaints.php">View Complaint</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="nava">Officer Management</a>
                <div class="dropdown-content">
                    <a href="addofficer.php">Add Officer</a>
                    <a href="updateofficer.php">Update Officer</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="nava">User Management</a>
                <div class="dropdown-content">
                    <a href="addofficer.php">Add Officer</a>
                    <a href="deleteuser.php">Delete user</a>
                </div>
            </li>
            <li><a class="nava" href="home.html">Logout</a></li>
        </ul>
    </nav>
    <h2>Complaints</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Complaint Type</th>
            <th>Date</th>
            <th>Complaint Detail</th>
            <th>Photo</th>
            <th>Suspect Name</th>
            <th>Details</th>
            <th>Status</th>
            <th>Officer ID</th>
            <th>Voice Recording</th>
            <th>Action</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "complainreg");
        if (!$conn) {
            echo "DB not connected";
        }
        $sql = "SELECT * FROM complaints";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['complaint_id'];
                $voice = $row['voice'];
                echo "<tr>";
                echo "<td>" . $row['complaint_id'] . "</td>";
                echo "<td>" . $row['complaint_type'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['complaint_detail'] . "</td>";
                echo "<td><img src='./assets/" . $row['photo'] . "' alt='Complaint Photo' style='width: 100px; height: auto;'></td>";
                echo "<td>" . $row['suspect_name'] . "</td>";
                echo "<td>" . $row['details'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['officerid'] . "</td>";
                echo "<td>
<audio controls>
    <source src='".$voice."' type='audio/mp3'>
    Your browser does not support the audio element.
</audio>
</td>";
                echo "<td>
                        <form action='assignofficer.php' method='post'>
                            <button value='{$id}' name='assignofficer' type='submit'>ASSIGN OFFICER</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>Record not found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
