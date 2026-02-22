<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>เมนูผู้ดูแลระบบ</title>

<style>
body{
    margin:0;
    font-family: Tahoma;
    background:#f2f5f8;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.menu-box{
    background:white;
    width:420px;
    padding:40px 30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    text-align:center;
}

.menu-box h2{
    margin-bottom:30px;
    font-size:28px;
    font-weight:bold;
}

.menu-btn{
    display:block;
    width:100%;
    padding:16px;
    margin:12px 0;
    background:#0d6efd;
    color:white;
    text-decoration:none;
    font-size:18px;
    border-radius:12px;
    transition:0.2s;
}

.menu-btn:hover{
    background:#0b5ed7;
}

.logout-btn{
    background:#dc3545;
}

.logout-btn:hover{
    background:#bb2d3b;
}
</style>
</head>

<body>

<div class="menu-box">
    <h2>เมนูผู้ดูแลระบบ</h2>

    <a href="booklist.php" class="menu-btn">จัดการหนังสือ</a>
    <a href="memberlist.php" class="menu-btn">จัดการสมาชิก</a>
    <a href="borrow_history.php" class="menu-btn">ประวัติการยืม</a>
    <a href="fine.php" class="menu-btn">ค่าปรับ</a>
    <a href="logout.php" class="menu-btn logout-btn">ออกจากระบบ</a>
</div>

</body>
</html>