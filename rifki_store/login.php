<?php
include 'config.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if ($q && mysqli_num_rows($q) == 1) {
        $user = mysqli_fetch_assoc($q);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] === 'admin') header('Location: admin/dashboard.php');
        else header('Location: index.php');
        exit;
    } else {
        $error = 'Username atau password salah';
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login - Rifki Store</title><link rel="stylesheet" href="assets/style.css"></head>
<body class="dark">
<div class="box">
  <h2>Login - Rifki Store</h2>
  <?php if($error): ?><div class="err"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="POST">
    <label>Username</label>
    <input type="text" name="username" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
  </form>
  <p>Belum punya akun? <a href="register.php">Register</a></p>
</div>
</body>
</html>
