<?php

session_start();

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

use App\models\Product;


require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";


Product::publish(1,$_POST["product_id"]);
Product::statusChange(2,$_POST["requests_id"]);


header("Location: /app/admin/tables/requests/admin.requests.pending.php");
