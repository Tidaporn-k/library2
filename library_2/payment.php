<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ค่าปรับ</title>
<style>
table{border-collapse:collapse;width:80%;margin:auto;}
th,td{border:1px solid #ccc;padding:10px;text-align:center;}
th{background:#dc3545;color:white;}
form{text-align:center;margin:20px;}
</style>
</head>
<body>

<h2 align="center">💰 ค่าปรับ</h2>

<form method="post">
Borrow ID: <input type="number" name="borrow_id" required>
จำนวนเงิน: <input type="number" name="amount" required>
<button type="submit" name="pay">บันทึก</button>
</form>

<?php
if(isset($_POST['pay'])){
$b=$_POST['borrow_id'];
$a=$_POST['amount'];
mysqli_query($conn,"INSERT INTO payment_history(borrow_id,amount,pay_date) VALUES('$b','$a',NOW())");
}
?>

<table>
<tr><th>ID</th><th>Borrow</th><th>จำนวนเงิน</th><th>วันที่จ่าย</th></tr>
<?php
$res=mysqli_query($conn,"SELECT * FROM payment_history");
while($row=mysqli_fetch_assoc($res)){
echo "<tr>
<td>{$row['payment_id']}</td>
<td>{$row['borrow_id']}</td>
<td>{$row['amount']}</td>
<td>{$row['pay_date']}</td>
</tr>";
}
?>
</table>

<p align="center"><a href="index.php">⬅ กลับเมนู</a></p>

</body>
</html>