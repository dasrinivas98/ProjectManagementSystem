<?php
$link = mysqli_connect("localhost", "root", "", "pms1");
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
   }
?>