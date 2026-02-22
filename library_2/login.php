<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Login</title>
<style>
body{
    font-family:Arial;
    background:linear-gradient(120deg,#2980b9,#6dd5fa);
}
.login-box{
    width:350px;
    background:#fff;
    margin:100px auto;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,0.2);
}
h2{text-align:center;}
input{
    width:100%;
    padding:8px;
    margin:6px 0;
}
button{
    width:100%;
    padding:10px;
    background:#2980b9;
    color:white;
    border:none;
    border-radius:5px;
}
.error{
    color:red;
    text-align:center;
}
</style>
</head>
<body>

<div class="login-box">
<h2>Login</h2>

<!-- เพิ่มส่วนแสดง error -->
<?php if(isset($_GET['error'])){ ?>
    <div class="error">Username หรือ Password ไม่ถูกต้อง</div>
<?php } ?>

<form action="check_login.php" method="post">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>
</div>

</body>
</html>