<?php

require_once('config.php');

if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    header("Location: admin.php");
    exit();
}


if (isset($_POST['edit'])) {
    $user_id = $_POST['user_id'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '<form action="admin_actions.php" method="post"><input type="hidden" name="edit_user_id" value="' . $user_id . '">
    Username: <input type="text" name="edited_username" value="' . $user['username'] . '" required><br>
    Admin: <input type="checkbox" name="admin" ' . ($user['admin'] ? 'checked' : '') . '><br>
    <button type="submit" name="update">Update</button>
    </form>';
}

if (isset($_POST['update'])) {
    $edited_user_id = $_POST['edit_user_id'];
    $edited_username = $_POST['edited_username'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE users SET username = ?, admin = ? WHERE id = ?");
    $stmt->execute([$edited_username, $admin, $edited_user_id]);
    header("Location: admin.php");
    exit();
}

if (isset($_POST['add'])) {
    $new_username = $_POST['new_username'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $admin = isset($_POST['admin']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO users (username, password, admin) VALUES (?, ?, ?)");
    $stmt->execute([$new_username, $new_password, $admin]);
    header("Location: admin.php");
    exit();
}