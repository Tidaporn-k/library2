<?php
include "db.php";

$borrow_id = $_GET['id'];

$sql = "UPDATE borrow 
        SET status='returned',
            return_date = CURDATE()
        WHERE borrow_id='$borrow_id'";

mysqli_query($conn,$sql);

header("location: borrow_history.php");
?>