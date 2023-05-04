<?php

use App\models\Product;

require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

$product = Product::find($_POST["prodid"]);
$reviews = Product::getComment($_POST["prodid"]);

$last= Product::get3LastProducts($product->cateid,$product->product_id);

require_once $_SERVER["DOCUMENT_ROOT"]."/views/products/show.view.php";
