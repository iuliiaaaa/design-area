<?php
session_start();
use App\models\User;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if(isset($_SESSION["authors"])){
    $authors = $_SESSION["authors"];

} else{
    $authors=User::getIdAndNameAuthor();
}

$name_page="Авторы | Design-area";

require_once $_SERVER["DOCUMENT_ROOT"] . '/views/users/authors.view.php';
unset($_SESSION["authors"]);
