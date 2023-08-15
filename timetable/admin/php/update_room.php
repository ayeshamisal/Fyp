<?php
require("../../conn.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Insert data into the course table
    $room_name = $_POST['room_name'];
    $capacity = $_POST['capacity'];
    $lab = $_POST['lab'];
    $status = "available";


    $sql = "UPDATE room SET room_name='$room_name', capacity='$capacity',lab='$lab', status='$status' WHERE id = $id";

    if ($dbConnection->query($sql) === TRUE) {
        $_SESSION['message'] = "Data update successfully";
        header("Location: ../room_detail.php");
        exit();
    } else {
        $_SESSION['message'] = "Error inserting data";
        header("Location: ../room_detail.php");
    }
} else {
    $_SESSION['message'] = "No ID specified.";
    header("Location: ../room_detail.php");
}
// Close the database connection
$dbConnection->close();
?>