<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Admin - Rifki Store</title><link rel="stylesheet" href="../assets/style.css"></head>
<body class="dark">
<nav class="site-header">
  <div class="container">
    <a class="brand" href="dashboard.php">Rifki Store - Admin</a>
    <div>
      <a href="dashboard.php">Dashboard</a>
      <a href="categories.php">Categories</a>
      <a href="items.php">Items</a>
      <a href="transactions.php">Transactions</a>
      <a href="../logout.php">Logout</a>
    </div>
  </div>
</nav>
<div class="container">
