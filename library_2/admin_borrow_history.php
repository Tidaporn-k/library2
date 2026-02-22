<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

$sql = "SELECT borrow.borrow_id, members.fullname, book.book_name,
               borrow.borrow_date, borrow.return_date
        FROM borrow
        INNER JOIN members ON borrow.member_id = members.member_id
        INNER JOIN book ON borrow.book_id = book.book_id
        ORDER BY borrow.borrow_id DESC";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ประวัติการยืม (Admin)</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f4f7;
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #0d6efd;
            color: white;
        }

        .status-borrow {
            color: red;
            font-weight: bold;
        }

        .status-return {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>📚 ประวัติการยืมทั้งหมด (Admin)</h2>

    <table>
        <tr>
            <th>รหัส</th>
            <th>ชื่อสมาชิก</th>
            <th>ชื่อหนังสือ</th>
            <th>วันที่ยืม</th>
            <th>วันที่คืน</th>
            <th>สถานะ</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['borrow_id']; ?></td>
                <td><?= $row['fullname']; ?></td>
                <td><?= $row['book_name']; ?></td>
                <td><?= $row['borrow_date']; ?></td>
                <td><?= $row['return_date'] ? $row['return_date'] : "-"; ?></td>
                <td>
                    <?php if ($row['return_date'] == NULL) { ?>
                        <span class="status-borrow">ยังไม่คืน</span>
                    <?php } else { ?>
                        <span class="status-return">คืนแล้ว</span>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="admin_home.php">← กลับเมนูแอดมิน</a>

</body>

</html>