<?php
$menu_pages = [
    'Home' => '/'
]
?>

<!DOCTYPE html>
<html lang="en">
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