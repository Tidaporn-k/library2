<?php
session_start();     // เริ่ม session
session_destroy();  // ลบ session ทั้งหมด

// กลับไปหน้า index
header("Location: index.php");
exit();
?>