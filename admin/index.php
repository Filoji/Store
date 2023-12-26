<?php
include_once "utils/smarter.php";

session_name("admin_session");
session_start();

if (!(isset($_SESSION['logged']) and $_SESSION['logged'])){
    Smarter\redirect("/admin/login.php");
}

$admin_pages = [
    'Créer un produit' => 'create.php',
    'Liste des produits' => 'item_list.php',
    'Gestion des stocks' => 'stocks.php',
    'Déconnexion' => 'logout.php'
];

Smarter\include_with_props("templates/head.php", [
    'title' => 'Admin'
])
?>
<h1>Admin</h1>
<ul>
    <?php foreach ($admin_pages as $label => $route): ?>
    <li>
        <a href="/admin/<?= $route ?>"><?= $label ?></a>
    </li>
    <?php endforeach; ?>
</ul>

<?php include "templates/tail.php"; ?>