<?php
require_once '../includes/auth-check.php';
include '../includes/config.php';

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// อาจารย์เห็นทุกข้อความ, นักศึกษาเห็นเฉพาะที่ส่งถึงอาจารย์หรือของตัวเอง
$sql = ($role === 'teacher') 
    ? "SELECT m.*, u.username FROM messages m JOIN users u ON m.user_id = u.id ORDER BY m.created_at"
    : "SELECT m.*, u.username FROM messages m JOIN users u ON m.user_id = u.id 
       WHERE m.recipient = 'teacher' OR m.user_id = ? ORDER BY m.created_at";

$stmt = $conn->prepare($sql);
if ($role !== 'teacher') $stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $isMe = ($row['user_id'] == $user_id);
    $class = $isMe ? 'sent' : 'received';
    $name = $isMe ? 'คุณ' : ($role === 'teacher' ? $row['username'] : 'อาจารย์');
    
    echo "<div class='message $class'>";
    echo "<strong>$name:</strong> ";
    echo nl2br(htmlspecialchars($row['message']));
    echo "<br><small class='text-muted'>" . date('H:i', strtotime($row['created_at'])) . "</small>";
    echo "</div>";
}
?>