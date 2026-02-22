<?php
include("db.php");

$member_id   = $_POST['member_id'];
$book_id     = $_POST['book_id'];
$borrow_date = $_POST['borrow_date'];
$return_date = $_POST['due_date']; // รับจากฟอร์ม แต่เก็บลง return_date

$sql = "INSERT INTO borrow (borrow_date, return_date, book_id, member_id)
        VALUES ('$borrow_date', '$return_date', '$book_id', '$member_id')";

if(mysqli_query($conn, $sql)){
    echo "<script>
            alert('บันทึกการยืมเรียบร้อยแล้ว');
            window.location='borrow.php';
          </script>";
}else{
    echo "Error: " . mysqli_error($conn);
}
?>