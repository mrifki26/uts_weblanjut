<header class="site-header">
  <div class="container">
    <a class="brand" href="index.php">Rifki Store</a>
    <nav>
      <a href="index.php">Home</a>
      <?php if(isset($_SESSION['login']) && $_SESSION['role'] === 'user'): ?>
        <span class="muted">Hi, <?= htmlspecialchars($_SESSION['username']) ?></span>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
