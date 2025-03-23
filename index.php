<?php
// Sertakan file koneksi
include 'koneksi.php';

// Mulai sesi untuk menghitung jumlah item di keranjang
session_start();
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

// Cek apakah ada input pencarian
$keyword = isset($_GET['keyword']) ? $conn->real_escape_string($_GET['keyword']) : '';

// Query untuk mengambil data produk
if (!empty($keyword)) {
    // Jika ada keyword, cari produk berdasarkan nama atau deskripsi
    $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'";
} else {
    // Jika tidak ada keyword, tampilkan semua produk
    $sql = "SELECT * FROM produk";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Commerce - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="img/logo.png" alt="E-Commerce Logo" width="120">
    </a>
    <form class="d-flex me-auto ms-3" role="search" method="GET" action="index.php">
      <input class="form-control me-2" type="search" name="keyword" placeholder="Cari produk..." aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Cari</button>
    </form>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            <i class="bi bi-cart"></i> Keranjang 
            <span class="badge bg-danger"><?php echo $cart_count; ?></span>
          </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="dataproduk.php">Admin</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Carousel Banner -->
<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/banner1.jpg" class="d-block w-100" alt="Banner 1">
      <div class="carousel-caption d-none d-md-block">
        <h5>Diskon Besar-Besaran!</h5>
        <p>Belanja sekarang dan nikmati diskon hingga 50%.</p>
        <a href="#" class="btn btn-primary">Belanja Sekarang</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/banner2.jpg" class="d-block w-100" alt="Banner 2">
      <div class="carousel-caption d-none d-md-block">
        <h5>Produk Terbaru</h5>
        <p>Temukan koleksi terbaru kami.</p>
        <a href="#" class="btn btn-primary">Lihat Produk</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/banner3.jpg" class="d-block w-100" alt="Banner 3">
      <div class="carousel-caption d-none d-md-block">
        <h5>Gratis Ongkir</h5>
        <p>Untuk pembelian di atas Rp 500.000.</p>
        <a href="#" class="btn btn-primary">Belanja Sekarang</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Produk Terbaru -->
<div class="container mt-5">
  <h2 class="mb-4 text-center">Produk Terbaru</h2>
  <div class="row">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($product = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <?php 
            // Path gambar produk
            $imagePath = 'img/' . $product['gambar'];
            ?>
            <?php if (!empty($product['gambar']) && file_exists($imagePath)): ?>
              <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['nama_produk']); ?>">
            <?php else: ?>
              <img src="img/no-image.png" class="card-img-top" alt="No Image">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($product['nama_produk']); ?></h5>
              <p class="card-text">
                <?php 
                $words = explode(' ', htmlspecialchars($product['deskripsi']));
                echo implode(' ', array_slice($words, 0, 10)) . (count($words) > 10 ? '...' : '');
                ?>
              </p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
              <h6 class="text-primary mb-0">Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></h6>
              <form method="post" action="cart.php">
                <input type="hidden" name="id_produk" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="nama_produk" value="<?php echo htmlspecialchars($product['nama_produk']); ?>">
                <input type="hidden" name="harga" value="<?php echo $product['harga']; ?>">
                <input type="hidden" name="gambar" value="<?php echo $product['gambar']; ?>">
                <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
              </form>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12">
        <p class="text-center">Produk tidak ditemukan.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center text-lg-start mt-5">
  <div class="container p-4">
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">E-Commerce</h5>
        <p>
          Selamat datang di toko online kami. Kami menyediakan berbagai produk berkualitas untuk kebutuhan Anda.
        </p>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Navigasi</h5>
        <ul class="list-unstyled mb-0">
          <li><a href="#" class="text-dark">Home</a></li>
          <li><a href="#" class="text-dark">Shop</a></li>
          <li><a href="#" class="text-dark">Contact</a></li>
          <li><a href="admin.php" class="text-dark">Admin</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Kontak</h5>
        <ul class="list-unstyled mb-0">
          <li><span class="text-dark">Email: support@ecommerce.com</span></li>
          <li><span class="text-dark">Telepon: +62 123 456 789</span></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="text-center p-3 bg-dark text-white">
    <div class="mb-3">
      <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
      <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
      <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
    </div>
    © 2025 E-Commerce. All rights reserved.
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
