<?php

use App\models\User;

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
if(empty($_POST["name"])){
    $authors=null;
}
else{
    $authors = User::getSearchUser($_POST["name"]."%");
}
$_SESSION["authors"]= $authors;

header("Location: /app/tables/users/authors.php");
