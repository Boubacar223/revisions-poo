<?php
declare(strict_types=1);

// Inclure le fichier contenant la classe Product si nécessaire
 require_once 'product.php';

// Création d'une instance de Product
$product = new Product(
    1, // id
    "T-shirt", // name
    ["https://piscum.photos/200/300"], // photos
    1000, // price
    "A beautiful T-shirt", // description
    10, // quantity
    new DateTime(), // createdAt
    new DateTime(), // updatedAt
    10 // category_id
);

// Afficher les propriétés initiales avec var_dump
echo "Initial state of the product:\n";
var_dump($product);
