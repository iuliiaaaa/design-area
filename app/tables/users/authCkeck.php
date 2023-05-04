<?php
session_start();

use App\models\User;
unset($_SESSION["error"]);
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$_SESSION["login"] = $_POST["login"];

if(isset($_POST["btn"])){
 $user = User::getUser($_POST['login'],$_POST['password']);

 if ($user->is_blocked ==0){
   if($user == null){
      $_SESSION["error"] = "Пароль не подходит";
      $_SESSION["auth"] = false;
      if(!User::findLogin($_POST['login'])) {
         $_SESSION["error"] = "такого аккаунта не существует";
      }
       header("Location: /app/tables/users/auth.php");
      die();
   }else{
     
      $_SESSION["auth"] = true;
      $_SESSION["id"] = $user->id;
       header("Location: /app/tables/users/profile.php");
       if($user->role=="администратор"){
         $_SESSION["admin"] = true;
       } else{
         $_SESSION["admin"] = false;
       }
   }

}
else {
   header("Location: /app/tables/users/auth.php");
   $_SESSION["auth"] = false;
   $_SESSION["error"] = "ваш аккаунт забанен";
}
}
