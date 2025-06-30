<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: index.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <header>📚 Pilih Kategori Buku</header>
  <div class="container">
    <div class="card"><a href='kategori.php?folder=pendidikan'>📘 Buku Pendidikan</a></div>
    <div class="card"><a href='kategori.php?folder=hiburan'>📗 Buku Hiburan</a></div>
    <br>
    <a href="logout.php">🔒 Logout</a>
  </div>
</body>
</html>
