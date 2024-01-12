<?php
declare(strict_types=1);

// Inclure le fichier de la classe Category si nécessaire
require_once 'category.php';

// Création d'une instance de Category
$category = new Category(
    1, // id
    "Electronics", // name
    "Electronic gadgets and devices", // description
    new DateTime(), // createdAt
    new DateTime() // updatedAt
);

// Affichage de l'état initial de la catégorie avec var_dump
echo "Initial state of the category:\n";
var_dump($category);
