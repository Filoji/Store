<?php
session_name("customer_session");
session_start();

include_once "utils/smarter.php";
include_once "database/product.php";

$products = new DataManager\Product();

Smarter\include_with_props("templates/head.php", [
    'title'=>'Panier'
]);
$total = 0;
?>
<h1>Panier</h1>
<?php foreach($_SESSION as $id => $amount):
    if ($item = $products->get_by_id(intval(substr($id, 3))) and empty($item)):
        unset($_SESSION[$id]);
    else: 
        $total += intval($item['price']) * $amount ?>
        <div>
            <h2><?= $item['name'] ?></h2>
            <p>Prix unitaire : <?= Smarter\currency(intval($item['price'])/100) ?></p>
            <p>Quantité : <?= $amount ?></p>
            <p>Prix du lot : <?= Smarter\currency(intval($item['price']) * $amount / 100) ?></p>
        </div>
<?php endif; endforeach; ?>
<h2>Total : <?= Smarter\currency($total / 100) ?></h2>
<?php include "templates/tail.php"; ?>