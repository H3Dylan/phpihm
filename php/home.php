<?php 

include('navbar.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


require_once('config.php');

$stmt = $pdo->query("SELECT * FROM jouets");
$jouets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <section id="produits">
        <h2>Nos Produits</h2>
        <div class="liste-produits">
            <?php foreach ($jouets as $jouet): ?>
                <div class="produit">
                    <img src="<?php echo $jouet['image_url']; ?>">
                    <h3><?php echo $jouet['nom']; ?></h3>
                    <p><?php echo $jouet['description']; ?></p>
                    <p>Prix: <?php echo $jouet['prix']; ?> €</p>
                    <p>En Stock: <?php echo $jouet['quantite_stock']; ?></p>
                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                        <button><a href="modifier_jouet.php?id=<?php echo $jouet['id']; ?>">Modifier</a></button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
        <div class="ajouter-jouet-form">
            <form action="ajouter_jouet.php" method="post">
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                    <form action="ajouter_jouet.php" method="post">
                        <h2>Ajouter un Nouveau Jouet</h2>
                        <label for="nom">Nom:</label>
                        <input type="text" name="nom" required>
                        <br>
                        <label for="description">Description:</label>
                        <textarea name="description" required></textarea>
                        <br>
                        <label for="prix">Prix:</label>
                        <input type="text" name="prix" required>
                        <br>
                        <label for="quantite_stock">Quantité en stock:</label>
                        <input type="number" name="quantite_stock" required>
                        <br>
                        <label for="image_url">URL de l'image:</label>
                        <input type="text" name="image_url" required>
                        <br>
                        <button type="submit" name="ajouter_jouet">Ajouter Jouet</button>
                    </form>
                <?php endif; ?>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>