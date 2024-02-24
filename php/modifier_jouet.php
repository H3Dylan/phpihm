<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: login.php");
    exit();
}

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $jouet_id = $_GET['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite_stock = $_POST['quantite_stock'];
    $image_url = $_POST['image_url'];

    $stmt = $pdo->prepare("UPDATE jouets SET nom=?, description=?, prix=?, quantite_stock=?, image_url=? WHERE id=?");
    $stmt->execute([$nom, $description, $prix, $quantite_stock, $image_url, $jouet_id]);

    header("Location: home.php");
    exit();
}

if (isset($_GET['id'])) {
    $jouet_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM jouets WHERE id = ?");
    $stmt->execute([$jouet_id]);
    $jouet = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier Jouet</title>
</head>
<body>
    <?php include('navbar.php'); ?>

    <h2>Modifier <?php echo $jouet['nom'] ?></h2>

    <form action="modifier_jouet.php?id=<?php echo $jouet_id; ?>" method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" value="<?php echo $jouet['nom']; ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $jouet['description']; ?></textarea>
        <br>
        <label for="prix">Prix:</label>
        <input type="text" name="prix" value="<?php echo $jouet['prix']; ?>" required>
        <br>
        <label for="quantite_stock">Quantité en stock:</label>
        <input type="number" name="quantite_stock" value="<?php echo $jouet['quantite_stock']; ?>" required>
        <br>
        <label for="image_url">URL de l'image:</label>
        <input type="text" name="image_url" value="<?php echo $jouet['image_url']; ?>" required>
        <br>
        <button type="submit">Enregistrer les modifications</button>
    </form>
</body>
</html>
