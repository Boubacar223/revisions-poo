<?php
declare(strict_types=1);

// Inclure les fichiers de classes si nécessaire
 require_once 'product.php';
 require_once 'category.php';

// Configuration de la connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');

// Récupération du produit avec l'ID 7
$stmt = $pdo->prepare('SELECT * FROM product WHERE id = ?');
$stmt->execute([7]);
$productData = $stmt->fetch();

if ($productData) {
    // Décoder le champ 'photos' JSON en tableau
    $photos = json_decode($productData['photos'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // Gérer l'erreur de décodage JSON, si nécessaire
        echo "Erreur de décodage JSON dans les photos.";
        exit;
    }

    $product = new Product(
        $productData['id'],
        $productData['name'],
        $photos, // Passer le tableau décodé
        $productData['price'],
        $productData['description'],
        $productData['quantity'],
        new DateTime($productData['createdAt']),
        new DateTime($productData['updatedAt']),
        $productData['category_id']
    );

    // Récupérer la catégorie associée
    $category = $product->getCategory($pdo);

    echo "Informations du produit :\n";
    var_dump($product);

    echo "\nInformations de la catégorie associée :\n";
    var_dump($category);
} else {
    echo "Aucun produit trouvé avec l'ID 7.";
}
?>

