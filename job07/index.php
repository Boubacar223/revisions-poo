<?php
declare(strict_types=1);

require_once 'product.php';

// Configuration de la connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// ID du produit à rechercher
$product_id = 7; // Remplacez 7 par l'ID du produit que vous voulez récupérer

// Création d'une instance vide de Product
$product = new Product(0, '', [], 0, '', 0, new DateTime(), new DateTime(), 0);

// Récupération du produit
if ($product->findOneById($pdo, $product_id)) {
    // Affichage des informations du produit
    echo "Informations du produit ID {$product_id}:\n";
    echo "Nom: " . $product->getName() . "\n";
    echo "Prix: " . $product->getPrice() . "€\n";
    // ... Affichez d'autres informations si nécessaire
} else {
    echo "Aucun produit trouvé avec l'ID $product_id.";
}

