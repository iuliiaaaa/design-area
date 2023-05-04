<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

use App\models\User;
use App\models\Product;


session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

$client = User::find($_GET["id"]);

$products = Product::getAllProductByUser($_GET["id"]);

$requestProduct = Product::getAllRequestProduct($_GET["id"]);

$noProduct = Product::noProduct($_GET["id"]);


// header("Location: /app/admin/views/clients/client.php");
require_once $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/clients/client.php";
