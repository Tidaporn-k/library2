<?php
include "db.php";

/* ดึงหมวดหมู่ไม่ซ้ำ */
$sql = "SELECT DISTINCT book_type FROM book";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>หมวดหมู่หนังสือ</title>
<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#f2f4f7;
}

/* ===== HEADER ===== */
.header{
    background:#005bbb;
    color:white;
    padding:10px 20px;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.logo{
    font-size:22px;
    font-weight:bold;
}

.nav-left a{
    color:white;
    margin-right:20px;
    text-decoration:none;
    font-weight:bold;
}

.nav-right a{
    background:#00c853;
    color:white;
    padding:8px 14px;
    border-radius:20px;
    text-decoration:none;
    margin-left:10px;
}

.nav-right a.register{
    background:#ff9800;
}

/* ===== CONTENT ===== */
.container{
    width:90%;
    margin:20px auto;
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.category-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
}

.category{
    background:#e3f2fd;
    padding:20px;
    text-align:center;
    border-radius:12px;
    font-size:18px;
    font-weight:bold;
    cursor:pointer;
    transition:0.2s;
}

.category:hover{
    background:#bbdefb;
}

.category a{
    text-decoration:none;
    color:#0d47a1;
}
</style>
</head>
<body>

<!-- ===== HEADER ===== -->
<div class="header">
    <div class="logo">📚 My Library</div>

    <div class="nav-left">
        <a href="index.php">หนังสือ</a>
        <a href="category.php">หมวดหมู่</a>
        <a href="borrow.php">ยืมหนังสือ</a>
        <a href="borrow_history.php">ประวัติการยืม</a>
    </div>

    <div class="nav-right">
        <a href="login.php">เข้าสู่ระบบ</a>
        <a href="register.php" class="register">สมัครสมาชิก</a>
    </div>
</div>

<!-- ===== CONTENT ===== -->
<div class="container">
    <h2>📂 หมวดหมู่หนังสือ</h2>

    <div class="category-grid">
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="category">
                <a href="index.php?type=<?=$row['book_type']?>">
                    <?=$row['book_type']?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>