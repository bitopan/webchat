<?php

ini_set("memory_limit", "256M");
date_default_timezone_set('Asia/Kolkata');

$servername='localhost';
$dbusername='root';
$dbpassword='Dat#A@23';
$dbname='videochat';
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}





