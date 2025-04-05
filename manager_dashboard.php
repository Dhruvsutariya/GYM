<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'manager') {
    echo "Access Denied!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="assets/css/manager_dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <h2>Manager Dashboard</h2>
    <ul>
        <li><a href="add_member.php">Add Member</a></li>
        <li><a href="view_members.php">View Members</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

</body>
</html>
