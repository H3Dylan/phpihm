<?php
require_once('config.php');
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter_jouet'])) {

    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite_stock = $_POST['quantite_stock'];
    $image_url = $_POST['image_url'];

    $stmt = $pdo->prepare("INSERT INTO jouets (nom, description, prix, quantite_stock, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $description, $prix, $quantite_stock, $image_url]);

    header("Location: home.php");
    exit();
} else {

    header("Location: home.php");
    exit();
}
?>
