<?php
include_once "utils/smarter.php";

session_name("admin_session");
session_start();

if (!(isset($_SESSION['logged']) and $_SESSION['logged'])){
    Smarter\redirect("/admin/login.php");
}

include_once "database/product.php";

Smarter\include_with_props("templates/head.php", [
    'title' => 'Liste des produits'
]);

$item_per_page = 10;

$products = new DataManager\Product();
$items = $products->get_from_rank((isset($_GET['page']) and is_numeric($_GET['page'])) ? $item_per_page * intval($_GET['page']) : 0, $item_per_page);
?>
<h1>Liste des produits</h1>
<div>
<?php if(isset($_GET['page']) and is_numeric($_GET['page']) and (intval($_GET['page']) > 0)): ?>
    <a href="/admin/item_list.php?page=<?= intval($_GET['page']) - 1 ?>">
        <button>Précédent</button>
    </a>
<?php endif ?>
<a href="/admin/create.php">
    <button>Créer</button>
</a>
<?php if(count($items)==$item_per_page): ?>
    <a href="/admin/item_list.php?page=<?= (isset($_GET['page']) and is_numeric($_GET['page'])) ? intval($_GET['page']) + 1 : 1 ?>">
        <button>Suivant</button>
    </a>
<?php endif ?>
</div>
<?php foreach ($items as $item): ?>
    <div>
        <div>ID : <?= $item['id'] ?></div>
        <div>Nom : <?= $item['name'] ?></div>
        <a href="/admin/update.php?id=<?= $item['id'] ?>">
            <button>Editer</button>
        </a>
    </div>
<?php endforeach; ?>