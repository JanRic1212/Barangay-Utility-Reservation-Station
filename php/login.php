<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch admin credentials from tbladmin
    $sql = "SELECT admin_id, first_name, last_name, email_address, password FROM tbladmin WHERE email_address = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin) {
        // Check if the password is correct
        if (password_verify($password, $admin['password'])) {
            $_SESSION['user_id'] = $admin['admin_id'];
            $_SESSION['role'] = 'admin';
            $_SESSION['admin_name'] = $admin['first_name'] . " " . $admin['last_name']; // Store admin name

            header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            exit();
        } else {
            echo "<p style='color:red;'>Invalid email or password.</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid email or password.</p>";
    }
}
?>
<link rel="stylesheet" href="../css/style.css">
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
    <a href="../index.php">Back</a>
</form>
