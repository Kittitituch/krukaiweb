<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// สำหรับหน้าเฉพาะอาจารย์
if (isset($teacher_only) && $_SESSION['role'] !== 'teacher') {
    header("HTTP/1.1 403 Forbidden");
    exit("คุณไม่มีสิทธิ์เข้าถึงหน้านี้");
}
?>