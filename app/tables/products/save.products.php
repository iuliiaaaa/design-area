<?php
session_start();
use App\models\Product;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";



$idreq = Product::createReqests(1,$_SESSION["id"]);



if(isset($_FILES["image"])){

    $name = $_FILES["image"]["name"];
    $tmpname= $_FILES["image"]["tmp_name"];
    $error = $_FILES["image"]["error"];

    $nameInServer =  time(). "_" .preg_replace("/[\-&\d_#]/","", $name);
    if(move_uploaded_file($tmpname,$_SERVER["DOCUMENT_ROOT"]. "/upload/".$nameInServer)){
        $_SESSION["message"] = "файл успешно загружен";
    }
    else{
        $_SESSION["errors"]["image"] = "неизвестная ошибка";
    }
    
}


Product::addProduct($_POST["name"],$_POST["price"],$nameInServer,$_POST["discription"], $_POST["category_id"],$idreq,0);

header('Location: /app/tables/users/profile.php');

