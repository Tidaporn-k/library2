<?php include("db.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>จัดการหนังสือ</title>
<style>
table{border-collapse:collapse;width:80%;margin:auto;}
th,td{border:1px solid #ccc;padding:10px;text-align:center;}
th{background:#0d6efd;color:white;}
form{text-align:center;margin:20px;}
</style>
</head>
<body>

<h2 align="center">📚 จัดการหนังสือ</h2>

<form method="post">
ชื่อหนังสือ: <input type="text" name="title" required>
ผู้แต่ง: <input type="text" name="author" required>
<button type="submit" name="add">เพิ่ม</button>
</form>

<?php
if(isset($_POST['add'])){
    $title=$_POST['title'];
    $author=$_POST['author'];
    mysqli_query($conn,"INSERT INTO book(title,author) VALUES('$title','$author')");
}
?>

<table>
<tr><th>ID</th><th>ชื่อหนังสือ</th><th>ผู้แต่ง</th></tr>
<?php
$res=mysqli_query($conn,"SELECT * FROM book");
while($row=mysqli_fetch_assoc($res)){
echo "<tr>
<td>{$row['book_id']}</td>
<td>{$row['title']}</td>
<td>{$row['author']}</td>
</tr>";
}
?>
</table>

<p align="center"><a href="index.php">⬅ กลับเมนู</a></p>

</body>
</html>