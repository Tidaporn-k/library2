<?php
session_start();
include "db.php";

// ถ้าไม่ได้ login
if(!isset($_SESSION['member_id'])){
    header("Location: login.php");
    exit();
}

$isAdmin = false;
if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    $isAdmin = true;
}

// SQL แยก admin / member
if($isAdmin){
    // Admin ดูทั้งหมด
    $sql = "SELECT 
                payment_history.payment_id,
                members.fullname,
                book.book_name,
                payment_history.payment_type,
                payment_history.amount,
                payment_history.payment_date,
                payment_history.note
            FROM payment_history
            INNER JOIN members ON payment_history.member_id = members.member_id
            INNER JOIN borrow ON payment_history.borrow_id = borrow.borrow_id
            INNER JOIN book ON borrow.book_id = book.book_id
            ORDER BY payment_history.payment_id DESC";
}else{
    // Member ดูเฉพาะของตัวเอง
    $member_id = $_SESSION['member_id'];
    $sql = "SELECT 
                payment_history.payment_id,
                book.book_name,
                payment_history.payment_type,
                payment_history.amount,
                payment_history.payment_date,
                payment_history.note
            FROM payment_history
            INNER JOIN borrow ON payment_history.borrow_id = borrow.borrow_id
            INNER JOIN book ON borrow.book_id = book.book_id
            WHERE payment_history.member_id = '$member_id'
            ORDER BY payment_history.payment_id DESC";
}

$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ค่าปรับ</title>
<style>
body{
    font-family: Arial, sans-serif;
    background:#f2f4f7;
    margin:0;
}
.header{
    background:#005bbb;
    color:white;
    padding:10px 20px;
    display:flex;
    justify-content:space-between;
}
.header a{color:white;text-decoration:none;margin-right:15px;font-weight:bold;}
.banner{
    background:white;
    width:90%;
    margin:20px auto;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:center;
}
th{
    background:#005bbb;
    color:white;
}
.type-late{color:orange;font-weight:bold;}
.type-damage{color:red;font-weight:bold;}
.type-lost{color:darkred;font-weight:bold;}
.back{
    text-align:center;
    margin-top:15px;
}
.back a{
    color:#005bbb;
    text-decoration:none;
    font-weight:bold;
}
</style>
</head>
<body>

<div class="header">
    <div>📚 My Library</div>
    <div>
        <a href="index.php">หน้าแรก</a>
        <a href="borrow_history.php">ประวัติยืม</a>
        <a href="logout.php">ออกจากระบบ</a>
    </div>
</div>

<div class="banner">
    <h2>
        💰 
        <?php if($isAdmin){ ?>
            จัดการค่าปรับทั้งหมด
        <?php }else{ ?>
            ค่าปรับของฉัน
        <?php } ?>
    </h2>

    <table>
        <tr>
            <th>รหัส</th>
            <?php if($isAdmin){ ?><th>สมาชิก</th><?php } ?>
            <th>ชื่อหนังสือ</th>
            <th>ประเภท</th>
            <th>จำนวนเงิน</th>
            <th>วันที่</th>
            <th>หมายเหตุ</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?= $row['payment_id']; ?></td>

            <?php if($isAdmin){ ?>
                <td><?= $row['fullname']; ?></td>
            <?php } ?>

            <td><?= $row['book_name']; ?></td>

            <td>
                <?php 
                if($row['payment_type']=='late'){
                    echo "<span class='type-late'>คืนช้า</span>";
                }elseif($row['payment_type']=='damage'){
                    echo "<span class='type-damage'>ชำรุด</span>";
                }elseif($row['payment_type']=='lost'){
                    echo "<span class='type-lost'>ทำหาย</span>";
                }else{
                    echo $row['payment_type'];
                }
                ?>
            </td>

            <td><?= number_format($row['amount'],2); ?> บาท</td>
            <td><?= $row['payment_date']; ?></td>
            <td><?= $row['note']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <div class="back">
        <a href="index.php">← กลับหน้าแรก</a>
    </div>
</div>

</body>
</html>