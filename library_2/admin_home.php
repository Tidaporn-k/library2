<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Menu</title>
<style>
body{
    margin:0;
    font-family: Tahoma;
    background:#f2f4f7;
}
.menu-box{
    width:400px;
    margin:80px auto;
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    text-align:center;
}
.menu-box h2{
    margin-bottom:25px;
}
.menu-box a{
    display:block;
    text-decoration:none;
    background:#0d6efd;
    color:white;
    padding:15px;
    border-radius:10px;
    margin:12px 0;
    font-size:18px;
}
.menu-box a:hover{
    background:#084298;
}
.logout{
    background:#dc3545 !important;
}
.logout:hover{
    background:#bb2d3b !important;
}
</style>
</head>

<body>

<div class="menu-box">
    <h2>เมนูผู้ดูแลระบบ</h2>

    <a href="booklist.php">จัดการหนังสือ</a>
    <a href="memberlist.php">จัดการสมาชิก</a>
    <a href="borrow_history.php">ประวัติการยืม</a>
    <a href="admin_borrow_manage.php">ค่าปรับ</a>
    <a href="logout.php" class="logout">ออกจากระบบ</a>
</div>

</body>
</html>