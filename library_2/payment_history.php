<?php
include "db.php";

$sql = "SELECT 
            payment_history.payment_id,
            payment_history.borrow_id,
            members.fullname,
            payment_history.payment_type,
            payment_history.amount,
            payment_history.payment_date,
            payment_history.note
        FROM payment_history
        INNER JOIN members ON payment_history.member_id = members.member_id
        ORDER BY payment_history.payment_id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ประวัติค่าปรับ</title>
<style>
body{
    font-family: Arial, sans-serif;
    background:#f2f4f8;
    padding:40px;
}
h2{
    text-align:center;
    margin-bottom:20px;
}
table{
    width:95%;
    margin:auto;
    border-collapse:collapse;
    background:white;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}
th{
    background:#198754;
    color:white;
    padding:10px;
}
td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}
.type-late{
    color:orange;
    font-weight:bold;
}
.type-damage{
    color:red;
    font-weight:bold;
}
.type-lost{
    color:purple;
    font-weight:bold;
}
.back{
    display:block;
    text-align:center;
    margin-top:20px;
    text-decoration:none;
    color:#198754;
    font-weight:bold;
}
</style>
</head>
<body>

<h2>💰 ประวัติค่าปรับ</h2>

<table>
<tr>
    <th>รหัส</th>
    <th>รหัสการยืม</th>
    <th>ชื่อสมาชิก</th>
    <th>ประเภท</th>
    <th>จำนวนเงิน</th>
    <th>วันที่ชำระ</th>
    <th>หมายเหตุ</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?= $row['payment_id']; ?></td>
    <td><?= $row['borrow_id']; ?></td>
    <td><?= $row['fullname']; ?></td>
    <td>
        <?php if($row['payment_type'] == 'late'){ ?>
            <span class="type-late">เกินกำหนด</span>
        <?php }elseif($row['payment_type'] == 'damage'){ ?>
            <span class="type-damage">ชำรุด</span>
        <?php }else{ ?>
            <span class="type-lost">สูญหาย</span>
        <?php } ?>
    </td>
    <td><?= number_format($row['amount'],2); ?> บาท</td>
    <td><?= $row['payment_date']; ?></td>
    <td><?= $row['note']; ?></td>
</tr>
<?php } ?>

</table>

<a href="admin_home.php" class="back">← กลับเมนูผู้ดูแล</a>

</body>
</html>