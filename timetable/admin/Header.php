<?php
require('../conn.php');
if (!isset($_SESSION['token'])) {
    header("Location: ../");
}

?>
<!DOCTYPE html>

<head>
    <title>Time Table Generator</title>
    <link rel="index" href="./" title="Home" />
    <link rel="stylesheet" type="text/css" href="./css/main.css" />
    <link rel="stylesheet" media="print" type="text/css" href="./css/print.css" />
    <link rel="stylesheet" media="aural" type="text/css" href="./css/aural.css" />
    <style type="text/css">
        .style1 {
            color: #000066;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <div id="main" class="box">
        <?php
        include "menu.php"
            ?>