<?php
include 'config.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if ($check && mysqli_num_rows($check) > 0) {
        $error = 'Username sudah digunakan';
    } else {
        mysqli_query($conn, "INSERT INTO users (username,password,role) VALUES ('$username','$password','user')");
        header('Location: login.php');
        exit;
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register - Rifki Store</title><link rel="stylesheet" href="assets/style.css"></head>
<body class="dark">
<div class="box">
  <h2>Register - Rifki Store</h2>
  <?php if($error): ?><div class="err"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="POST">
    <label>Username</label>
    <input type="text" name="username" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <button type="submit">Register</button>
  </form>
  <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>
