<?php
include_once "utils/smarter.php";

session_name("admin_session");
session_start();

if (!(isset($_SESSION['logged']) and $_SESSION['logged'])){
    Smarter\redirect("/admin/login.php");
}

include_once "database/product.php";

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if (
        isset($_POST['name'], $_POST['description'], $_POST['short_description'], $_POST['price'])
        and is_numeric($_POST['price'])
        and (floatval($_POST['price'])>0))
    {
        $products = new DataManager\Product();
        $products->create(
            $_POST['name'],
            $_POST['description'],
            $_POST['short_description'],
            floor(floatval($_POST['price'])*100));
        Smarter\redirect('/admin/item_list.php');
    }
}

Smarter\include_with_props(
    "templates/head.php", [
    'title' => 'Créer'
]);
?>
<h1>Créer</h1>
<div>
    <form method="post">
        <div>
            <label>Nom : </label>
            <input type="text" name="name"/>
        </div>
        <div>
            <label>Courte description : </label>
            <input type="text" name="short_description" />
        </div>
        <div>
            <label>Description : </label>
            <input type="text" name="description" />
        </div>
        <div>
            <label>Prix : </label>
            <input type="number" name="price" step="0.01" />
        </div>
        <input type="submit" value="Valider" />
    </form>
</div>
<?php include "templates/tail.php"; ?>