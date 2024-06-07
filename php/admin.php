<?php
session_start();
include('navbar.php');
if (!isset($_SESSION['user_id']) || !isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: login.php");
    exit();
}

require_once('config.php');

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <h2>Gestion des utilisateurs</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Admin</th>
                <th>Gestion</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['admin'] ? 'Admin' : 'Client'; ?></td>
                    <td>
                        <form action="admin_actions.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete">Supprimer</button>
                            <button type="submit" name="edit">Modifier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="add-user-form">
        <h2>Ajouter un utilisateur</h2>
        <form action="admin_actions.php" method="post">
            <label for="new_username">Login :</label>
            <input type="text" name="new_username" required>
            <br>
            <label for="new_password">Mot de passe :</label>
            <input type="password" name="new_password" required>
            <br>
            <label for="admin">Admin :</label>
            <input type="checkbox" name="admin">
            <br>
            <button type="submit" name="add">Ajouter</button>
        </form>
        <form method="post" action="home.php">
            <button type="submit" name="home"><a href="home.php">Home</a></button>
        </form>
    </div>
</body>
</html>
