<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "library";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if ($conn) {
    echo "✅ เชื่อมต่อฐานข้อมูลสำเร็จ";
} else {
    echo "❌ เชื่อมต่อฐานข้อมูลไม่สำเร็จ";
}
?>