<?php
session_start();

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

use App\models\Category;

require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

$categories = Category::getAll();


require_once $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.product.view.php";