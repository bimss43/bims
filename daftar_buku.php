<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: index.php");

// Ambil folder kategori dari URL
if (!isset($_GET['kategori'])) {
    die("Kategori tidak ditemukan.");
}

$folder = $_GET['kategori'];
$path = "buku/$folder";
$files = scandir($path);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku - <?= htmlspecialchars($folder) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>📚 Daftar Buku: <?= htmlspecialchars($folder) ?></header>
    <div class="container">
        <div class="grid">
            <?php foreach ($files as $f): ?>
                <?php if ($f != '.' && $f != '..' && pathinfo($f, PATHINFO_EXTENSION) === 'txt'): ?>
                    <div class="card">
                        <a href="baca.php?file=<?= urlencode("buku/$folder/$f") ?>">
                            📘 <?= htmlspecialchars(pathinfo($f, PATHINFO_FILENAME)) ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <a href="javascript:history.back()" class="back">← Kembali ke Subkategori</a>
    </div>
</body>
</html>


