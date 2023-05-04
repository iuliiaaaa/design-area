<?php

session_start();

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

use App\models\Category;
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

$res = Category::sort($_GET["id"]);

require_once $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/inCategory.views.php";
