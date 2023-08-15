<?php
require('conn.php');
if (isset($_SESSION['token'])) {
    header("Location: ./admin");
}
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />


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

        .style2 {
            font-size: medium;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Main -->
    <div id="main">
        <?php
        include "menu.php"
            ?>