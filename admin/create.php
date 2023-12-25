<?php
include "database/product.php";
include "utils/smarter.php";

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
    'title' => 'Create'
]);
?>
<h1>Create</h1>
<div>
    <form method="post">
        <div>
            <label>Name</label>
            <input type="text" name="name"/>
        </div>
        <div>
            <label>Short Description</label>
            <input type="text" name="short_description" />
        </div>
        <div>
            <label>Description</label>
            <input type="text" name="description" />
        </div>
        <div>
            <label>Price</label>
            <input type="number" name="price" step="0.01" />
        </div>
        <input type="submit" value="Valider" />
    </form>
</div>
<?php include "templates/tail.php"; ?>