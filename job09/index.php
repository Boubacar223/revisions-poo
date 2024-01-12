<?php
declare(strict_types=1);

require_once 'product.php';

// Configuration de la connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// Création d'une nouvelle instance de Product
$product = new Product(
    0, // ID sera défini automatiquement par la base de données
    "Nom du Produit",
    ["photo1.jpg", "photo2.jpg"], // Exemple de tableau de photos
    100, // Prix
    "Description du produit",
    10, // Quantité
    new DateTime(), // createdAt
    new DateTime(), // updatedAt
    1 // ID de la catégorie
);

// Tentative d'insertion du produit dans la base de données
$result = $product->create($pdo);

if ($result) {
    echo "Produit inséré avec succès. ID du produit: " . $product->getId() . "\n";
} else {
    echo "Erreur lors de l'insertion du produit.\n";
}

