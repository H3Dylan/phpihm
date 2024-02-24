<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['admin'] = $user['admin'];
        header("Location: home.php");
        exit();
    } else {
        echo "Login ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Login:</label>
            <input type="text" name="username" required>
            <br>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit">Sign in</button>
        </form>
        <p><a href="register.php">Sign up</a>.</p>
    </div>
</body>
</html>
