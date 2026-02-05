<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'database_course';
$port = 3306;

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตั้งค่าภาษาและเวลา
$conn->set_charset("utf8mb4");
date_default_timezone_set('Asia/Bangkok');
?>