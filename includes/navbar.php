<?php
// เริ่ม session ถ้ายังไม่ได้เริ่ม
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="../index.php">
            <i class="fas fa-database me-2"></i>การจัดการฐานข้อมูลเบื้องต้น
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- เมนูหลัก -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home me-1"></i> หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.php"><i class="fas fa-book me-1"></i> เกี่ยวกับรายวิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../content.php"><i class="fas fa-file-alt me-1"></i> เนื้อหาวิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../calendar.php"><i class="fas fa-calendar-alt me-1"></i> ปฏิทินเรียน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../download.php"><i class="fas fa-download me-1"></i> ดาวน์โหลด</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../submission.php"><i class="fas fa-upload me-1"></i> ส่งงาน</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../chat/"><i class="fas fa-comments me-1"></i> แชท</a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <!-- เมนูด้านขวา (ส่วนผู้ใช้) -->
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- ถ้าล็อกอินแล้ว -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i>
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                            <?php if ($_SESSION['role'] === 'teacher'): ?>
                                <span class="badge bg-warning text-dark ms-1">อาจารย์</span>
                            <?php else: ?>
                                <span class="badge bg-info ms-1">นักศึกษา</span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text">
                                    <i class="fas fa-user me-2"></i>
                                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <?php if ($_SESSION['role'] === 'teacher'): ?>
                                <li>
                                    <a class="dropdown-item" href="../admin/">
                                        <i class="fas fa-cog me-2"></i>แผงควบคุม
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a class="dropdown-item" href="../profile.php">
                                    <i class="fas fa-id-card me-2"></i>โปรไฟล์
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../auth/logout.php">
                                    <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- ถ้ายังไม่ได้ล็อกอิน -->
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/login.php">
                            <i class="fas fa-sign-in-alt me-1"></i>เข้าสู่ระบบ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/register.php">
                            <i class="fas fa-user-plus me-1"></i>สมัครสมาชิก
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- แสดงข้อความแจ้งเตือนถ้ามี -->
<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['flash_message']['type']; ?> alert-dismissible fade show mb-0" role="alert">
        <?php echo $_SESSION['flash_message']['text']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
<?php endif; ?>