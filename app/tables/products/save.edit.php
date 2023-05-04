<?php

use App\models\Product;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

session_start();


Product::editProduct($_POST["id"],$_POST["name"],$_POST["price"],$_POST["discription"]);

require_once $_SERVER["DOCUMENT_ROOT"]."/app/tables/users/profile.php";