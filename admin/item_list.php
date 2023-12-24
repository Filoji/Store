<?php
include_once "database/product.php";
include_once "utils/smarter.php";

Smarter\include_with_props("templates/head.php", [
    'title' => 'Item list'
]);

$products = new DataManager\Product();
$items = $products->get_from_rank((isset($_GET['page']) and is_numeric($_GET['page'])) ? 10 * intval($_GET['page']) : 0);
?>
<h1>Item List</h1>
<div>
<?php if(isset($_GET['page']) and is_numeric($_GET['page']) and (intval($_GET['page']) > 0)): ?>
    <a href="/admin/item_list.php?page=<?= intval($_GET['page']) - 1 ?>">
        <button>Précédent</button>
    </a>
<?php endif ?>
<?php if(!empty($items)): ?>
    <a href="/admin/item_list.php?page=<?= (isset($_GET['page']) and is_numeric($_GET['page'])) ? intval($_GET['page']) + 1 : 1 ?>">
        <button>Suivant</button>
    </a>
<?php endif ?>
</div>
<?php foreach ($items as $item): ?>
    <div>
        <div>Id : <?= $item['id'] ?></div>
        <div>Name : <?= $item['name'] ?></div>
        <a href="/admin/update.php?id=<?= $item['id'] ?>">
            <button>Editer</button>
        </a>
    </div>
<?php endforeach; ?>