<?php
include 'dbcon.php';

 // SDF_FINAL\sdf_final\admin\


$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM tb_admin WHERE email ='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    $hashedPassword = $admin['password'];
   
    // Verify the entered password against the hashed password
    if (password_verify($password, $hashedPassword)) {
        session_start();
        $_SESSION['admin_id'] = $admin['id'];
        $conn->close();
        header('Location: admin_dashboard.php'); // Redirect to admin dashboard upon successful login
    } else {
        header("Location: admin_reglog.php?error=Invalid credentials"); // Incorrect password
    }
} else {
    header("Location: admin_reglog.php?error=User not found"); // Admin email not registered
}
?>
