<?php

session_start();

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

use App\models\Category;
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

Category::editCategory($_POST["name"],$_GET["id"]);

header('Location: /app/admin/tables/category.php');
