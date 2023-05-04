<?php
use App\models\Category;
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

$arr=$_POST;


foreach ($arr as $i){
    Category::deleteCategory($i);
}


header('Location: /app/admin/tables/category.php');
