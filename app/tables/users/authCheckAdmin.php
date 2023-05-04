<?php
session_start();

use App\models\User;
unset($_SESSION["error"]);
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$_SESSION["login"] = $_POST["login"];

if(isset($_POST["btn"])){
 $user = User::getAdmin($_POST['login'],$_POST['password'],"администратор");
   
 if($user == null){
    $_SESSION["error"] = "Пароль не подходит";
    $_SESSION["admin"] = false;
    if(!User::findLogin($_POST['login'])) {
      $_SESSION["error"] = "доступ запрещен";
    }
    header("Location: /admin.php");
    die();
 }else{
    $_SESSION["admin"] = true;
    $_SESSION["id"] = $user->id;
    header("Location: /app/admin/tables/products.php");
 }
}
