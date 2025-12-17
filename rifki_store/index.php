<?php
include 'config.php';
$search = mysqli_real_escape_string($conn, $_GET['q'] ?? '');
$sql = "SELECT items.*, categories.name AS category_name FROM items LEFT JOIN categories ON items.kategori_id = categories.id";
if ($search !== '') {
    $sql .= " WHERE items.name LIKE '%".mysqli_real_escape_string($conn, $search)."%'";
}
$res = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Rifki Store</title><link rel="stylesheet" href="assets/style.css"></head>
<body class="dark">
<?php include 'includes/header.php'; ?>
<main class="container">
  <h1>Rifki Store</h1>
  <form method="GET" class="search">
    <input name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cari item...">
    <button>Search</button>
  </form>
  <div class="grid">
    <?php while($row = mysqli_fetch_assoc($res)): ?>
      <div class="card">
        <img src="<?= 'admin/upload/'.($row['image']?:'placeholder.png') ?>" alt="" />
        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p class="muted"><?= htmlspecialchars($row['category_name']?:'-') ?></p>
        <p class="price">Rp <?= number_format($row['harga']) ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>
