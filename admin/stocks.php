<?php
include_once "utils/smarter.php";

session_name("admin_session");
session_start();

if (!(isset($_SESSION['logged']) and $_SESSION['logged'])){
    Smarter\redirect("/admin/login.php");
}

include_once "database/product.php";

$products = new DataManager\Product();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    foreach ($_POST as $key => $value) {
        if (
            is_numeric($key)
            and (intval($key)>0)
            and ($item = $products->get_by_id(intval($key)))
            and ($item['amount'] + $value >= 0))
        {
            $products->update(intval($key), ['amount'=>($value+$item['amount'])]);
        }
    }
}

$item_per_page = 10;

$items = $products->get_from_rank((
    isset($_GET['page'])
    and is_numeric($_GET['page'])
    and intval($_GET['page']) >= 0
) ? intval($_GET['page']) * $item_per_page : 0, $item_per_page);

Smarter\include_with_props("templates/head.php", [
    'title' => 'Stocks'
])
?>

<h1>Stocks</h1>

<div>
<?php if(isset($_GET['page']) and is_numeric($_GET['page']) and (intval($_GET['page']) > 0)): ?>
    <a href="/admin/item_list.php?page=<?= intval($_GET['page']) - 1 ?>">
        <button>Précédent</button>
    </a>
<?php endif ?>
<?php if(count($items)==$item_per_page): ?>
    <a href="/admin/item_list.php?page=<?= (isset($_GET['page']) and is_numeric($_GET['page'])) ? intval($_GET['page']) + 1 : 1 ?>">
        <button>Suivant</button>
    </a>
<?php endif ?>
</div>

<form method="post">
    <?php foreach($items as $item): ?>
    <div>
        <div>ID : <?= $item['id'] ?></div>
        <div>Nom : <?= $item['name'] ?></div>
        <div>Quantité : <?= $item['amount'] ?></div>
        <label>Ajouter : </label>
        <input type="number" step="1" name="<?= $item['id'] ?>" value="0" />
    </div>
    <?php endforeach; ?>
    <input type="submit" value="Valider" />
    </form>
<?php include "templates/tail.php" ?>