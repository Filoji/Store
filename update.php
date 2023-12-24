<?php
include_once "utils/smarter.php";

if (($_SERVER['REQUEST_METHOD'] == 'GET') and (!isset($_GET['id']) or !is_numeric($_GET['id']))){
    Smarter\redirect('/index.php');
}

include_once "database/product.php";
include_once "database/admin.php";

$products = new DataManager\Product();

if (($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['id'])){
    if (!$item = $products->get_by_id($_POST['id']))
        Smarter\redirect('/index.php');
    $result = array();
    foreach ($item as $column => $value) {
        switch ($column) {
            case 'id':
                break;
            case 'price':
                if (is_numeric($_POST['price'])) {
                    if ((floor(floatval($_POST['price']*100))!= $value) and floatval($_POST['price'])>0)
                        $result['price'] = floor(floatval($_POST['price']*100));
                }
                break;
            case 'forwarded':
                if (isset($_POST['forwarded']) and $value==0)
                    $result['forwarded']=1;
                else if (!isset($_POST['forwarded']) and $value==1)
                    $result['forwarded']=0;
                break;
            default:
                if (isset($_POST[$column]) and $value != $_POST[$column])
                    $result[$column] = $_POST[$column];
                break;
        }
    }
    $products->update($_POST['id'], $result);
}

if (!$item = $products->get_by_id($_GET['id'])){
    Smarter\redirect('/index.php');
}

Smarter\include_with_props("templates/head.php", [
    'title' => 'Update'
]);
?>

<h1>Update</h1>

<div>
    <form method="post">
    <input type="hidden" name="id" value="<?= $item['id'] ?>" />
    <div>
        <label>Name</label>
        <input type="text" name="name" value="<?= $item['name'] ?>" />
    </div>
    <div>
        <label>Short Description</label>
        <input type="text" name="short_description" value="<?= $item['short_description'] ?>" />
    </div>
    <div>
        <label>Description</label>
        <input type="text" name="description" value="<?= $item['description'] ?>" />
    </div>
    <div>
        <label>Price</label>
        <input type="number" name="price" step="0.01" value="<?= $item['price']/100 ?>" />
    </div>
    <div>
        <label>Forwarded</label>
        <input type="checkbox" name="forwarded" <?= $item['forwarded'] ? 'checked' : '' ?> />
    </div>
    <input type="submit" value="Valider" />
    </form>
</div>

<?php include "templates/tail.php"; ?>