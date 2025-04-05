<?php
session_start();
if ($_SESSION['role'] != 'owner') {
    echo "Access Denied!";
    exit();
}
include('includes/db.php');

if (isset($_POST['delete_branch'])) {
    $branch_id = $_POST['branch_id'];
    $stmt = $conn->prepare("DELETE FROM branches WHERE id = ?");
    $stmt->bind_param("i", $branch_id);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <style>
        .view-btn, .delete-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #ffcc00;
            color: #000;
        }

        .view-btn:hover, .delete-btn:hover {
            background-color: #e6b800;
        }

        .inline-form {
            display: inline;
        }
    </style>
    <link rel="stylesheet" href="assets/css/select_branches.css">
</head>
<body>

<div class="branch-container">
    <h2>Available Branches</h2>
    <div class="branch-list">
        <?php
        $query = "SELECT * FROM branches";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='branch-card'>
                <img src='{$row['image']}' alt='{$row['name']}' class='branch-img'>
                <div class='branch-details'>
                    <h3>{$row['name']}</h3>
                    <p>{$row['address']}</p>
                    <p>Contact: {$row['contact_number']}</p>
                    <div class='button-group'>
                        <a href='view_branch_members.php?branch_id={$row['id']}' class='view-btn'>View Members</a>
                        <form method='POST' class='inline-form' onsubmit='return confirm(\"Are you sure you want to delete this branch?\")'>
                            <input type='hidden' name='branch_id' value='{$row['id']}'>
                            <button type='submit' name='delete_branch' class='delete-btn'>Delete</button>
                        </form>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</div>

</body>
</html>
