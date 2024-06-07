<?php
$host = 'db';
$db = 'phptest';
$user = 'root';
$pass = 'rootpassword';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Message de débogage commenté
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
