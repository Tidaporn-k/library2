<?php
session_start();
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM members 
        WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);

    $_SESSION['member_id'] = $row['member_id'];
    $_SESSION['fullname']  = $row['fullname'];
    $_SESSION['role']      = $row['role'];   // admin / member

    // ✅ เช็คสิทธิ์
    if($row['role'] == 'admin'){
        header("Location: admin_home.php");
        exit();
    }else{
        header("Location: index.php");
        exit();
    }
}else{
    echo "<script>
            alert('Username หรือ Password ไม่ถูกต้อง');
            window.location='login.php';
          </script>";
}
?>