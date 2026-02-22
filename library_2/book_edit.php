<?php
include("db.php");

// รับ id จาก book_list.php
if (!isset($_GET['id'])) {
    header("Location: book_list.php");
    exit();
}

$id = $_GET['id'];

// เมื่อกดปุ่มบันทึก
if (isset($_POST['submit'])) {
    $book_name   = $_POST['book_name'];
    $publish_date = $_POST['publish_date'];
    $book_type   = $_POST['book_type'];
    $price       = $_POST['price'];
    $author_name = $_POST['author_name'];

    $sql = "UPDATE book SET
            book_name='$book_name',
            publish_date='$publish_date',
            book_type='$book_type',
            price='$price',
            author_name='$author_name'
            WHERE book_id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: book_list.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// ดึงข้อมูลเดิมมาแสดง
$sql = "SELECT * FROM book WHERE book_id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>แก้ไขหนังสือ</title>
<style>
body{
    font-family: Tahoma;
    background:#f2f4f7;
}
.box{
    width:500px;
    margin:60px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}
input, select{
    width:100%;
    padding:10px;
    margin:6px 0 12px 0;
    border-radius:8px;
    border:1px solid #ccc;
}
button{
    background:#0d6efd;
    color:white;
    border:none;
    padding:12px;
    border-radius:10px;
    width:100%;
    font-size:16px;
}
.back{
    display:block;
    text-align:center;
    margin-top:15px;
}
</style>
</head>
<body>

<div class="box">
<h2>✏️ แก้ไขข้อมูลหนังสือ</h2>

<form method="post">
    <label>ชื่อหนังสือ</label>
    <input type="text" name="book_name" value="<?= $row['book_name'] ?>" required>

    <label>วันเผยแพร่</label>
    <input type="date" name="publish_date" value="<?= $row['publish_date'] ?>">

    <label>ประเภทหนังสือ</label>
    <input type="text" name="book_type" value="<?= $row['book_type'] ?>">

    <label>ราคา</label>
    <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>">

    <label>ผู้แต่ง</label>
    <input type="text" name="author_name" value="<?= $row['author_name'] ?>">

    <button type="submit" name="submit">บันทึกการแก้ไข</button>
</form>

<a href="book_list.php" class="back">← กลับหน้ารายการหนังสือ</a>

</div>

</body>
</html>