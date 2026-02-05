<?php
require_once '../includes/auth-check.php';
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $conn->real_escape_string($_POST['message']);
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("INSERT INTO messages (user_id, message, recipient) VALUES (?, ?, ?)");
    $recipient = ($_SESSION['role'] === 'teacher') ? 'all' : 'teacher';
    $stmt->bind_param("iss", $user_id, $message, $recipient);
    $stmt->execute();
}
?>