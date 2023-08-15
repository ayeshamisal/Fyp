<?php
session_start();
function encryptCookie($value, $key)
{
    $cipher = "AES-256-CBC";
    $ivLength = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encryptedValue = openssl_encrypt($value, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    $encryptedValueWithIv = base64_encode($iv . $encryptedValue);
    return $encryptedValueWithIv;
}


// function decryptCookie($encryptedValue, $key)
// {
//     $cipher = "AES-256-CBC";
//     $ivLength = openssl_cipher_iv_length($cipher);
//     $decodedValue = base64_decode($encryptedValue);
//     $iv = substr($decodedValue, 0, $ivLength);
//     $encryptedValue = substr($decodedValue, $ivLength);
//     $decryptedValue = openssl_decrypt($encryptedValue, $cipher, $key, OPENSSL_RAW_DATA, $iv);
//     return $decryptedValue;
// }

// $encryptedEmail = $_COOKIE['user_email'];
// $decryptedEmail = decryptCookie($encryptedEmail, $key);


// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "timetable1";

// Retrieve form inputs
$email = $_POST['email'];
$myPassword = $_POST['password'];

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user record from the database based on the provided email
$selectQuery = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($selectQuery);

if ($result->num_rows === 1) {
    // User record found, verify the password
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    if (password_verify($myPassword, $storedPassword)) {
        // Password is correct, login successful
        $key = "aslkjf3lk2jlkl23kdaslfl32lkj234l"; // Replace with your own encryption key
        $encryptedEmail = encryptCookie($email, $key);
        setcookie("token", $encryptedEmail, time() + (60 * 10), "/"); // Cookie expires in 10 minutes
        $_SESSION['token'] = $email;
        $_SESSION['role'] = $row['role'];
        // Redirect to the home page
        header("Location: ../admin");
        exit();
    } else {
        // Password is incorrect
        $_SESSION['error'] = 'Invalid password';
        header("Location: ../");
    }
} else {
    // User record not found
    $_SESSION['error'] = 'User not found';
    header("Location: ../");
}

// Close the database connection
$conn->close();
?>