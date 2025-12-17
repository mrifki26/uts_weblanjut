<?php
include '../config.php';
$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM items WHERE id=$id");
$data = mysqli_fetch_assoc($q);
if ($data && $data['image']) {
    @unlink('upload/' . $data['image']);
}
mysqli_query($conn, "DELETE FROM items WHERE id=$id");
header('Location: items.php');
exit;
?>