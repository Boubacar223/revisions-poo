<?php
declare(strict_types=1);

require_once 'product.php';

// Configuration de la connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// Récupération de tous les produits
$products = Product::findAll($pdo);

// Affichage des produits
echo "Liste des produits :\n";
foreach ($products as $product) {
    echo "ID: " . $product->getId() . "\n";
    echo "Nom: " . $product->getName() . "\n";
    echo "Prix: " . $product->getPrice() . "€\n";
    echo "Description: " . $product->getDescription() . "\n";
    echo "Quantité: " . $product->getQuantity() . "\n";
    echo "Créé le: " . $product->getCreatedAt()->format('Y-m-d H:i:s') . "\n";
    echo "Mis à jour le: " . $product->getUpdatedAt()->format('Y-m-d H:i:s') . "\n";
    echo "ID Catégorie: " . $product->getCategoryId() . "\n\n";
}
