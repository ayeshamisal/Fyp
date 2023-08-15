<?php
require("../../conn.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Insert data into the course table
    $courseName = $_POST['courseName'];
    $enrolledStudents = $_POST['enrolledStudent'];
    $credit = $_POST['creditHours'];
    $lab = $_POST['lab'];
    $status = "available";


    $sql = "UPDATE course SET 	course_name='$courseName', enrolled_students='$enrolledStudents', credit='$credit',lab='$lab',status='$status' WHERE id = $id";

    if ($dbConnection->query($sql) === TRUE) {
        $_SESSION['message'] = "Data update successfully";
        header("Location: ../course_details.php");
        exit();
    } else {
        $_SESSION['message'] = "Error inserting data";
        header("Location: ../course_details.php");
    }
} else {
    $_SESSION['message'] = "No ID specified.";
    header("Location: ../course_details.php");
}
// Close the database connection
$dbConnection->close();
?>