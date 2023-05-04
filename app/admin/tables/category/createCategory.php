<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

header('Location: /app/admin/views/category/createCategory.view.php');
