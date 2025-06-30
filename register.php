 <!DOCTYPE html>
<html>
<head>
    <title>Register Web Baca Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📝 Daftar Akun</h1>
        <form method="post" action="">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <input type="submit" name="register" value="Daftar">
        </form>
        <br>
        <a href="index.php">← Kembali ke Login</a>
    </div>
</body>
</html>

<?php
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    $userData = $username . '|' . $password . PHP_EOL;

    file_put_contents('users.txt', $userData, FILE_APPEND);
    echo "<script>alert('Akun berhasil dibuat!'); window.location='index.php';</script>";
}
?>
