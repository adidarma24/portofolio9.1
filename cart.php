<?php
session_start();

// Tambahkan produk ke keranjang
if (isset($_POST['add_to_cart'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $gambar = $_POST['gambar'];

    $produk = [
        'id_produk' => $id_produk,
        'nama_produk' => $nama_produk,
        'harga' => $harga,
        'gambar' => $gambar,
        'jumlah' => 1
    ];

    // Jika keranjang belum ada, buat keranjang
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Periksa apakah produk sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id_produk'] == $id_produk) {
            $item['jumlah']++;
            $found = true;
            break;
        }
    }

    // Jika produk belum ada, tambahkan ke keranjang
    if (!$found) {
        $_SESSION['cart'][] = $produk;
    }

    header("Location: cart.php");
    exit;
}

// Hapus produk dari keranjang
if (isset($_GET['remove'])) {
    $id_produk = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id_produk'] == $id_produk) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    header("Location: cart.php");
    exit;
}

// Kosongkan keranjang
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

// Perbarui jumlah produk
if (isset($_POST['update_cart'])) {
    foreach ($_POST['jumlah'] as $id_produk => $jumlah) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id_produk'] == $id_produk) {
                $item['jumlah'] = $jumlah;
                break;
            }
        }
    }
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Halaman Utama</a>
  <h2 class="mb-4">Keranjang Belanja</h2>
  <?php if (!empty($_SESSION['cart'])): ?>
    <form method="post" action="cart.php">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $total = 0; ?>
          <?php foreach ($_SESSION['cart'] as $item): ?>
            <tr>
              <td><img src="img/<?php echo $item['gambar']; ?>" width="50" alt="Gambar Produk"></td>
              <td><?php echo htmlspecialchars($item['nama_produk']); ?></td>
              <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
              <td>
                <input type="number" name="jumlah[<?php echo $item['id_produk']; ?>]" value="<?php echo $item['jumlah']; ?>" class="form-control" min="1">
              </td>
              <td>Rp <?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></td>
              <td>
                <a href="cart.php?remove=<?php echo $item['id_produk']; ?>" class="btn btn-danger btn-sm">Hapus</a>
              </td>
            </tr>
            <?php $total += $item['harga'] * $item['jumlah']; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
      <h3>Total: Rp <?php echo number_format($total, 0, ',', '.'); ?></h3>
      <button type="submit" name="update_cart" class="btn btn-primary">Perbarui Keranjang</button>
      <a href="cart.php?clear=true" class="btn btn-warning">Kosongkan Keranjang</a>
      <a href="checkout.php" class="btn btn-success">Checkout</a>
      <a href="index.php" class="btn btn-info">Belanja Lagi</a> <!-- Tombol Belanja Lagi -->
    </form>
  <?php else: ?>
    <p class="text-center">Keranjang belanja kosong.</p>
    <a href="index.php" class="btn btn-info">Belanja Lagi</a> <!-- Tombol Belanja Lagi -->
  <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>