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

include('includes/db.php');
?>

<head>
    <title>Add Branch - GYM Manager</title>
    <link rel="stylesheet" href="assets/css/add_branch.css">
</head>

<div class="form-container">
    <h2>Add New Branch</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        <label>Branch Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Address:</label><br>
        <input type="text" name="address" required><br><br>

        <label>Contact Number:</label><br>
        <input type="text" name="contact" required><br><br>

        <label>Upload Branch Image:</label><br>
        <input type="file" name="image" accept="image/*" required><br><br>

        <input type="submit" name="submit" value="Add Branch">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        $target_dir = "uploads/";
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . time() . "_" . $image_name; // Unique filename
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<p style='color:red;'>Only JPG, JPEG, PNG, & GIF files are allowed.</p>";
            exit();
        }

        if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
            echo "<p style='color:red;'>Image size should be less than 5MB.</p>";
            exit();
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO branches (name, address, contact_number, image)
                    VALUES ('$name', '$address', '$contact', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Branch added successfully.</p>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Error uploading image.</p>";
        }
    }
    ?>
</div>
