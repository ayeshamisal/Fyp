<?php
// *** Logout the current user.
$logoutGoTo = "../index.php";
if (!isset($_SESSION)) {
  session_start();
}
session_unset();
if ($logoutGoTo != "") {
  header("Location: $logoutGoTo");
  exit;
}
?>