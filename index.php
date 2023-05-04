<?php
session_start();
use App\models\Category;
use App\models\Product;

require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

$categories = Category::getAll();
$mainCategory = Category::getMainCategory();

$name_page="Главная | Design-area";

require_once $_SERVER["DOCUMENT_ROOT"]."/views/products/index.view.php";
