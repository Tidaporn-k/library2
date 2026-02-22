<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>สมัครสมาชิก</title>
<style>
body{
    font-family: Arial;
    background:#f2f6fc;
}
.container{
    width:400px;
    margin:50px auto;
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
h2{text-align:center;color:#2c3e50;}
input{
    width:100%;
    padding:8px;
    margin:6px 0;
}
button{
    width:100%;
    padding:10px;
    background:#3498db;
    color:white;
    border:none;
    border-radius:5px;
}
button:hover{background:#2980b9;}
</style>
</head>
<body>

<div class="container">
<h2>สมัครสมาชิก</h2>
<form action="save_member.php" method="post">
<input type="text" name="fullname" placeholder="ชื่อ-นามสกุล" required>
<input type="date" name="birth_date" required>
<input type="text" name="phone" placeholder="เบอร์โทร" required>
<input type="text" name="address" placeholder="ที่อยู่" required>
<input type="email" name="email" placeholder="Email" required>
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">สมัครสมาชิก</button>
</form>
</div>

</body>
</html>