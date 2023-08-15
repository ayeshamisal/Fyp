<?php
require('../../conn.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stu_id = $_POST['stu_id'];
    $name = $_POST['name'];
    $Subjects = $_POST['Subjects'];
    
    $Subject_endcode = json_encode($Subjects);
    // $insertQuery = "INSERT INTO teachers (name,email, subject, availability, status) VALUES ('$name','$email', '$Subject_endcode', '$data', 'available')";
    $selectQuery = "SELECT * FROM students WHERE id = $id";
    $result = $dbConnection->query($selectQuery);
    if ($result->num_rows > 0) {
        $sql = "UPDATE students SET s_id='$stu_id', name='$name', subject='$Subject_endcode', status='available' WHERE id = $id";
        if ($dbConnection->query($sql) === TRUE) {
            $_SESSION['message'] = "Data Update successfully";
            header("Location: ../student_details.php");
            exit();
        } else {
            $_SESSION['message'] = "Error Update values";
            header("Location: ../student_details.php");
        }
    } else {
        $_SESSION['message'] = "Does not exits";
        header("Location: ../student_details.php");
    }
} else {
    $_SESSION['message'] = "No ID specified.";
    header("Location: ../student_details.php");
}

// Close the database connection
$conn->close();
?>