<?php
session_start();
if(!isset($_SESSION["auth"]) || !$_SESSION["auth"]){
    header("location: /");
    die();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

use App\models\User;
use App\models\Product;


$user = User::find($_SESSION["id"]);

$products = Product::getAllProductByUser($_SESSION["id"]);

$requestProduct = Product::getAllRequestProduct($_SESSION["id"]);

$noProduct = Product::noProduct($_SESSION["id"]);

$countWork = User::countWork($_SESSION["id"]);

$name_page= $user->name . " | Design-area";

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/users/profile.view.php';
