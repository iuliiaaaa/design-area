<?php
use App\models\Product;

require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

Product::hideProductPublish($_GET["id"]);

$reqId = Product::getReqIdWhereProdId($_GET["id"]);

Product::hideProductStatus($reqId[0]->requests_id);

header('Location: /app/tables/users/profile.php');