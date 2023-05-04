<?php

use App\models\User;

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if(!isset($_SESSION["auth"]) || !$_SESSION["auth"]){
    header("location: /");
    die();
}

$user = User::find($_SESSION["id"]);

$name_page="Редактирование Профиля  | Design-area";

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/users/profileEdit.view.php';

unset($_SESSION["chetam"]);