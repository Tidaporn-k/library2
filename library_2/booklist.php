<?php
include "db.php";

// ลบหนังสือ
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    // เช็คว่าถูกยืมอยู่หรือไม่
    $check = mysqli_query($conn,"SELECT * FROM borrow WHERE book_id=$id AND return_date IS NULL");
    if(mysqli_num_rows($check)>0){
        echo "<script>alert('ไม่สามารถลบได้ หนังสือยังถูกยืมอยู่');</script>";
    }else{
        mysqli_query($conn,"DELETE FROM book WHERE book_id=$id");
        echo "<script>alert('ลบหนังสือเรียบร้อย'); window.location='booklist.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>จัดการหนังสือ</title>
<style>
body{font-family:Tahoma;background:#f2f6ff}
h2{text-align:center}
table{border-collapse:collapse;width:95%;margin:auto;background:#fff}
th,td{border:1px solid #ccc;padding:8px;text-align:center}
th{background:#0d6efd;color:white}
.edit{background:#ffc107;color:black;padding:5px 10px;border-radius:5px;text-decoration:none}
.del{background:#dc3545;color:white;padding:5px 10px;border-radius:5px;text-decoration:none}
.add{display:block;width:200px;margin:15px auto;background:#198754;color:white;padding:10px;text-align:center;border-radius:8px;text-decoration:none}
</style>
</head>
<body>

<h2>📚 จัดการหนังสือ</h2>

<a href="add_book.php" class="add">➕ เพิ่มหนังสือ</a>

<table>
<tr>
<th>ID</th>
<th>ชื่อหนังสือ</th>
<th>วันที่พิมพ์</th>
<th>ประเภท</th>
<th>ราคา</th>
<th>ผู้แต่ง</th>
<th>จัดการ</th>
</tr>

<?php
$sql = "SELECT * FROM book";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
?>
<tr>
<td><?= $row['book_id'] ?></td>
<td><?= $row['book_name'] ?></td>
<td><?= $row['publish_date'] ?></td>
<td><?= $row['book_type'] ?></td>
<td><?= $row['price'] ?></td>
<td><?= $row['author_name'] ?></td>
<td>
    <a href="edit_book.php?id=<?= $row['book_id'] ?>" class="edit">แก้ไข</a>
    <a href="booklist.php?delete=<?= $row['book_id'] ?>"
       class="del"
       onclick="return confirm('ต้องการลบหนังสือเล่มนี้หรือไม่?');">
       ลบ
    </a>
</td>
</tr>
<?php } ?>

</table>

<br>
<center><a href="admin_home.php">⬅ กลับเมนู</a></center>

</body>
</html>