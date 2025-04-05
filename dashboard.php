<?php include('includes/db.php'); ?>

<head>
    <title>Dashboard - GYM Manager</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<div class="dashboard-container">
    <h2>Dashboard</h2>

   
    <h3>All Branches</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact</th>
    </tr>
    <?php
    $sql = "SELECT * FROM branches";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['address']}</td>
                <td>{$row['contact_number']}</td>
              </tr>";
    }
    ?>
</table>
</div>


