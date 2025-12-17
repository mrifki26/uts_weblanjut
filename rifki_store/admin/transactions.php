<?php
include '../config.php';
include 'header.php';
$trx = mysqli_query($conn, "SELECT t.*, items.name AS item_name FROM transactions t JOIN items ON t.item_id = items.id ORDER BY t.id DESC");
?>
<h1>Transactions</h1>
<a href="transaction_add.php">+ Add Transaction</a>
<table border="1" width="100%" cellpadding="8" style="margin-top:12px;">
<tr><th>#</th><th>Item</th><th>Qty</th><th>Total</th><th>Buyer</th><th>Date</th></tr>
<?php $no=1; while($r = mysqli_fetch_assoc($trx)): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($r['item_name']) ?></td>
    <td><?= $r['qty'] ?></td>
    <td>Rp <?= number_format($r['total_price']) ?></td>
    <td><?= htmlspecialchars($r['buyer']) ?></td>
    <td><?= $r['created_at'] ?></td>
  </tr>
<?php endwhile; ?>
</table>
<?php include 'footer.php'; ?>