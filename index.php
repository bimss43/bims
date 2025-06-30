<?php
session_start();

// Cek apakah tombol login ditekan
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    $valid = false;

    foreach ($users as $user) {
        list($savedUser, $savedPass) = explode('|', $user);
        if ($username === $savedUser && password_verify($password, $savedPass)) {
            $valid = true;
            break;
        }
    }

    if ($valid) {
        $_SESSION['user'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $loginError = "Username atau password salah!";
    }
}

// Cek apakah tombol register ditekan
if (isset($_POST['register'])) {
    $newUser = trim($_POST['new_username']);
    $newPass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    $usernameTaken = false;

    foreach ($users as $user) {
        list($savedUser, $savedPass) = explode('|', $user);
        if ($newUser === $savedUser) {
            $usernameTaken = true;
            break;
        }
    }

    if ($usernameTaken) {
        $registerError = "Username sudah digunakan!";
    } else {
        file_put_contents('users.txt', $newUser . '|' . $newPass . PHP_EOL, FILE_APPEND);
        $registerSuccess = "Akun berhasil dibuat! Silakan login.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login & Register - Web Baca Buku</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            margin: 0;
        }
        .header {
            background-color: #2c3e50;
            padding: 20px;
            text-align: center;
            color: #fff;
            font-size: 24px;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }
        .form-box {
            flex: 1;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .message {
            color: red;
            margin-top: 10px;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">📚 Login Web Baca Buku</div>

    <div class="container">
        <!-- Login Form -->
        <div class="form-box">
            <h2>Login</h2>
            <form method="post">
                <label>Username:</label>
                <input type="text" name="username" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <input type="submit" name="login" value="Login">
            </form>

            <?php if (isset($loginError)) echo "<div class='message'>$loginError</div>"; ?>
        </div>

        <!-- Register Form -->
        <div class="form-box">
            <h2>Daftar Akun</h2>
            <form method="post">
                <label>Username Baru:</label>
                <input type="text" name="new_username" required>

                <label>Password Baru:</label>
                <input type="password" name="new_password" required>

                <input type="submit" name="register" value="Register">
            </form>

            <?php
            if (isset($registerError)) echo "<div class='message'>$registerError</div>";
            if (isset($registerSuccess)) echo "<div class='success'>$registerSuccess</div>";
            ?>
        </div>
    </div>
</body>
</html>
