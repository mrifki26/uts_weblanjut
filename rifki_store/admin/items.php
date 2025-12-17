<?php
include '../config.php';
include 'header.php';
$no = 1;
$query = mysqli_query($conn, "SELECT items.*, categories.name AS nama_kategori FROM items LEFT JOIN categories ON items.kategori_id = categories.id ORDER BY items.id DESC");
if (!$query) { die('Query Error: ' . mysqli_error($conn)); }
?>
<h1>Manage Items</h1>
<a href="item_tambah.php">+ Add Item</a>
<table border="1" width="100%" cellpadding="8" style="margin-top:12px;">
<tr><th>No</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Image</th><th>Action</th></tr>
<?php if (mysqli_num_rows($query) > 0) {
  while($row = mysqli_fetch_assoc($query)) { ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['nama_kategori']?:'-') ?></td>
      <td>Rp <?= number_format($row['harga']) ?></td>
      <td><?= $row['stock'] ?></td>
      <td style="text-align:center;">
        <?php if ($row['image']): ?>
          <img src="upload/<?= htmlspecialchars($row['image']) ?>" width="70">
        <?php else: echo '-'; endif; ?>
      </td>
      <td>
        <a href="item_edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="item_hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete item?')">Delete</a>
      </td>
    </tr>
<?php } } else { ?>
  <tr><td colspan="7" style="text-align:center">No items yet</td></tr>
<?php } ?>
</table>
<?php include 'footer.php'; ?>