<?php

use App\models\User;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

session_start();

if($_FILES["image"]['name']!=""){
    if(isset($_FILES["image"])){

        $name = $_FILES["image"]["name"];
        $tmpname= $_FILES["image"]["tmp_name"];
        $error = $_FILES["image"]["error"];
    
        $nameInServer =  time(). "_" .preg_replace("/[\-&\d_#]/","", $name);
        if(move_uploaded_file($tmpname,$_SERVER["DOCUMENT_ROOT"]. "/upload/comment/".$nameInServer)){
            $_SESSION["message"] = "файл успешно загружен";
        }
        else{
            $_SESSION["errors"]["image"] = "неизвестная ошибка";
        }
        
    }
} else{
    $nameInServer=NULL;
}

$contents = [];

if (isset($_POST['prodid'])) {

    $_SESSION["content"] = strip_tags($_POST["content"]);
    $_SESSION["prodid"] = $_POST["prodid"];


    $badwords = ["хуй","пизд","далбо","долбо","уеб","хуе","хуя","пидо","пидр","оху","аху","залу","пезд","еба","еб", "бля"];
    $pattern = "/\b[а-яё]*(".implode("|", $badwords).")[а-яё]*\b/ui";
    $res = preg_replace($pattern, "ПЛОХОЕ СЛОВО", $_SESSION["content"]);
    
    if ($res==$_SESSION["content"]) {
        
    } else{
        $_SESSION["errorsComment"] = "неадекватный комментарий";
    }

    if (empty($_SESSION["content"])) {
        $_SESSION["errorsComment"] = "комментарий пустой";
    } elseif (!preg_match("/.{15,}/", $_SESSION["content"], $contents)) {
        $_SESSION["errorsComment"] = "слишком маленький комментарий";
    } 
    else $_SESSION["content"] = $contents[0];
    $_SESSION["open_comment"] = true;

    if (empty($_SESSION["errorsComment"])) {
        User::createComment($_SESSION["id"],$_SESSION["content"],$nameInServer, $_SESSION["prodid"]);
        header("Location: /app/tables/products/show.php?id=".$_POST["prodid"]);
    } else { 
        header("Location: /app/tables/products/show.php?id=".$_POST["prodid"]);
    }
}
