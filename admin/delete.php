<?php 
include_once "utils/smarter.php";

session_name("admin_session");
session_start();

if (!(isset($_SESSION['logged']) and $_SESSION['logged'])){
    Smarter\redirect("/admin/login.php");
}

if (!(isset($_GET['id']) and is_numeric($_GET['id']))){
    Smarter\redirect('/admin');
}

include_once "database/product.php";

$products = new DataManager\Product();

if (!$item = $products->get_by_id($_GET['id'])){
    Smarter\redirect('/admin');
}

if (
    ($_SERVER['REQUEST_METHOD']=='POST')
    and isset($_GET['id'], $_POST['id'], $_POST['delete'])
    and ($_GET['id'] == $_POST['id']))
{
    $products->delete($item['id']);
    Smarter\redirect('/admin');
}

Smarter\include_with_props("templates/head.php", [
    'title'=>'Supprimer'
]);
?>
<h1>Supprimer</h1>
<h2><?= $item['name'] ?></h2>
<p>Voulez-vous réellement le supprimer ?</p>
<div>
<form method="post">
    <input type="hidden" value="<?= $item['id'] ?>" name='id' />
    <label>Je souhaite le supprimer : </label>
    <input type="checkbox" name="delete" />
    <input type="submit" value="Valider" />
</form>
</div>

<?php include "templates/tail.php"; ?>