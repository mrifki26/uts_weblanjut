<?php
include '../config.php';
include 'header.php';
if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = intval($_POST['kategori']);
    $harga = intval($_POST['harga']);
    $stock = intval($_POST['stock']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $imageName = '';
    if (!empty($_FILES['gambar']['name'])) {
        $tmp = $_FILES['gambar']['tmp_name'];
        $orig = basename($_FILES['gambar']['name']);
        $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $orig);
        move_uploaded_file($tmp, 'upload/' . $imageName);
    }
    mysqli_query($conn, "INSERT INTO items (name,kategori_id,harga,stock,deskripsi,image) VALUES ('$nama','$kategori','$harga','$stock','$deskripsi','$imageName')");
    header('Location: items.php'); exit;
}
$cats = mysqli_query($conn, "SELECT * FROM categories ORDER BY name ASC");
?>
<h1>Add Item</h1>
<form method="POST" enctype="multipart/form-data">
  <label>Name</label>
  <input name="nama" required>
  <label>Category</label>
  <select name="kategori" required>
    <option value="" disabled selected>-- Pilih Kategori --</option>
    <?php while($c = mysqli_fetch_assoc($cats)): ?>
      <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
    <?php endwhile; ?>
  </select>
  <label>Price</label>
  <input name="harga" type="number" required>
  <label>Stock</label>
  <input name="stock" type="number" required>
  <label>Description</label>
  <textarea name="deskripsi"></textarea>
  <label>Image</label>
  <input type="file" name="gambar" accept="image/*">
  <br><br>
  <button name="simpan">Save</button>
  <a href="items.php">Cancel</a>
</form>
<?php include 'footer.php'; ?>