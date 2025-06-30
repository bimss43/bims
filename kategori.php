<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: index.php");

$folder = $_GET['folder'];
$path = "buku/$folder";
$subfolder = scandir($path);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Subkategori</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <header>📚 Subkategori dari <?= ucfirst($folder) ?></header>
  <div class="container">
    <div class="grid">
      <?php foreach ($subfolder as $s): ?>
        <?php if ($s != '.' && $s != '..'): ?>
          <div class="card">
            <a href='daftar_buku.php?kategori=<?= "$folder/$s" ?>'><?= ucfirst($s) ?></a>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <a href="dashboard.php" class="back">← Kembali ke Dashboard</a>
  </div>
</body>
</html>

