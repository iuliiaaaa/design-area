<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php"; 
session_start();

?>

<br><br><br>

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
                    <h5 style="font-size:120%;"><?=$product->product_name?></h5>
                    <span>Категории</span>
                    <h5 style="font-size:100%;">
                        <?= $product->category?>
                    </h5>

                    <span>Цена</span>
                    <h5 style="font-size:100%;"><?=$product->price?> ₽</h5>

                    <span>Описание </span>
                    <h5 style="font-size:100%;"><?=$product->description?></h5>

                    <p>Дата</p>
                    <h5 style="font-size:100%;"><?=$product->updated_at?></h5>

                    <br>

                    <a href="/app/tables/users/profile.php"><button class="buttonforComment"> вернуться
                            назад</button>
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>