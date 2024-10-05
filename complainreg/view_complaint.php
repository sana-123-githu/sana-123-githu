<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userdashboard</title>
    <link rel="stylesheet" href="nav.css">
    <style>
        /* General styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 8px;
            overflow: hidden; /* To round corners on table */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        /* Table header styles */
        th {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: left;
        }

        /* Table cell styles */
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        /* Alternate row colors for better readability */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Hover effect for rows */
        tr:hover {
            background-color: #f1f1f1; /* Highlight on hover */
        }

        /* Style for images within the table */
        td img {
            max-width: 100px;
            height: auto;
            border-radius: 4px; /* Rounded corners for images */
        }

        /* Style for audio controls */
        td audio {
            max-width: 150px;
        }

        /* Style for form elements */
        form {
            display: inline;
        }

        button {
            background-color: #007BFF; /* Blue background */
            color: white; /* White text */
            padding: 6px 12px; /* Padding */
            border: none; /* Remove borders */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Mouse pointer on hover */
            font-size: 14px; /* Font size */
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1 class="navheading">YOUR VOICE MATTERS!</h1>
        <ul class="navulcommon">
            <li><a class="nava" href="complaint_register.html">Complaint registration</a></li>
            <li><a class="nava" href="view_complaint.php">View Complaint</a></li>
            <li><a class="nava" href="">Officer evaluation</a></li>
            <li><a class="nava" href="home.html">Logout</a></li>
        </ul>
    </nav>
    <table>
        <tr>
            <th>ID</th>
            <th>Complaint Type</th>
            <th>Date</th>
            <th>Complaint Detail</th>
            <th>Photo</th>
            <th>Suspect Name</th>
            <th>Details</th>
            <th>Status</th>
            <th>Voice Recording</th>
            <th>Action</th>
        </tr>
        <?php
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "complainreg");
        if (!$conn) {
            echo "DB not connected";
        }
        $ofid = $_SESSION['useremail'];
        $sql = "SELECT * FROM complaints WHERE `email`='$ofid'";
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
                echo "<td><img src='./assets/" . $row['photo'] . "' alt='Complaint Photo'></td>";
                echo "<td>" . $row['suspect_name'] . "</td>";
                echo "<td>" . $row['details'] . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "<td>
                        <audio controls>
                            <source src='" . $voice . "' type='audio/mp3'>
                            Your browser does not support the audio element.
                        </audio>
                      </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Record not found</td></tr>";
        }
        ?>
    </table>
    <?php
    if (isset($_POST['updatestatus'])) {
        $id = $_POST['complaint_id'];
        $new_status = $_POST['status'];

        $sql = "UPDATE complaints SET status='$new_status' WHERE complaint_id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Status updated successfully');</script>";
            header('Location: officercomplaintmanagement.php');
            exit();
        } else {
            echo "<script>alert('Error updating status');</script>";
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>
