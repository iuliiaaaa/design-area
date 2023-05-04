<?php
session_start();
use App\models\User;
unset($_SESSION["errors"]);
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";


$fl = User::findLoginUser($_POST["login"]);
$fe = User::findEmailUser($_POST["email"]);

if (User::findLogin($_POST["login"])==true){
    if($fl->id != $_SESSION["id"]){
        $_SESSION["errors"]["login"] = "Данный логин уже занят";

}}

if (!preg_match("/^[A-Za-z0-9]+$/u", $_POST["login"])) {
    $_SESSION["errors"]["login"] = "Некорректный логин";
}

if (User::findEmail($_POST["email"])==true){
    if($fe->id != $_SESSION["id"]){
        $_SESSION["errors"]["email"] = "Данная почта уже занята";
    } 
}

elseif (!preg_match("/([A-Za-z0-9]+@[a-z]+\.[a-z]+)/u", $_POST["email"])) {
    $_SESSION["errors"]["email"] = "Некорректая почта";
}

if(empty($_POST["name"])){
    $_SESSION["errors"]["name"] = "Имя не может быть пустым имя";
}


if (!preg_match("/^[А-ЯЁа-яёA-Za-z][а-яёa-z]+$/u", $_POST["name"])) {
    $_SESSION["errors"]["name"] = "некорректное имя";
}

    if(isset($_FILES["image"]) && $_FILES["image"]["name"]!=""){
        $size = $_FILES["image"]["size"];
        $name = $_FILES["image"]["name"];
        $tmpname= $_FILES["image"]["tmp_name"];
        $error = $_FILES["image"]["error"];
    
        $nameInServer =  time(). "_" .preg_replace("/[\-&\d_#]/","", $name);
        if(move_uploaded_file($tmpname,$_SERVER["DOCUMENT_ROOT"]. "/upload/users/".$nameInServer)){
            $_SESSION["message"] = "файл успешно загружен";
        }
        else{
            $_SESSION["errors"]["image"] = "неизвестная ошибка";
        }
        
    }
    
    if($_FILES["image"]["name"]==""){
        $nameInServer = $_POST["oldavatar"];
    }else{
        if($_POST["oldavatar"]!="defprofileava.jpg"){
            unlink($_SERVER["DOCUMENT_ROOT"]."/upload/users/".$_POST["oldavatar"]);
        } 
        
    }

    if (empty($_SESSION["errors"])) {

        $_SESSION["login"] = $_POST["login"];


        if(empty($_POST["oldpass"]) && empty($_POST["newpass"])){
            User::editProfileNoPassword($_POST["id"],$_POST["name"],$_POST["login"],$_POST["email"],$nameInServer);
            User::editContact($_POST["contact_id"],$_POST["vk"], $_POST["tg"]);
            header("Location: /app/tables/users/profile.php");
       }

       else{

        if (!preg_match("/^(?=.*[A-ZА-ЯЁ])(?=.*[0-9]).{8,}+$/u", $_POST["newpass"])) {
            $_SESSION["errors"]["password"] = "Требования: 8 символов, 1 заглавная и 1 цифра";
            header("Location: /app/tables/users/profileEdit.php");
        } else{
            $what = User::editProfile($_POST["id"],$_POST["name"],$_POST["login"],$_POST["email"],$nameInServer,$_POST["newpass"],$_POST["oldpass"]);
            User::editContact($_POST["contact_id"],$_POST["vk"], $_POST["tg"]);
    
    
            if($what!=NULL){
                header("Location: /app/tables/users/profile.php");
            } else{
                $_SESSION["errors"]["password"] = "Старый пароль не подходит";
        
                header("Location: /app/tables/users/profileEdit.php");
            }
        }

       }

    } else {
        header("Location: /app/tables/users/profileEdit.php");
        die();
    }

