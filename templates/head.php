<?php
$menu_pages = [
    'Accueil' => '/',
    'Liste des produits' => '/admin/item_list.php',
    'Stocks' => '/admin/stocks.php',
    'Panier' => '/cart.php'
]
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $props['title'] ?></title>
</head>
<body>
    <header>
        <div>
        <ul>
        <?php foreach ($menu_pages as $label => $route): ?>
            <li>
                <a href="<?= $route ?>"><?= $label ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
        </div>
    </header>