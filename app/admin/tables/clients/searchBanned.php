<?php

use App\models\User;

session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
if(empty($_POST["name"])){
    $authors=null;
}
else{
    $authors = User::getSearchUser($_POST["name"]);

}
$_SESSION["authors"]= $authors;

header("Location: /app/admin/tables/clients.php");


