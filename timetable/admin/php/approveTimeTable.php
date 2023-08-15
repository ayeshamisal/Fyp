<?php
require("../../conn.php");
if (isset($_GET['id'])) {
    if($_SESSION['role'] !== 'hod'){
         $_SESSION['message'] = "You can not approve timetable";
     header("Location: ../generate.php");
        exit();
    }
    $id = $_GET['id'];
    // Insert data into the course table

    $sql = "UPDATE timetable SET status = CASE WHEN id = $id THEN 'approve' ELSE 'available' END WHERE id <> $id OR id = $id";

    if ($dbConnection->query($sql) === TRUE) {
        $_SESSION['message'] = "Data update successfully";
        header("Location: ../generate.php");
        exit();
    } else {
        $_SESSION['message'] = "Error inserting data";
        header("Location: ../generate.php");
    }
} else {
    $_SESSION['message'] = "No ID specified.";
    header("Location: ../generate.php");
}
// Close the database connection
$dbConnection->close();
?>