<?php
include("db.php");

if (isset($_POST['save_fine'])) {
    $borrow_id = $_POST['borrow_id'];
    $member_id = $_POST['member_id'];
    $payment_type = $_POST['payment_type'];
    $amount = $_POST['amount'];
    $note = $_POST['note'];

    $sql = "INSERT INTO payment_history 
            (borrow_id, member_id, payment_type, amount, payment_date, note)
            VALUES ('$borrow_id','$member_id','$payment_type','$amount',CURDATE(),'$note')";
    mysqli_query($conn,$sql);

    echo "<script>alert('บันทึกค่าปรับเรียบร้อย');location='admin_borrow_manage.php';</script>";
}

$sql = "SELECT borrow.borrow_id, borrow.borrow_date, borrow.return_date,
               book.book_name, members.fullname, members.member_id
        FROM borrow
        JOIN book ON borrow.book_id = book.book_id
        JOIN members ON borrow.member_id = members.member_id";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>จัดการค่าปรับ</title>
<style>
body{font-family:tahoma;background:#f2f2f2}
table{border-collapse:collapse;width:100%;background:white}
th,td{border:1px solid #ccc;padding:8px;text-align:center}
th{background:#0d6efd;color:white}
.late{background:#ffe0e0}
input,select,textarea{padding:5px;width:100%}
button{background:#28a745;color:white;border:none;padding:5px 10px}
</style>
</head>
<body>

<h2 align="center">จัดการค่าปรับ</h2>

<table>
<tr>
<th>รหัสยืม</th>
<th>สมาชิก</th>
<th>หนังสือ</th>
<th>กำหนดคืน</th>
<th>สถานะ</th>
<th>ค่าปรับ</th>
<th>ประเภท</th>
<th>หมายเหตุ</th>
<th>บันทึก</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)):
$status = (date("Y-m-d") > $row['return_date']) ? "ยังไม่คืน" : "ปกติ";
$class = ($status=="ยังไม่คืน") ? "late" : "";
?>

<tr class="<?=$class?>">
<form method="post">
<td><?=$row['borrow_id']?></td>
<td><?=$row['fullname']?></td>
<td><?=$row['book_name']?></td>
<td><?=$row['return_date']?></td>
<td><?=$status?></td>

<td>
<input type="number" name="amount" value="20">
</td>

<td>
<select name="payment_type">
<option value="late">คืนช้า</option>
<option value="damage">ชำรุด</option>
<option value="lost">หาย</option>
</select>
</td>

<td>
<textarea name="note" rows="2" placeholder="ใส่หมายเหตุ"></textarea>
</td>

<td>
<input type="hidden" name="borrow_id" value="<?=$row['borrow_id']?>">
<input type="hidden" name="member_id" value="<?=$row['member_id']?>">
<button name="save_fine">บันทึก</button>
</td>
</form>
</tr>

<?php endwhile; ?>
</table>

<br>
<a href="admin_home.php">← กลับเมนู</a>

</body>
</html>