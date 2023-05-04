<?php
session_start();

if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("location: /");
    die();
}


$category = $_SESSION["category"];

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/admin/views/category/editCategory.view.php';
unset($_SESSION["authors"]);