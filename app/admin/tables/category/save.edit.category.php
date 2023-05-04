<?php
use App\models\Category;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$cate=Category::find($_POST["id"]);




if(isset($_FILES["img"]) && $_FILES["img"]["name"]!=""){
    $size = $_FILES["img"]["size"];
    $name = $_FILES["img"]["name"];
    $tmpname= $_FILES["img"]["tmp_name"];
    $error = $_FILES["img"]["error"];

    $nameInServer =  time(). "_" .preg_replace("/[\-&\d_#]/","", $name);
    if(move_uploaded_file($tmpname,$_SERVER["DOCUMENT_ROOT"]. "/upload/img/".$nameInServer)){
        $_SESSION["message"] = "файл успешно загружен";
    }
    else{
        $_SESSION["errors"]["img"] = "неизвестная ошибка";
    }

    if($_FILES["img"]["name"]==""){
        $nameInServer = $_POST["img"];
    }else{
        unlink($_SERVER["DOCUMENT_ROOT"]."/upload/img/".$_POST["img"]);
    }
    
    
} else{
    $nameInServer = $_POST["oldimg"];

}


Category::editCategory($_POST["name"],$_POST["id"],$_POST["small_des"],$_POST["main"],$nameInServer);




    


    
header("Location: /app/admin/tables/category.php");

