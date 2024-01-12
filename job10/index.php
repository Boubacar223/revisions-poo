<?php
declare(strict_types=1);

require_once 'product.php';

// Configuration de la connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// ID du produit à mettre à jour
$product_id = 1; // Remplacez 1 par l'ID du produit que vous voulez mettre à jour

// Création d'une instance de Product et chargement des données depuis la DB
$product = new Product(0, '', [], 0, '', 0, new DateTime(), new DateTime(), 0);
if ($product->findOneById($pdo, $product_id)) {
    // Modification des propriétés du produit
    $product->setName("Nouveau Nom du Produit");
    $product->setPrice(200); // Nouveau prix
    $product->setDescription("Description mise à jour du produit");

    // Mise à jour du produit dans la base de données
    if ($product->update($pdo)) {
        echo "Produit mis à jour avec succès.\n";
    } else {
        echo "Erreur lors de la mise à jour du produit.\n";
    }
} else {
    echo "Produit avec ID $product_id non trouvé.\n";
}

