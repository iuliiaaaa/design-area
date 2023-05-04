<?php
session_start();

if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("location: /");
    die();
}


use App\models\Category;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";


$category=Category::find($_GET["id"]);


$_SESSION["category"] = $category;

header("Location: /app/admin/tables/category/loadOneCategory.php");
