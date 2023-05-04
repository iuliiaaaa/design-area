<?php

use App\models\User;
use App\models\Product;
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if(!empty($_POST["userid"]) && !empty($_POST["cateid"])){
    $userid = $_POST["userid"];
    $cateid = $_POST["cateid"];
} 

$user = User::find($userid);
$products = Product::getAllProductByUserAndCategory($userid,$cateid);
$countWork = User::countWork($userid);

$categories = User::getCategoryAuthor($userid);

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/users/profile.other.view.php';
