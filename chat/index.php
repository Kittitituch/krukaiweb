<?php
require_once '../includes/auth-check.php'; // ตรวจสอบการล็อกอิน
include '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <!-- Bootstrap & CSS -->
    <style>
        .chat-container {
            height: 500px;
            overflow-y: auto;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px 15px;
            border-radius: 15px;
            max-width: 70%;
        }
        .sent {
            background-color: #d1ecf1;
            margin-left: auto;
            border-bottom-right-radius: 0;
        }
        .received {
            background-color: #f8d7da;
            margin-right: auto;
            border-bottom-left-radius: 0;
        }
    </style>
</head>
<body>
    <!-- นำเข้า Navbar -->
    <?php include '../includes/navbar.php'; ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h3 class="mb-0"><i class="fas fa-comments me-2"></i>แชทกับอาจารย์</h3>
                    </div>
                    <div class="card-body">
                        <div class="chat-container mb-3" id="chatBox">
                            <!-- ข้อความจะถูกโหลดผ่าน AJAX -->
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="messageInput" placeholder="พิมพ์ข้อความ...">
                            <button class="btn btn-primary" id="sendBtn">
                                <i class="fas fa-paper-plane"></i> ส่ง
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // โหลดข้อความทุก 2 วินาที
        function loadMessages() {
            $.get("get.php", function(data) {
                $("#chatBox").html(data);
                $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
            });
        }
        
        // ส่งข้อความ
        $("#sendBtn").click(function() {
            const message = $("#messageInput").val().trim();
            if (message !== "") {
                $.post("send.php", { message: message }, function() {
                    $("#messageInput").val("");
                    loadMessages();
                });
            }
        });
        
        // เรียกใช้งานครั้งแรก
        loadMessages();
        setInterval(loadMessages, 2000);
    });
    </script>
</body>
</html>