<?php
include "db.php";

$sql = "SELECT * FROM book ORDER BY book_id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>รายการหนังสือ</title>
<style>
body{
    font-family: Tahoma;
    background:#f2f4f7;
    margin:0;
}
.box{
    width:95%;
    margin:40px auto;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}
.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}
h2{
    margin:0;
}
.btn-add{
    background:#28a745;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
}
.btn-back{
    background:#6c757d;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
}
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#0d6efd;
    color:white;
    padding:10px;
}
td{
    padding:8px;
    border-bottom:1px solid #ddd;
    text-align:center;
}
.btn-edit{
    background:#ffc107;
    padding:5px 10px;
    border-radius:6px;
    text-decoration:none;
    color:black;
}
.btn-del{
    background:#dc3545;
    padding:5px 10px;
    border-radius:6px;
    text-decoration:none;
    color:white;
}
</style>
</head>
<body>

<div class="box">

    <div class="top-bar">
        <h2>📚 รายการหนังสือ</h2>
        <div>
            <a href="add_book.php" class="btn-add">➕ เพิ่มหนังสือ</a>
            <a href="admin_menu.php" class="btn-back">⬅ กลับหน้าเมนู</a>
        </div>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>ชื่อหนังสือ</th>
            <th>วันเผยแพร่</th>
            <th>ประเภท</th>
            <th>ราคา</th>
            <th>ผู้แต่ง</th>
            <th>จัดการ</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?=$row['book_id']?></td>
            <td><?=$row['book_name']?></td>
            <td><?=$row['publish_date']?></td>
            <td><?=$row['book_type']?></td>
            <td><?=$row['price']?></td>
            <td><?=$row['author_name']?></td>
            <td>
                <a href="book_edit.php?id=<?=$row['book_id']?>" class="btn-edit">✏ แก้ไข</a>
                <a href="book_delete.php?id=<?=$row['book_id']?>"
                   onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?');"
                   class="btn-del">🗑 ลบ</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>