<?php
session_start();

if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("location: /");
    die();
}

use App\models\Category;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$all = Category::getAll();

$Availability = 0;

foreach ($all as $all) {
    if ($all->name == $_POST["name"]) {
        $Availability = $Availability + 1;
    }
}


if (isset($_FILES["img"])) {

    if ($_FILES["img"]["tmp_name"] != "") {


        $name = $_FILES["img"]["name"];
        $tmpname = $_FILES["img"]["tmp_name"];
        $error = $_FILES["img"]["error"];

        $nameInServer =  time() . "_" . preg_replace("/[\-&\d_#]/", "", $name);
        if (move_uploaded_file($tmpname, $_SERVER["DOCUMENT_ROOT"] . "/upload/img/" . $nameInServer)) {
            $_SESSION["message"] = "файл успешно загружен";
        } else {
            $_SESSION["errors"]["img"] = "неизвестная ошибка";
        }
    }

    if(empty($nameInServer)){
        $nameInServer = null;
    } 

if (empty($_SESSION["errors"])) {
    if ($Availability == 0) {

        if (empty($_POST["title"])) {
            Category::addCategory($_POST["name"], $_POST["small-des"], 0, $nameInServer);
        } else {
            Category::addCategory($_POST["name"], $_POST["small-des"],  1, $nameInServer);
        }
    }
}
header('Location: /app/admin/tables/category.php');

}
