<?php
// baca.php
session_start();
if (!isset($_SESSION['login'])) header("Location: index.php");

// Cek apakah parameter file dikirim
if (!isset($_GET['file'])) {
    die("Buku tidak ditemukan.");
}

$file = urldecode($_GET['file']);

// Validasi: pastikan hanya file .txt dari folder 'buku/' yang bisa diakses
if (!file_exists($file) || pathinfo($file, PATHINFO_EXTENSION) !== 'txt' || strpos(realpath($file), realpath("buku/")) !== 0) {
    die("File tidak valid atau tidak ditemukan.");
}

// Baca isi file
$isi = file_get_contents($file);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Baca Buku - <?= htmlspecialchars(basename($file)) ?></title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <header>📖 Membaca Buku: <?= htmlspecialchars(basename($file)) ?></header>
  <div class="container">
    <pre><?= htmlspecialchars($isi) ?></pre>
    <a href="javascript:history.back()" class="back">← Kembali</a>
  </div>
</body>
</html>
