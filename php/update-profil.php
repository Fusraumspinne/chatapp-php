<?php
    session_start();
    include_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['newFname']) && isset($_POST['newLname']) && isset($_POST['newEmail']) && isset($_POST['newPassword'])) {
            $newFname = mysqli_real_escape_string($conn, $_POST['newFname']);
            $newLname = mysqli_real_escape_string($conn, $_POST['newLname']);
            $newEmail = mysqli_real_escape_string($conn, $_POST['newEmail']);
            $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);

            $unique_id = $_SESSION['unique_id'];

            $update_query = "UPDATE users SET fname = '$newFname', lname = '$newLname', email = '$newEmail', password = '$newPassword' WHERE unique_id = '$unique_id'";

            $result = mysqli_query($conn, $update_query);

            if ($result) {
                echo "Profile updated successfully!";
            } else {
                echo "Error updating profile: " . mysqli_error($conn);
            }
        } else {
            echo "Invalid POST data!";
        }
    } else {
        echo "Invalid request!";
    }

    mysqli_close($conn);
?>