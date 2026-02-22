<?php
include("db.php");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM members WHERE member_id='$id'");
    header("Location: memberlist.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM members");
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>จัดการสมาชิก</title>
<style>
body{
    font-family: Tahoma;
    background:#f2f5f8;
}
.box{
    width:90%;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
}
h2{
    margin-bottom:20px;
}
.top-btn{
    margin-bottom:20px;
}
.btn-add{
    background:#0d6efd;
    color:white;
    padding:10px 18px;
    border-radius:10px;
    text-decoration:none;
}
.btn-home{
    background:#6c757d;
    color:white;
    padding:10px 18px;
    border-radius:10px;
    text-decoration:none;
}
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#198754;
    color:white;
    padding:10px;
}
td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:center;
}
.btn-edit{
    background:#0dcaf0;
    color:white;
    padding:6px 12px;
    border-radius:8px;
    text-decoration:none;
}
.btn-delete{
    background:#dc3545;
    color:white;
    padding:6px 12px;
    border-radius:8px;
    text-decoration:none;
}
</style>
</head>
<body>

<div class="box">
<h2>👤 รายชื่อสมาชิก</h2>

<div class="top-btn">
    <a href="member_add.php" class="btn-add">➕ เพิ่มสมาชิก</a>
    <a href="admin_menu.php" class="btn-home">🏠 กลับหน้าหลัก</a>
</div>

<table>
<tr>
    <th>ID</th>
    <th>ชื่อ-นามสกุล</th>
    <th>วันเกิด</th>
    <th>โทรศัพท์</th>
    <th>Email</th>
    <th>Username</th>
    <th>Role</th>
    <th>จัดการ</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['member_id']; ?></td>
    <td><?php echo $row['fullname']; ?></td>
    <td><?php echo $row['birth_date']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['role']; ?></td>
    <td>
        <a href="member_edit.php?id=<?php echo $row['member_id']; ?>" class="btn-edit">✏️ แก้ไข</a>
        <a href="memberlist.php?delete=<?php echo $row['member_id']; ?>"
           onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?');"
           class="btn-delete">🗑️ ลบ</a>
    </td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>