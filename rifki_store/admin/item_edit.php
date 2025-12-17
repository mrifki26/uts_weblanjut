<?php
include '../config.php';
include 'header.php';
$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM items WHERE id=$id");
$data = mysqli_fetch_assoc($q);
if (!$data) { echo '<script>alert("Item not found"); window.location="items.php";</script>'; exit; }
if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = intval($_POST['kategori']);
    $harga = intval($_POST['harga']);
    $stock = intval($_POST['stock']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $imageName = $data['image'];
    if (!empty($_FILES['gambar']['name'])) {
        $tmp = $_FILES['gambar']['tmp_name'];
        $orig = basename($_FILES['gambar']['name']);
        $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $orig);
        move_uploaded_file($tmp, 'upload/' . $imageName);
        if ($data['image']) @unlink('upload/' . $data['image']);
    }
    mysqli_query($conn, "UPDATE items SET name='$nama', kategori_id='$kategori', harga='$harga', stock='$stock', deskripsi='$deskripsi', image='$imageName' WHERE id=$id");
    header('Location: items.php'); exit;
}
$cats = mysqli_query($conn, "SELECT * FROM categories ORDER BY name ASC");
?>
<h1>Edit Item</h1>
<form method="POST" enctype="multipart/form-data">
  <label>Name</label>
  <input name="nama" value="<?= htmlspecialchars($data['name']) ?>" required>
  <label>Category</label>
  <select name="kategori" required>
    <?php while($c = mysqli_fetch_assoc($cats)): $sel = ($c['id']==$data['kategori_id'])? 'selected':''; ?>
      <option value="<?= $c['id'] ?>" <?= $sel ?>><?= htmlspecialchars($c['name']) ?></option>
    <?php endwhile; ?>
  </select>
  <label>Price</label>
  <input name="harga" type="number" value="<?= $data['harga'] ?>" required>
  <label>Stock</label>
  <input name="stock" type="number" value="<?= $data['stock'] ?>" required>
  <label>Description</label>
  <textarea name="deskripsi"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
  <label>Image</label>
  <input type="file" name="gambar" accept="image/*">
  <?php if ($data['image']): ?>
    <div style="margin-top:8px;"><img src="upload/<?= htmlspecialchars($data['image']) ?>" width="120"></div>
  <?php endif; ?>
  <br><br>
  <button name="update">Update</button>
  <a href="items.php">Cancel</a>
</form>
<?php include 'footer.php'; ?>