<?php
include_once "database/product.php";
include_once "utils/smarter.php";

if (!(isset($_GET['id']) and is_numeric($_GET['id'])))
    Smarter\redirect('/');

$products = new DataManager\Product();

if(!($item = $products->get_by_id(intval($_GET['id']))))
    Smarter\redirect('/');

Smarter\include_with_props("templates/head.php", ['title' => 'Produit']);
?>
<h1>Item</h1>
<h2><?= $item['name'] ?></h2>
<p><?= $item['description'] ?></p>
<p>Prix : <?= intval($item['price'])/100 ?>€</p>
<p>Quantité en stock : <?= $item['amount'] ?></p>
<?php include "templates/tail.php" ?>