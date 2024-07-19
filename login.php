<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // echo "Username: " . $username . "<br>";
    // echo "Password: " . $password . "<br>"; 

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();//يستخرج البيانات كمصفوفة
        //echo "User found<br>";

        if (password_verify($password, $admin['password'])) {
            //echo "Password correct<br>"; 
            $_SESSION['admin_id'] = $admin['id'];
            header("Location: index.php");
            exit();
        } else {
            //echo "Invalid password<br>"; 
            $error = "Invalid password";
        }
    } else {
        //echo "No user found<br>"; 
        $error = "No user found with that username";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)): ?>
            <p ><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <a href="index.php"> 
            <button type="submit">Login</button>
            </a>
        </form>
    </div>
</body>
</html>
