<?php
session_start();
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit;
}

// Proses checkout (contoh sederhana)
if (isset($_POST['checkout'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $telepon = $conn->real_escape_string($_POST['telepon']);
    $total_harga = $total;

    // Simpan data pesanan ke tabel `orders`
    $sql = "INSERT INTO orders (nama, alamat, telepon, total_harga) VALUES ('$nama', '$alamat', '$telepon', $total_harga)";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;

        // Simpan detail produk ke tabel `order_details`
        foreach ($_SESSION['cart'] as $item) {
            $id_produk = $item['id_produk'];
            $jumlah = $item['jumlah'];
            $harga = $item['harga'];
            $sql_detail = "INSERT INTO order_details (order_id, id_produk, jumlah, harga) VALUES ($order_id, $id_produk, $jumlah, $harga)";
            $conn->query($sql_detail);
        }

        unset($_SESSION['cart']); // Kosongkan keranjang setelah checkout
        $msg = "Checkout berhasil! Terima kasih telah berbelanja.";
    } else {
        $msg = "Terjadi kesalahan: " . $conn->error;
    }

    $to = $_POST['email'];
    $subject = "Konfirmasi Pesanan Anda";
    $message = "Terima kasih telah berbelanja di toko kami. Pesanan Anda sedang diproses.";
    $headers = "From: no-reply@ecommerce.com";

    mail($to, $subject, $message, $headers);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4">Checkout</h2>
  <?php if (isset($msg)): ?>
    <div class="alert alert-success"><?php echo $msg; ?></div>
  <?php endif; ?>
  <?php if (!empty($_SESSION['cart'])): ?>
    <h4>Ringkasan Keranjang</h4>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['cart'] as $item): ?>
          <tr>
            <td><img src="img/<?php echo $item['gambar']; ?>" width="50" alt="Gambar Produk"></td>
            <td><?php echo htmlspecialchars($item['nama_produk']); ?></td>
            <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
            <td><?php echo $item['jumlah']; ?></td>
            <td>Rp <?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></td>
          </tr>
          <?php $total += $item['harga'] * $item['jumlah']; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
    <h4>Total Harga: Rp <?php echo number_format($total, 0, ',', '.'); ?></h4>
  <?php endif; ?>
  <a href="cart.php" class="btn btn-secondary mb-3">Kembali ke Keranjang</a>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Nama Lengkap</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Nomor Telepon</label>
      <input type="text" name="telepon" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" name="checkout" class="btn btn-primary">Proses Checkout</button>
  </form>
  <div class="mt-4">
    <h4>Metode Pembayaran</h4>
    <p>Silakan transfer ke rekening berikut:</p>
    <ul>
      <li>Bank: BCA</li>
      <li>Nomor Rekening: 123456789</li>
      <li>Atas Nama: E-Commerce</li>
    </ul>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>