<?php
session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}
use App\models\User;


require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";


User::banned(1,$_GET["id"]);

$id=$_GET["id"];
header("Location: /app/admin/tables/clients/client.php?id=$id");
