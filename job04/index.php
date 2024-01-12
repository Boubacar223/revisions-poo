<?php
declare(strict_types=1);

// Inclure les fichiers de classes si nécessaire
require_once 'product.php';
// Informations de connexion à la base de données
$host = 'localhost';
$db   = 'draft-shop';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Récupération du produit avec l'id 7
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
    // Affichage des informations du produit
    echo "Informations du produit récupéré:\n";
    var_dump($product);
} else {
    echo "Aucun produit trouvé avec l'ID 7.";
}
?>



