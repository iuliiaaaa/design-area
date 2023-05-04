<?php
session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}
use App\models\User;


require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";


User::banned(1,$_POST["id"]);


// require_once $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/clients/clients.view.php";
