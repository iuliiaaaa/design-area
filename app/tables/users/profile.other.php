<?php

use App\models\User;
use App\models\Product;
use App\models\Category;
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (!empty($_GET["id"])){
    $user = User::find($_GET["id"]);
    $products = Product::getAllProductByUser($_GET["id"]);
    $countWork = User::countWork($_GET["id"]);

    $categories = User::getCategoryAuthor($_GET["id"]);
} else{
    $user = User::find($_POST["id"]);
    $products = Product::getAllProductByUser($_POST["id"]);
    $countWork = User::countWork($_POST["id"]);

    $categories = User::getCategoryAuthor($_POST["id"]);
}

$name_page=$user->name . " | Design-area";

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/users/profile.other.view.php';
