<?php
session_start();
use App\models\Category;

require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

$categories = Category::getAll();

$name_page="Каталог | Design-area";

require_once $_SERVER["DOCUMENT_ROOT"]."/views/products/catalog.view.php";
