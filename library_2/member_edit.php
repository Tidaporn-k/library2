<?php
include("db.php");

if (!isset($_GET['id'])) {
    header("Location: memberlist.php");
    exit();
}

$id = $_GET['id'];

/* ดึงข้อมูลเดิม */
$result = mysqli_query($conn, "SELECT * FROM members WHERE member_id='$id'");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "ไม่พบข้อมูลสมาชิก";
    exit();
}

/* เมื่อกดบันทึก */
if (isset($_POST['submit'])) {
    $fullname   = $_POST['fullname'];
    $birth_date = $_POST['birth_date'];
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];
    $email      = $_POST['email'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $role       = $_POST['role'];

    $sql = "UPDATE members SET
        fullname='$fullname',
        birth_date='$birth_date',
        phone='$phone',
        address='$address',
        email='$email',
        username='$username',
        password='$password',
        role='$role'
        WHERE member_id='$id'
    ";

    if (mysqli_query($conn, $sql)) {
        header("Location: memberlist.php");
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
<title>แก้ไขสมาชิก</title>
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
    background:#0dcaf0;
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
<h2>✏️ แก้ไขข้อมูลสมาชิก</h2>

<form method="post">
    <label>ชื่อ-นามสกุล</label>
    <input type="text" name="fullname" value="<?php echo $row['fullname']; ?>" required>

    <label>วันเกิด</label>
    <input type="date" name="birth_date" value="<?php echo $row['birth_date']; ?>">

    <label>เบอร์โทร</label>
    <input type="text" name="phone" value="<?php echo $row['phone']; ?>">

    <label>ที่อยู่</label>
    <input type="text" name="address" value="<?php echo $row['address']; ?>">

    <label>Email</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>">

    <label>Username</label>
    <input type="text" name="username" value="<?php echo $row['username']; ?>" required>

    <label>Password</label>
    <input type="text" name="password" value="<?php echo $row['password']; ?>" required>

    <label>Role</label>
    <select name="role">
        <option value="member" <?php if($row['role']=="member") echo "selected"; ?>>member</option>
        <option value="admin" <?php if($row['role']=="admin") echo "selected"; ?>>admin</option>
    </select>

    <button type="submit" name="submit">บันทึกการแก้ไข</button>
</form>

<a href="memberlist.php">← กลับหน้ารายชื่อสมาชิก</a>
</div>

</body>
</html>