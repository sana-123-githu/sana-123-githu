<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>officerdashboard</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="officercomplaintmanagement.css">
</head>

<body>
    <nav class="navbar">
        <h1 class="navheading">YOUR VOICE MATTERS!</h1>
        <ul class="navulcommon">
            <li><a class="nava" href="officercomplaintmanagement.php">Complaint management</a></li>
            <li><a class="nava" href="">Realtime update</a></li>
            <li><a class="nava" href="">Logout</a></li>

        </ul>
    </nav>
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
            <th>Update Status</th>
            <th>Voice Recording</th>
            <th>Action</th>
        </tr>
        <?php
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "complainreg");
        if (!$conn) {
            echo "DB not connected";
        }
        $ofid = $_SESSION['officerid'];
        $sql = "SELECT * FROM complaints WHERE `officerid`='$ofid'";
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
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "<td>
                        <form action='' method='post'>
                            <input type='text' name='status' value='" . htmlspecialchars($row['status']) . "' required>
                            <input type='hidden' name='complaint_id' value='" . $id . "'>
                            <button type='submit' name='updatestatus'>Update</button>
                        </form>
                      </td>";
                echo "<td>
                        <audio controls>
                            <source src='" . $voice . "' type='audio/mp3'>
                            Your browser does not support the audio element.
                        </audio>
                      </td>";
                echo "<td>
                      <form action='chat.php' method='get'>
    <input type='hidden' name='complaint_id' value='<?php echo $id; ?>'>
    <button type='submit' name='officerChat'>Chat</button>
</form>

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