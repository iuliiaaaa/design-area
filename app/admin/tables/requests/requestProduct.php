<?php

use App\models\Product;

session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";


$product = Product::find($_GET["id"]);


require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/requests/requests.product.view.php";