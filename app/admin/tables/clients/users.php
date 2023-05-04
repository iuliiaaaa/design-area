<?php

use App\models\User;

session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$authors = User::users();

$_SESSION["authors"] = $authors;

header("Location: /app/admin/tables/clients.php");
