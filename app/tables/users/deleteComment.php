<?php

use App\models\User;

session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

User::deleteComment($_POST["btn-delete"]); 
unlink($_SERVER["DOCUMENT_ROOT"]."/upload/comment/" . $_POST['image']);
$_SESSION["open_comment"] = true;

header("Location: /app/tables/products/show.php?id=".$_POST["prod"]);