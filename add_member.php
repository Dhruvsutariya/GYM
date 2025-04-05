<?php
session_start();
if ($_SESSION['role'] != 'manager') {
    echo "Access Denied!";
    exit();
}
?>


<?php include('includes/db.php'); ?>

<head>
    <title>Add Member - GYM Manager</title>
    <link rel="stylesheet" href="assets/css/add_member.css">
</head>


<div class="form-container">
    <h2>Add New Member</h2>

    <form method="POST" action="">
    <label>Member Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" required><br><br>

    <label>Membership Fee (₹):</label><br>
    <input type="number" step="1000" name="fee" required><br><br>

    <label>Select Branch:</label><br>
    <select name="branch_id" required>
        <?php
        $branches = $conn->query("SELECT * FROM branches");
        while ($b = $branches->fetch_assoc()) {
            echo "<option value='{$b['id']}'>{$b['name']}</option>";
        }
        ?>
    </select><br><br>

    <input type="submit" name="submit" value="Add Member">
</form>    

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $fee = $_POST['fee'];
    $branch_id = $_POST['branch_id'];

    $sql = "INSERT INTO members (name, email, phone,membership_fee, branch_id)
            VALUES ('$name', '$email', '$phone',$fee, $branch_id)";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Member added successfully.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>
</div>





