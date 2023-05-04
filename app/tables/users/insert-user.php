<?php
session_start();

unset($_SESSION["errors"]);

use App\models\User;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
$names = [];
$logins = [];
$emails = [];
$avatars = [];
$nameInServer = '';

if (isset($_POST['btn'])) {

    $_SESSION["name"] = $_POST["name"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["login"] = $_POST["login"];

    if (empty($_POST["name"])) {
        $_SESSION["errors"]["name"] = "имя пустое";
    } elseif (!preg_match("/^[А-ЯЁа-яёA-Za-z][а-яёa-z]+$/u", $_POST["name"], $names)) {
        $_SESSION["errors"]["name"] = "некорректное имя";
    } else $_SESSION["name"] = $names[0];


    if (empty($_POST["email"])) {
        $_SESSION["errors"]["email"] = "заполните почту";
    } elseif(User::findEmail($_POST["email"])){
        $_SESSION["errors"]["email"] = "почта занята";
    }
    elseif (!preg_match("/([A-Za-z0-9]+@[a-z]+\.[a-z]+)/u", $_POST["email"], $emails)) {
        $_SESSION["errors"]["email"] = "некорректная почта";
    } else $_SESSION["email"] = $emails[0];

    //проверка логина
    if (empty($_POST["login"])) {
        $_SESSION["errors"]["login"] = "введите логин";
    } elseif(User::findLogin($_POST["login"])){
        $_SESSION["errors"]["login"] = "данный логин уже занят";
    }
    elseif (!preg_match("/^[A-Za-z0-9]+$/u", $_POST["login"], $logins)) {
        $_SESSION["errors"]["login"] = "некорректный логин";
    } else $_SESSION["login"] = $logins[0];

    
    if(isset($_FILES["image"])){

        if($_FILES["image"]["tmp_name"]!=""){

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
        
    }

    if(empty($nameInServer)){
        $nameInServer = "defprofileava.jpg";
    } 


    if (empty($_POST["password"]) || empty($_POST["password_confirmation"])) {
        $_SESSION["errors"]["password"] = "заполните пароль";
    } 
    elseif ($_POST["password"] != $_POST["password_confirmation"]) {
        $_SESSION["errors"]["password"] = "пароли не совпадают";
    }
    elseif (!preg_match("/^(?=.*[A-ZА-ЯЁ])(?=.*[0-9]).{8,}+$/u", $_POST["password"])) {
        $_SESSION["errors"]["password"] = "Требования: 8 символов, 1 заглавная и 1 цифра";
    } 

    $_SESSION["vk"] = $_POST["vk"];
    $_SESSION["tg"] = $_POST["tg"];


    if (empty($_SESSION["errors"])) {

        if (User::insert($_POST["name"],$_POST["login"],$_POST["email"],$_POST["password"],$nameInServer)) {
            $user = User::getUser($_POST['login'], $_POST['password']);
            $_SESSION["auth"] = true;
            $_SESSION["id"] = $user->id;
            User::createContact($user->id,$_POST["vk"],$_POST["tg"]);
            $_SESSION["login"] = $_POST["login"];
            header("Location: /");
            die();
        } else {
            header("Location: /app/tables/users/create.php");
            die();
        }
    } else { 
        header("Location: /app/tables/users/create.php");
        $_SESSION["res"] = "Имеются ошибки ввода";}
}
