<?php
include("db.php");

if (isset($_POST['submit'])) {
    $book_name    = $_POST['book_name'];
    $publish_date = $_POST['publish_date'];
    $book_type    = $_POST['book_type'];
    $price        = $_POST['price'];
    $author_name  = $_POST['author_name'];

    $sql = "INSERT INTO book 
    (book_name, publish_date, book_type, price, author_name)
    VALUES
    ('$book_name', '$publish_date', '$book_type', '$price', '$author_name')";

    if (mysqli_query($conn, $sql)) {
        header("Location: book_list.php"); // เปลี่ยนชื่อไฟล์ตามของคุณ
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>เพิ่มหนังสือ</title>
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
    background:#198754;
    color:white;
    border:none;
    padding:12px;
    border-radius:10px;
    width:100%;
    font-size:16px;
}
a{
    display:block;
    text-align:center;
    margin-top:15px;
    text-decoration:none;
}
</style>
</head>
<body>

<div class="box">
<h2>📚 เพิ่มหนังสือ</h2>

<form method="post">
    <label>ชื่อหนังสือ</label>
    <input type="text" name="book_name" required>

    <label>วันพิมพ์ / วันเผยแพร่</label>
    <input type="date" name="publish_date">

    <label>ประเภทหนังสือ</label>
    <input type="text" name="book_type">

    <label>ราคา</label>
    <input type="number" step="0.01" name="price">

    <label>ชื่อผู้แต่ง</label>
    <input type="text" name="author_name">

    <button type="submit" name="submit">บันทึก</button>
</form>

<a href="book_list.php">← กลับหน้ารายการหนังสือ</a>
</div>

</body>
</html>