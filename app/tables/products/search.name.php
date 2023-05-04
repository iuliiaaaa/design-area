<?php

use App\models\Product;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if ($_GET["category"] != "all") {
    $categories = json_decode($_GET["category"]);

    if (count($categories) == 0) {
        $res = Product::getAll();
    } else {
        $res = Product::getProductsByCategories($categories);
    }

    echo json_encode($res, JSON_UNESCAPED_UNICODE);
}
