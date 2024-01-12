<?php
declare(strict_types=1);

require_once 'product.php';
require_once 'category.php';

// Configuration de la connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// ID de la catégorie pour laquelle vous voulez récupérer les produits
$category_id = 1; // Remplacez par l'ID de votre catégorie

// Création de l'instance de Category
$category = new Category($category_id, "Nom de la catégorie", "Description de la catégorie", new DateTime(), new DateTime());

// Récupération des produits de cette catégorie
$products = $category->getProducts($pdo);

// Affichage des produits
echo "Produits de la catégorie '{$category->getName()}':\n";
foreach ($products as $product) {
    echo " - {$product->getName()}\n";
}

