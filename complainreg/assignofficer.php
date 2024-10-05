<html>
    <head>
        <title>admindashboard</title>
        <link rel="stylesheet" href="admindashboard.css">
        <link rel="stylesheet" href="assignofficer.css">
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
<body>
    <h2>Assign Officer to Complaint</h2>

    <?php
    $conn = mysqli_connect("localhost", "root", "", "complainreg");
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['assignofficer'])) {
        $complaintId = $_POST['assignofficer'];
        
        $sql = "SELECT * FROM complaints WHERE complaint_id='$complaintId'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $complaint = mysqli_fetch_assoc($result);
            echo "<h3>Complaint Details</h3>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Complaint Type</th><th>Date</th><th>Details</th><th>Status</th></tr>";
            echo "<tr>";
            echo "<td>".$complaint['complaint_id']."</td>";
            echo "<td>".$complaint['complaint_type']."</td>";
            echo "<td>".$complaint['date']."</td>";
            echo "<td>".$complaint['complaint_detail']."</td>";
            echo "<td>".$complaint['status']."</td>";
            echo "</tr>";
            echo "</table>";

            echo "<h3>Assign Officer</h3>";
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='complaint_id' value='".$complaint['complaint_id']."'>";
            echo "<select name='officerid'>";

            $officerSql = "SELECT officerid, name FROM officer";
            $officerResult = mysqli_query($conn, $officerSql);
            while ($officer = mysqli_fetch_assoc($officerResult)) {
                echo "<option value='".$officer['officerid']."'>".$officer['name']."</option>";
            }

            echo "</select>";
            echo "<input type='submit' name='submit_assignment' value='Assign'>";
            echo "</form>";
        } else {
            echo "Complaint not found.";
        }
    }

    if (isset($_POST['submit_assignment'])) {
        $complaintId = $_POST['complaint_id'];
        $officerId = $_POST['officerid'];

        $updateSql = "UPDATE complaints SET officerid='$officerId' WHERE complaint_id='$complaintId'";
        if (mysqli_query($conn, $updateSql)) {
            echo "Officer assigned successfully.";
            header('Location: view_complaints.php');
            exit();
        } else {
            echo "Error assigning officer: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>
