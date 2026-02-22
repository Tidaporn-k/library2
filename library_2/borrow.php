<?php
include("db.php");

// ดึงสมาชิก
$members = mysqli_query($conn, "SELECT * FROM members");

// ดึงหนังสือ
$books = mysqli_query($conn, "SELECT * FROM book");
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ยืมหนังสือ</title>

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

/* ===== FORM BOX ===== */
.container{
    background:white;
    width:450px;
    margin:40px auto;
    padding:25px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.container h2{
    text-align:center;
    margin-bottom:20px;
}

label{
    font-weight:bold;
}

input[type=text], input[type=date]{
    width:100%;
    padding:8px;
    border-radius:8px;
    border:1px solid #ccc;
    margin-top:5px;
}

button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:10px;
    background:#4CAF50;
    color:white;
    font-size:16px;
    margin-top:15px;
    cursor:pointer;
}

button:hover{
    background:#43a047;
}

.back{
    text-align:center;
    margin-top:15px;
}

.back a{
    text-decoration:none;
    color:#005bbb;
    font-weight:bold;
}
</style>
</head>
<body>

<!-- ===== HEADER ===== -->
<div class="header">
    <div class="logo">📚 My Library</div>
    <div class="nav-left">
        <a href="index.php">หนังสือ</a>
        <a href="borrow.php">ยืมหนังสือ</a>
        <a href="borrow_history.php">ประวัติการยืม</a>
    </div>
</div>

<!-- ===== FORM ===== -->
<div class="container">
    <h2>📚 ระบบยืมหนังสือ</h2>

    <form action="borrow_save.php" method="post">

        <!-- สมาชิก -->
        <label>สมาชิก</label>
        <input list="member_list" name="member_id" placeholder="พิมพ์ชื่อสมาชิก" required>
        <datalist id="member_list">
            <?php while($m = mysqli_fetch_assoc($members)) { ?>
                <option value="<?= $m['member_id']; ?>">
                    <?= $m['username']; ?>
                </option>
            <?php } ?>
        </datalist>

        <br><br>

        <!-- หนังสือ -->
        <label>หนังสือ</label>
        <input list="book_list" name="book_id" placeholder="พิมพ์ชื่อหนังสือ" required>
        <datalist id="book_list">
            <?php while($b = mysqli_fetch_assoc($books)) { ?>
                <option value="<?= $b['book_id']; ?>">
                    <?= $b['book_name']; ?>
                </option>
            <?php } ?>
        </datalist>

        <br><br>

        <label>วันยืม</label>
        <input type="date" name="borrow_date" value="<?= date('Y-m-d'); ?>" required>

        <br><br>

        <label>กำหนดคืน</label>
        <input type="date" name="due_date" required>

        <button type="submit">บันทึกการยืม</button>

    </form>

    <div class="back">
        <a href="index.php">⬅ กลับหน้าแรก</a>
    </div>
</div>

</body>
</html>