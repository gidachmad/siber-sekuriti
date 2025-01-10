<?php
    include 'session_manager.php';

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (login($username, $password)) {
            header("Location: index.php");
        } else {
            header("Location: login.php");
        }
    }


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Manajemen Siswa</h1>
            <p>Login</p>
        </header>

        <!-- Form untuk menambahkan siswa -->
        <section class="form-section">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <?php
                    if (isset($_SESSION['error']) && isset($_SESSION['error']['login'])) {
                        echo "<span style='color: red;'>{$_SESSION['error']['login']}</span>";
                        unset($_SESSION['error']['login']);
                    }
                ?>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </section>
    </div>
</body>
</html>