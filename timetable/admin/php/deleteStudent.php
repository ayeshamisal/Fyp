<?php
require('../../conn.php');
if (isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Delete the record from the teachers table
    $sql = "DELETE FROM students WHERE id = $id";

    if ($dbConnection->query($sql) === TRUE) {
        $_SESSION['message'] = "Record deleted successfully.";
        header("Location: ../student_details.php");
        exit();
    } else {
        $_SESSION['message'] = "Error deleting record.";
        header("Location: ../student_details.php");
    }
} else {
    $_SESSION['message'] = "No ID specified.";
    header("Location: ../student_details.php");
}

// Close the connection
$dbConnection->close();
$conn->close();
?>