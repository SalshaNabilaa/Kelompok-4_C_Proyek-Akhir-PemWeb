<?php include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM kategori WHERE id_kategori=$id");
header("Location: index.php"); ?>""",

    "tambah_buku.php": """<?php include 'db.php';
$kategori_id = $_GET['kategori_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $foto = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto);
    $conn->query("INSERT INTO buku (nama, foto, kategori_id) VALUES ('$nama', '$foto', $kategori_id)");
    header("Location: kelola_buku.php?kategori_id=$kategori_id");
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nama" placeholder="Nama Buku" required>
    <input type="file" name="foto" required>
    <button type="submit">Simpan</button>
</form>