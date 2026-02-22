<?php
include("db.php");

if (isset($_POST['submit'])) {
    $fullname   = $_POST['fullname'];
    $birth_date = $_POST['birth_date'];
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];
    $email      = $_POST['email'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $role       = $_POST['role'];

    $sql = "INSERT INTO members 
    (fullname, birth_date, phone, address, email, username, password, role)
    VALUES 
    ('$fullname', '$birth_date', '$phone', '$address', '$email', '$username', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        header("Location: memberlist.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>เพิ่มสมาชิก</title>
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
    background:#198754;
    color:white;
    border:none;
    padding:12px;
    border-radius:10px;
    width:100%;
    font-size:16px;
}
</style>
</head>
<body>

<div class="box">
<h2>➕ เพิ่มสมาชิก</h2>

<form method="post">
    <label>ชื่อ-นามสกุล</label>
    <input type="text" name="fullname" required>

    <label>วันเกิด</label>
    <input type="date" name="birth_date">

    <label>เบอร์โทร</label>
    <input type="text" name="phone">

    <label>ที่อยู่</label>
    <input type="text" name="address">

    <label>Email</label>
    <input type="email" name="email">

    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="text" name="password" required>

    <label>Role</label>
    <select name="role">
        <option value="member">member</option>
        <option value="admin">admin</option>
    </select>

    <button type="submit" name="submit">บันทึก</button>
</form>

<br>
<a href="memberlist.php">← กลับหน้ารายชื่อสมาชิก</a>

</div>

</body>
</html>