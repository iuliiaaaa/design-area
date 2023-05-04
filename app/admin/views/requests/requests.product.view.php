<?php 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/templates/header.php";

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}
?>


<section class="section" id="product">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="left-images">
                    <img id="blah" style="object-fit: cover;" src="/upload/<?= $product->photo?>" alt="">
                </div>
            </div>
            <div class="col-lg-4" style="margin-top: -25px;">
                <div class="right-content">
                    <span>Название</span>
                    <h4><?=$product->product_name?></h4>
                    <span>категории</span>
                    <h5>
                        <?= $product->category?>
                    </h5>

                    <span>Цена</span>
                    <h5><?=$product->price?> ₽</h5>

                    <span>Описание </span>
                    <h5><?=$product->description?></h5>

                    <p>Дата</p>
                    <h5><?=$product->updated_at?></h5>

                    <br>

                    <form action="/app/admin/tables/requests/publish.php" method="POST">
                        <input name="product_id" type="text" value="<?=$product->product_id?>" style="display:none;">
                        <input name="requests_id" type="text" value="<?=$product->request?>" style="display:none;">
                        <button class="buttonforCommentYes">Опубликовать</button>
                    </form>
                    <br>
                    <form action="/app/admin/tables/requests/reject.php" method="POST">
                        <input name="product_id" type="text" value="<?=$product->product_id?>" style="display:none;">
                        <input name="requests_id" type="text" value="<?=$product->request?>" style="display:none;">
                        <button class="buttonforCommentNo">Отклонить/скрыть</button>

                </div>
            </div>
        </div>
    </div>
</section>