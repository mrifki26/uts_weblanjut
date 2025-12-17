<?php
include '../config.php';
include 'header.php';

$total_categories = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT COUNT(*) AS c FROM categories'))['c'];
$total_items = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT COUNT(*) AS c FROM items'))['c'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM users WHERE role='user'"))['c'];
$total_trx = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT COUNT(*) AS c FROM transactions'))['c'];
?>
<h1>Admin Dashboard</h1>
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-top:12px;">
  <div class="card">Categories<br><strong><?= $total_categories ?></strong></div>
  <div class="card">Items<br><strong><?= $total_items ?></strong></div>
  <div class="card">Users<br><strong><?= $total_users ?></strong></div>
  <div class="card">Transactions<br><strong><?= $total_trx ?></strong></div>
</div>
<?php include 'footer.php'; ?>