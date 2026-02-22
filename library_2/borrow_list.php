<?php
include("db.php");

$sql = "SELECT borrow.*, members.fullname, books.title
        FROM borrow
        JOIN members ON borrow.member_id = members.member_id
        JOIN books ON borrow.book_id = books.book_id";

$result = mysqli_query($conn, $sql);
?>

<h2>📄 รายการยืมหนังสือ</h2>

<table border="1" cellpadding="8">
<tr>
<th>ID</th>
<th>สมาชิก</th>
<th>หนังสือ</th>
<th>วันยืม</th>
<th>วันคืน</th>
<th>สถานะ</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?= $row['borrow_id']; ?></td>
<td><?= $row['fullname']; ?></td>
<td><?= $row['title']; ?></td>
<td><?= $row['borrow_date']; ?></td>
<td><?= $row['return_date']; ?></td>
<td><?= $row['status']; ?></td>
</tr>
<?php } ?>
</table>

<a href="index.php">⬅ กลับหน้าแรก</a>