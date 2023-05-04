<?php
use App\models\Product;

require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

$product = Product::find($_GET["id"]);

$name_page = $product->product_name . " | Design-area";

require_once $_SERVER["DOCUMENT_ROOT"]."/views/products/showNoPublish.view.php";