<?php
include "db.php";

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role'];   // admin หรือ member

$sql = "INSERT INTO members (fullname, username, password, role)
        VALUES ('$fullname', '$username', '$password', '$role')";

if(mysqli_query($conn, $sql)){
    echo "<script>
            alert('สมัครสมาชิกสำเร็จ');
            window.location='login.php';
          </script>";
}else{
    echo "Error: " . mysqli_error($conn);
}
?>