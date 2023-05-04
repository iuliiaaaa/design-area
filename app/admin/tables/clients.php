<?php
session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}
use App\models\User;


require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if(isset($_SESSION["authors"])){
    $res = $_SESSION["authors"];

} else{
    $res = User::getUsers();

}
require_once $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/clients/clients.view.php";
unset($_SESSION["authors"]);
