<?php
session_start();
if ($_SESSION['role'] != 'manager') {
    echo "Access Denied!";
    exit();
}

include('includes/db.php');

if (isset($_POST['delete_member'])) {
    $member_id = $_POST['member_id'];
    $delete_query = "DELETE FROM members WHERE id = $member_id";
    $conn->query($delete_query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Members - GYM Manager</title>
    <link rel="stylesheet" href="assets/css/view_members.css">
    <style>
        .delete-btn {
            padding: 6px 12px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }

        .inline-form {
            display: inline;
        }
    </style>
</head>

<body>
    <div class="members-container">
        <h2>All Members</h2>
        <table border="1" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Fee (₹)</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT members.*, branches.name AS branch_name 
                    FROM members 
                    JOIN branches ON members.branch_id = branches.id";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['membership_fee']}</td>
                        <td>{$row['branch_name']}</td>
                        <td>
                            <form method='POST' class='inline-form' onsubmit=\"return confirm('Are you sure you want to delete this member?');\">
                                <input type='hidden' name='member_id' value='{$row['id']}'>
                                <button type='submit' name='delete_member' class='delete-btn'>Delete</button>
                                
                            </form>
                        </td>
                    </tr>";
            }
            $check = $conn->query("SELECT COUNT(*) as total FROM members");
            $count = $check->fetch_assoc()['total'];
            
            if ($count == 0) {
                $conn->query("ALTER TABLE members AUTO_INCREMENT = 1");
            }

            ?>
        </table>
    </div>
</body>
</html>
