<?php
include_once "database/product.php";
include_once "utils/smarter.php";

session_name("customer_session");
session_start();

if (!(isset($_GET['id']) and is_numeric($_GET['id'])))
    Smarter\redirect('/');

$products = new DataManager\Product();

if(!($item = $products->get_by_id(intval($_GET['id']))))
    Smarter\redirect('/');

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['action'])){
    if ($_POST['action']=='add' and !isset($_SESSION['id_' . $item['id']]) and ($item['amount'] > 0)){
        $_SESSION['id_' . $item['id']] = 1;
    }
    else if ($_POST['action']=='edit' and isset($_SESSION['id_' . $item['id']])){
        if (isset($_POST['amount']) and ($_POST['amount'] < $item['amount']) and ($_POST['amount'] > 0))
            $_SESSION['id_' . $item['id']] = $_POST['amount'];
        else
            unset($_SESSION['id_' . $item['id']]);
    }
}

Smarter\include_with_props("templates/head.php", ['title' => 'Produit']);
?>
<h1>Item</h1>
<h2><?= $item['name'] ?></h2>
<p><?= $item['description'] ?></p>
<p>Prix : <?= Smarter\currency(intval($item['price'])/100) ?></p>
<p>Quantité en stock : <?= $item['amount'] ?></p>
<?php if ($item['amount']>0): ?>
    <?php if (!array_key_exists('id_' . strval($item['id']), $_SESSION)): ?>
    <form method="post">
        <input type="hidden" name="action" value="add" />
        <input type="submit" value="Ajouter au panier" />
    </form>
    <?php else: ?>
    <form method="post">
        <input type="hidden" name="action" value="edit" />
        <div>
            <label>Quantité : </label>
            <input type="number" step="1" name="amount" min="0" max="<?= $item['amount'] ?>"  value="<?= $_SESSION['id_' . strval($item['id'])] ?>" />
        </div>
        <input type="submit" value="Valider" />
    </form>
    <?php endif; ?>
<?php else: ?>
    <h2>Rupture de stocks !</h2>
<?php endif;?>
<?php include "templates/tail.php" ?>