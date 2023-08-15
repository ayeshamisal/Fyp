<?php
require('../../conn.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $Monday = isset($_POST['Monday']) ? $_POST['Monday'] : 0;
    $Tuesday = isset($_POST['Tuesday']) ? $_POST['Tuesday'] : 0;
    $Wednesday = isset($_POST['Wednesday']) ? $_POST['Wednesday'] : 0;
    $Thursday = isset($_POST['Thursday']) ? $_POST['Thursday'] : 0;
    $Friday = isset($_POST['Friday']) ? $_POST['Friday'] : 0;
    $Subjects = $_POST['Subjects'];
    
    // Check if days exist and add them to the $availability array
    $availability = [];
    if ($Monday) {
        $availability['Monday'] = $Monday;
    }
    if ($Tuesday) {
        $availability['Tuesday'] = $Tuesday;
    }
    if ($Wednesday) {
        $availability['Wednesday'] = $Wednesday;
    }
    if ($Thursday) {
        $availability['Thursday'] = $Thursday;
    }
    if ($Friday) {
        $availability['Friday'] = $Friday;
    }
    $data = json_encode($availability);
    $Subject_endcode = json_encode($Subjects);
    // $insertQuery = "INSERT INTO teachers (name,email, subject, availability, status) VALUES ('$name','$email', '$Subject_endcode', '$data', 'available')";
    $selectQuery = "SELECT * FROM teachers WHERE id = $id";
    $result = $dbConnection->query($selectQuery);
    if ($result->num_rows > 0) {
        $sql = "UPDATE teachers SET name='$name', email='$email', subject='$Subject_endcode', availability='$data', status='available' WHERE id = $id";
        if ($dbConnection->query($sql) === TRUE) {
            $_SESSION['message'] = "Data Update successfully";
            header("Location: ../faculty_details.php");
            exit();
        } else {
            $_SESSION['message'] = "Error Update values";
            header("Location: ../faculty_details.php");
        }
    } else {
        $_SESSION['message'] = "Does not exits";
        header("Location: ../faculty_details.php");
    }
} else {
    $_SESSION['message'] = "No ID specified.";
    header("Location: ../faculty_details.php");
}

// Close the database connection
$conn->close();
?>