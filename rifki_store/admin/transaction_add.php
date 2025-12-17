<?php
include '../config.php';
include 'header.php';
if (isset($_POST['simpan'])) {
    $item = intval($_POST['item']);
    $qty = intval($_POST['qty']);
    $buyer = mysqli_real_escape_string($conn, $_POST['buyer']);
    $q = mysqli_query($conn, "SELECT * FROM items WHERE id=$item");
    $d = mysqli_fetch_assoc($q);
    if (!$d) { echo '<script>alert("Item not found"); window.location="transactions.php";</script>'; exit; }
    if ($qty > $d['stock']) { echo '<script>alert("Stok tidak cukup"); history.back();</script>'; exit; }
    $total = $d['harga'] * $qty;
    mysqli_query($conn, "INSERT INTO transactions (item_id,qty,total_price,buyer) VALUES ($item,$qty,$total,'$buyer')");
    $sisa = $d['stock'] - $qty;
    mysqli_query($conn, "UPDATE items SET stock=$sisa WHERE id=$item");
    header('Location: transactions.php'); exit;
}
$items = mysqli_query($conn, "SELECT * FROM items ORDER BY name ASC");
?>
<h1>Add Transaction</h1>
<form method="POST">
  <label>Buyer</label>
  <input name="buyer" required>
  <label>Item</label>
  <select name="item" required>
    <option value="" disabled selected>-- Pilih Item --</option>
    <?php while($it = mysqli_fetch_assoc($items)): ?>
      <option value="<?= $it['id'] ?>"><?= htmlspecialchars($it['name']) ?> (Stock: <?= $it['stock'] ?>)</option>
    <?php endwhile; ?>
  </select>
  <label>Qty</label>
  <input name="qty" type="number" min="1" value="1" required>
  <br><br>
  <button name="simpan">Save</button>
  <a href="transactions.php">Cancel</a>
</form>
<?php include 'footer.php'; ?>