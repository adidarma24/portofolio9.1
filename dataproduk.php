<?php
// Sertakan file koneksi
include 'koneksi.php';

// PROSES TAMBAH PRODUK
if (isset($_POST['submit'])) {
    $nama_produk = $conn->real_escape_string($_POST['nama_produk']);
    $deskripsi   = $conn->real_escape_string($_POST['deskripsi']);
    $stok      = (int)$_POST['stok'];
    $kategori       = $conn->real_escape_string($_POST['kategori']);
    $harga       = (float)$_POST['harga'];

    // Proses upload gambar
    $gambar = "";
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir  = "img/"; // Ubah ke folder img
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Buat folder jika belum ada
        }
        $gambar      = basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    }

    $sql = "INSERT INTO produk (nama_produk, deskripsi, gambar, stok, kategori, harga) 
            VALUES ('$nama_produk', '$deskripsi', '$gambar', '$stok', '$kategori', '$harga')";

    if ($conn->query($sql) === TRUE) {
        $msg = "Produk berhasil ditambahkan!";
    } else {
        $msg = "Error: " . $conn->error;
    }
}

// PROSES HAPUS PRODUK
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    // Hapus gambar yang tersimpan
    $queryGambar = $conn->query("SELECT gambar FROM produk WHERE id = $id");
    if ($queryGambar && $row = $queryGambar->fetch_assoc()) {
        if (!empty($row['gambar']) && file_exists("img/" . $row['gambar'])) {
            unlink("img/" . $row['gambar']);
        }
    }

    $conn->query("DELETE FROM produk WHERE id = $id");
    header("Location: dataproduk.php");
    exit;
}

// PROSES UPDATE PRODUK
if (isset($_POST['update'])) {
    $id_produk   = (int)$_POST['id_produk'];
    $nama_produk = $conn->real_escape_string($_POST['nama_produk']);
    $deskripsi   = $conn->real_escape_string($_POST['deskripsi']);
    $stok      = (int)$_POST['stok'];
    $kategori       = $conn->real_escape_string($_POST['kategori']);
    $harga       = (float)$_POST['harga'];

    // Proses upload gambar jika ada
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir  = "img/";
        $gambar      = basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        // Update dengan gambar baru
        $sql = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', gambar='$gambar', stok=$stok, kategori='$kategori', harga=$harga WHERE id=$id_produk";
    } else {
        // Update tanpa mengganti gambar
        $sql = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', stok=$stok, kategori='$kategori', harga=$harga WHERE id=$id_produk";
    }

    if ($conn->query($sql) === TRUE) {
        $msg = "Produk berhasil diperbarui!";
    } else {
        $msg = "Error: " . $conn->error;
    }
}

// Ambil data produk untuk ditampilkan
$result = $conn->query("SELECT * FROM produk");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - CRUD Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Manajemen Produk</h2>
    <?php if (isset($msg)) : ?>
        <div class="alert alert-info"><?php echo $msg; ?></div>
    <?php endif; ?>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Tambah Produk</button>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Halaman Utama</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($produk = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($produk['nama_produk']); ?></td>
                <td><?php echo htmlspecialchars($produk['deskripsi']); ?></td>
                <td>
                    <?php if (!empty($produk['gambar']) && file_exists("img/" . $produk['gambar'])): ?>
                        <img src="img/<?php echo $produk['gambar']; ?>" width="50" alt="Gambar Produk">
                    <?php else: ?>
                        Tidak ada gambar
                    <?php endif; ?>
                </td>
                <td><?php echo $produk['stok']; ?></td>
                <td><?php echo htmlspecialchars($produk['kategori']); ?></td>
                <td><?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal"
                       data-id="<?php echo $produk['id']; ?>"
                       data-nama="<?php echo htmlspecialchars($produk['nama_produk']); ?>"
                       data-deskripsi="<?php echo htmlspecialchars($produk['deskripsi']); ?>"
                       data-stok="<?php echo $produk['stok']; ?>"
                       data-kategori="<?php echo htmlspecialchars($produk['kategori']); ?>"
                       data-harga="<?php echo $produk['harga']; ?>">
                       Edit
                    </a>
                    <a href="dataproduk.php?delete=<?php echo $produk['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">kategori</label>
                        <input type="text" name="kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Produk -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_produk" id="edit-id">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" id="edit-nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="edit-deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" id="edit-stok" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">kategori</label>
                        <input type="text" name="kategori" id="edit-kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" id="edit-harga" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const editProductModal = document.getElementById('editProductModal');
    editProductModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const deskripsi = button.getAttribute('data-deskripsi');
        const stok = button.getAttribute('data-stok');
        const kategori = button.getAttribute('data-kategori');
        const harga = button.getAttribute('data-harga');

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-deskripsi').value = deskripsi;
        document.getElementById('edit-stok').value = stok;
        document.getElementById('edit-kategori').value = kategori;
        document.getElementById('edit-harga').value = harga;
    });
</script>
</body>
</html>
<?php
$conn->close();
?>
