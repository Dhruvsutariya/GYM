<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] != 'owner') {
    echo "Access Denied!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="assets/css/owner_dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <h2>Owner Dashboard</h2>
    <ul>
        <li><a href="select_branches.php">View Branch</a></li>
        <li><a href="add_branch.php">Add Branch</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

</body>
</html>
