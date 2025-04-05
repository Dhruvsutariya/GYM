<?php
session_start();
if ($_SESSION['role'] != 'owner') {
    echo "Access Denied!";
    exit();
}
include('includes/db.php');

$branch_id = $_GET['branch_id'];

$query = "SELECT members.* FROM members WHERE branch_id = $branch_id";
$result = $conn->query($query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Members</title>
    <link rel="stylesheet" href="assets/css/view_branch_members.css">
</head>
<body>

<div class="members-container">
    <h2>Members of Selected Branch</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Membership Fee (₹)</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td>₹<?= $row['membership_fee'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>

