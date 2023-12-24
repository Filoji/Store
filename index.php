<?php
include_once "utils/smarter.php";
include_once "database/product.php";

use function Smarter\include_with_props;

include_with_props('templates/head.php', [
    'title' => 'Home'
]);

$products = new DataManager\Product();
$forwarded = $products->get_forwarded();
?>
<h1>Index</h1>
<?php
foreach ($forwarded as $item) {
    include_with_props('templates/small_item.php', ['item' => $item]);
}
?>
<?php include 'templates/tail.php' ?>