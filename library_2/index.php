<?php
session_start();
include "db.php";

$isAdmin = false;
if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    $isAdmin = true;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Library</title>
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

.nav-left a:hover{
    text-decoration:underline;
}

.nav-right a{
    background:#00c853;
    color:white;
    padding:8px 14px;
    border-radius:20px;
    text-decoration:none;
    margin-left:10px;
    font-size:14px;
}

.nav-right a.register{
    background:#ff9800;
}

/* ===== CONTENT ===== */
.banner{
    background:white;
    margin:20px auto;
    width:90%;
    padding:20px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.book-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:15px;
}

.book{
    background:white;
    padding:10px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 1px 5px rgba(0,0,0,0.1);
}

.book img{
    width:100%;
    height:200px;
    object-fit:cover;
    border-radius:8px;
}

.book h4{
    margin:5px 0;
    font-size:14px;
}

/* ===== ปุ่มยืมหนังสือ ===== */
.borrow-btn{
    display:inline-block;
    margin:15px 0;
    padding:12px 25px;
    background:#4CAF50;
    color:white;
    border-radius:10px;
    text-decoration:none;
    font-size:18px;
}
.borrow-btn:hover{
    background:#43a047;
}

/* ===== ตารางประวัติ ===== */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}
th,td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:center;
}
th{background:#005bbb;color:white;}
.status-borrow{color:red;font-weight:bold;}
.status-return{color:green;font-weight:bold;}
</style>
</head>
<body>

<!-- ===== HEADER BAR ===== -->
<div class="header">
    <div class="logo">📚 My Library</div>

    <div class="nav-left">
        <a href="index.php">หนังสือ</a>
        <a href="category.php">หมวดหมู่</a>
        <a href="borrow.php">ยืมหนังสือ</a>
        <a href="borrow_history.php">ประวัติการยืม</a>

        <?php if($isAdmin){ ?>
            <a href="admin_home.php">🛠 จัดการระบบ</a>
        <?php } ?>
    </div>

    <div class="nav-right">
        <?php if(isset($_SESSION['fullname'])){ ?>
            <span style="color:white;">👤 <?= $_SESSION['fullname']; ?></span>
            <a href="logout.php">ออกจากระบบ</a>
        <?php }else{ ?>
            <a href="login.php">เข้าสู่ระบบ</a>
            <a href="register.php" class="register">สมัครสมาชิก</a>
        <?php } ?>
    </div>
</div>

<!-- ===== CONTENT ===== -->
<div class="banner">
    <h2>📖 หนังสือแนะนำ</h2>

    <div class="book-grid">
        <div class="book">
            <img src="book1.jpg">
            <h4>Harry Potter</h4>
        </div>
        <div class="book">
            <img src="book2.jpg">
            <h4>1984</h4>
        </div>
        <div class="book">
            <img src="book3.jpg">
            <h4>The Daa Vinci Code</h4>
        </div>
        <div class="book">
            <img src="book4.jpg">
            <h4>To Kill a Mockingbird</h4>
        </div>
        <div class="book">
            <img src="book5.jpg">
            <h4>Physics</h4>
        </div>
    </div>
</div>

<!-- ===== ประวัติการยืมเฉพาะสมาชิก ===== -->
<?php 
if(isset($_SESSION['member_id']) && isset($_GET['page']) && $_GET['page']=='history'){ 
$member_id = $_SESSION['member_id'];

$sql = "SELECT borrow.borrow_id, book.book_name, borrow.borrow_date, borrow.return_date
        FROM borrow
        INNER JOIN book ON borrow.book_id = book.book_id
        WHERE borrow.member_id = '$member_id'
        ORDER BY borrow.borrow_id DESC";

$result = mysqli_query($conn,$sql);
?>
<div class="banner">
    <h2>📑 ประวัติการยืมของฉัน</h2>
    <table>
        <tr>
            <th>รหัส</th>
            <th>ชื่อหนังสือ</th>
            <th>วันที่ยืม</th>
            <th>วันที่คืน</th>
            <th>สถานะ</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?= $row['borrow_id']; ?></td>
            <td><?= $row['book_name']; ?></td>
            <td><?= $row['borrow_date']; ?></td>
            <td><?= $row['return_date'] ? $row['return_date'] : "-"; ?></td>
            <td>
                <?php if($row['return_date']==NULL){ ?>
                    <span class="status-borrow">ยังไม่คืน</span>
                <?php }else{ ?>
                    <span class="status-return">คืนแล้ว</span>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php } ?>

</body>
</html>