<?php
include '../config.php';
include 'header.php';
if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    mysqli_query($conn, "INSERT INTO categories (name) VALUES ('$name')");
    header('Location: categories.php'); exit;
}
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM categories WHERE id=$id");
    header('Location: categories.php'); exit;
}
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    mysqli_query($conn, "UPDATE categories SET name='$name' WHERE id=$id");
    header('Location: categories.php'); exit;
}
$cats = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
?>
<h1>Manage Categories</h1>
<form method="POST" style="margin-bottom:12px;">
  <input name="name" placeholder="New category name" required>
  <button name="add">Add Category</button>
</form>
<table border="1" width="100%" cellpadding="8">
  <tr><th>#</th><th>Name</th><th>Action</th></tr>
  <?php $no=1; while($c = mysqli_fetch_assoc($cats)): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($c['name']) ?></td>
      <td>
        <a href="?edit_form=<?= $c['id'] ?>">Edit</a> |
        <a href="?delete=<?= $c['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>
<?php if(isset($_GET['edit_form'])):
  $eid = intval($_GET['edit_form']);
  $ec = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM categories WHERE id=$eid"));
?>
<hr>
<h3>Edit category</h3>
<form method="POST">
  <input type="hidden" name="id" value="<?= $ec['id'] ?>">
  <input name="name" value="<?= htmlspecialchars($ec['name']) ?>" required>
  <button name="edit">Update</button>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>