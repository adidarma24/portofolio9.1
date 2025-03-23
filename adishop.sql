-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Mar 2025 pada 08.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adishop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `kategori` varchar(100) DEFAULT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `gambar`, `stok`, `kategori`, `harga`) VALUES
(2, 'Hadinata Embriodery Batik Kemeja Pendek Farish Fira', '- Batik Printing Premium\n- Pocket Paspoll /Hidden Pocket\n- Material 100% Katun Primis 40S, Ringan , Tidak melar dan Tidak Menerawang\n- Cutting Reguler Fit ( adjustable bisa naik 1 size)\n- Kerah Kemeja ( terdapat 2 lapisan : Interlining dan Mika ) terlihat lebih kokoh \n- Hidden Button \n- Terdapat Cadangan Kancing\n- Lengan Pendek , Motif Kanan dan Kiri simetris\n- Terdapat 2 lapisan :  Tricot Premium dan Furing dengan bahan rayon\n- Warna Maroon\n- List Bordir di bagian Kerah , Pocket dan Lengan\n- Model menggunakan size M TB 182 BB 78\n \nSIZE CHART:\n \n- Size M \nLingkar dada 110 cm, Panjang Baju 76 cm, Panjang Lengan 26 cm\n- Size L \nLingkar dada 114 cm, Panjang Baju 78 cm, Panjang Lengan 27 cm\n- Size XL \nLingkar dada 118 cm, Panjang Baju 79 cm, Panjang Lengan 28 cm\n- Size XXL \nLingkar dada 122 cm, Panjang Baju 80 cm, Panjang Lengan 29 cm\n \n \nPanduan Size :\nSize S TB 149 – 170 cm & BB 50 – 65 kg\nSize M TB 150 – 170 cm & BB 65 – 75 kg\nSize L TB 150 – 180 cm & BB 75 – 90 kg\nSize XL TB 160 – 190 cm & BB 90 – 95 kg\nSize XXL TB 160 – 190 cm & BB 100 – 105 kg\n \nNOTED :\n \n1. Toleransi ukuran 1-2cm untuk setiap produk , Ukuran setiap produk berbeda-beda, lihat detail ukuran sebelum membeli\nKarena product kami 100% katun, Pada pencucian pertama akan terjadi proses susut (pemadatan kain) +/-1cm ,sekiranya informasi ini membantu dalam menentukan size yg pas dan nyaman.\n \n2. Garansi Tuker size selama 7 hari setelah barang diterima ', 'https://hadinatabatik.com/data/foto-produk-slide/146062-ZALORA_0007_3_2.jpg', 500, 'Pakaian', 1499000),
(3, 'Smartphone Samsung Galaxy Z Flip5 8GB/256GB MINT\r\n', 'Samsung Galaxy Z Flip5 diesain unik yang bisa dilipat secara vertikal, membuatnya lebih ringkas dan mudah dibawa, jika dilipat ukurannya sangat compact dan elegan.\r\nLayar luar yang besar 3.4 inch, memungkinkan pengguna mengakses notifikasi, widget, dan beberapa aplikasi tanpa membuka ponsel sedangkan layar utama 6.7 inch yang memiliki kualitas gambar tajam, warna cerah, dan mendukung frekuensi sapuan hingga 120Hz, memberikan pengalaman visual yang mulus.\r\nDitenagai oleh prosesor Qualcomm Snapdragon 8 Gen 2 for Galaxy, memberikan kinerja yang cepat dan efisien dalam multitasking dan gaming.\r\nDual kamera belakang 12 MP yang dilengkapi dengan teknologi AI untuk foto yang jernih, serta kamera depan 10 MP yang disesuaikan untuk selfie berkualitas tinggi, baik saat ponsel dibuka maupun dilipat.\r\nMemiliki engsel yang lebih kokoh dan fleksibel, dengan desain yang meminimalkan lipatan pada layar ketika dibuka.\r\nMendukung sertifikasi IPX8, yang berarti ponsel ini tahan air hingga kedalaman tertentu, menjadikannya lebih tahan lama dalam berbagai situasi.\r\nDidukung jaringan 5G, memberikan pengalaman internet yang lancar dan cepat.\r\nBaterai 3700 mAh yang cukup untuk mendukung aktivitas seharian dengan fitur pengisian daya cepat, baik melalui kabel maupun nirkabel.\r\nMenggunakan antarmuka One UI yang dioptimalkan untuk layar lipat, membuat navigasi dan penggunaan multitasking lebih nyaman.', 'https://static.retailworldvn.com/Products/Images/12220/313482/smartphone-samsung-galaxy-z-flip5-8gb-256gb-mint-010923-105140-600x600.jpg', 20, 'Elektronik', 10999000),
(4, 'Informa Sleep 160x200 Cm Cuscotex Kasur Pocket Springbed In Box', 'Cover bantal dan guling dapat dibuka dan dicuci\r\nLatex terbuat dari getah pohon karet alami yang aman bagi kesehatan\r\nMenggunakan latex dengan sirkulasi udara bebas sehingga lebih awet, mencegah pertumbuhan bakteri, jamur, dan mikroorganisme\r\nMemiliki tambahan busa latex pada bagian atas kasur\r\nKasur lebih tebal 3 cm pada bagian topper yang berisikan lapisan latex dan dacron\r\nKualitas per yang baik dan mudah kembali ke posisi semula\r\nSistem pegas :\r\nTerbuat dari kawat baja yang terbungkus kain kuat\r\nStruktur independen dan lebih fleksibel\r\nMampu meredam gerakan dengan baik\r\nMaterial bantal dan guling : berbahan dasar chooped memory foam\r\nUkuran bantal : 66 x 42 x 22 cm\r\nUkuran guling : 93 x 23 x 23 cm\r\nFirmness: medium firm\r\nFoam material: latex & foam\r\nIn box: ya\r\nIsi set: 1 unit kasur, 2 set bantal & guling\r\nMaterial permukaan: fabric\r\nMatras ortopedi: tidak\r\nSeri: Cuscotex\r\nSertifikasi K3L matras: 20-L-002551\r\nSertifikasi matras: CertiPUR-US & OEKO-TEX\r\nSpring type: pocket spring bed\r\nUkuran: 160 x 200 x 23 cm\r\nGaransi Unit: 10 Tahun\r\nWarna: Putih\r\nDimensi Kemasan: 170.0 x 36.0 x 36.0 cm\r\nBerat: 50 kg\r\nSKU: 10327678\r\nNama Komoditas: CUSCOTEX MATTRESS W/ GIFT 160X200X23 CM', 'https://cdn.ruparupa.io/fit-in/400x400/filters:format(webp)/filters:quality(90)/ruparupa-com/image/upload/Products/10327678_2.jpg', 800, 'Peralatan Rumah', 3099000),
(5, 'Hadinata Batik Hem Pendek Anak Desmon Dahlia', '- Batik Print\r\n- Material 100% Katun Primis 40S , Ringan , Tidak melar dan Tidak Menerawang\r\n- Forward Point Collar ( Kerah Kemeja)\r\n- Kancing depan\r\n- Lengan Pendek\r\n- Warna Abu-Abu\r\n- Tanpa Furing\r\n- Saku depan', 'https://hadinatabatik.com/data/foto-produk-slide/123617-ZALORA%20-%20%20HEM%20KIDS_0018_12%20%20FEBRUARI%202022%20RAE%20FG%20RIFKI-99558.jpg', 150, 'Pakaian', 219000),
(6, 'Kris 22 Ltr Oven Dengan Air Fryer - Hitam', 'Memiliki fungsi sebagai air fryer\r\nApi atas bawah\r\nDilengkapi fitur pengaturan suhu\r\nTerdapat timer hingga 60 menit\r\nDapat digunakan untuk defrost\r\nFungsi 6 in 1 : air fry, broil, bake, toast, convection broil, convection toast\r\nTemperatur : 100-250°C\r\nKapasitas : 22 liter (6 potong roti/1.8kg ayam)\r\nAksesoris : keranjang penggorengan, loyang, rak oven\r\nMaterial :\r\n- Oven : stainless steel\r\n- Aksesoris : stainless steel, aluminium\r\n- Lapisan bagian dalam : metal, heating\r\nDimensi tray dalam oven : 32 x 28.1 x 2 cm\r\n*Part yang digaransi : heater, thomaster, PC\r\nDaya: 800 watt\r\nDimensi produk: 40 cm x 37.6 cm x 34.6 cm\r\nKapasitas: 22 L\r\nGaransi suku cadang: 12 Bulan\r\nGaransi servis: 12 Bulan\r\nWarna: Hitam\r\nDimensi Kemasan: 45.0 x 42.0 x 38.0 cm\r\nBerat: 8.7 kg\r\nSKU: 10420740\r\nNama Komoditas: AIR FRYER OVEN 22L 800W', 'https://cdn.ruparupa.io/fit-in/400x400/filters:format(webp)/filters:quality(90)/ruparupa-com/image/upload/Products/10420740_1.jpg', 301, 'Peralatan Rumah', 899900);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
