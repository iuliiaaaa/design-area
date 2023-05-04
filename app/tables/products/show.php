<?php
use App\models\Product;
use App\models\User;
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";






if(!isset($_SESSION["auth"]) || !$_SESSION["auth"]){

} else{
    $avatar = User::getAvatar($_SESSION["login"])->avatar;

}


$product = Product::find($_GET["id"]);
$reviews = Product::getComment($_GET["id"]);

$last= Product::get3LastProducts($product->cateid,$product->product_id);

$name_page=$product->product_name . " | Design-area";

require_once $_SERVER["DOCUMENT_ROOT"]."/views/products/show.view.php";