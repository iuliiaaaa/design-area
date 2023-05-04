<?php 
session_start();
if(!isset($_SESSION["auth"]) || !$_SESSION["auth"]){
    header("location: /");
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";

?>
<br><br><br>


<div class="about-us">
    <div class="center-div2">
        <div class="row">

            <div class="col-lg-12">
                <div class="right-content">
                    <br>
                    <img class="profava" src="/upload/users/<?= $user->avatar?>" alt="">
                    <h4>
                        <?= $user->name?>
                    </h4>
                    <span>
                        <?= $user->email?>
                    </span>
                    <?php foreach ($countWork as $countWork) :?>
                    <span>опубликованных: <?=$countWork->pub?> , заявок: <?=$countWork->req?>, отклоненных:
                        <?=$countWork->rej?></span>
                    <?php endforeach?>
                    <ul style="border: 0%;">
                        <?php if(!empty($user->vk)):?>
                        <li><a href="https://vk.com/<?= $user->vk?>"><img style="height: 25px;"
                                    src="/upload/img/vki.png.svg" alt=""></a></li>
                        <?php endif?>
                        <?php if(!empty($user->tg)):?>
                        <li><a href="https://t.me/<?= $user->tg?>"><img style="height: 25px;"
                                    src="/upload/img/tg.png.svg" alt=""></a></li>
                        <?php endif?>
                        <li><a href="/app/tables/users/profileEdit.php?id=<?= $user->id?>"><img
                                    src="/upload/img/pencilred.svg" style="height: 20px;" alt=""></a></li>
                        <li><a href="/app/tables/users/logaut.php"><img src="/upload/img/exit.svg" style="height: 20px;"
                                    alt=""></a></li>
                    </ul>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>





<?php if(!empty($products)):?>
<section class="section" id="men">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Ваши товары</h2>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">
                        <?php foreach ($products as $products) :?>



                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="/app/tables/products/hide.php?id=<?=$products->product_id?>"><img
                                                    class="prodman" src="/upload/img/eye.svg" alt=""></a></li>
                                        <li><a
                                                href="/app/tables/products/edit.product.php?id=<?=$products->product_id?>"><img
                                                    class="prodman" src="/upload/img/pencil-svgrepo-com.svg" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <a href="/app/tables/products/show.php?id=<?=$products->product_id?>"><img
                                        class="fcinindex" src="/upload/<?=$products->photo?>" alt=""></a>
                            </div>
                            <div class="down-content">
                                <h4><?=$products->product_name?></h4>
                                <span><?=$products->price?> ₽</span>
                                <ul class="stars">
                                    <li>Категория <?=$products->category?></li>
                                </ul>
                            </div>
                        </div>


                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif?>





<?php if(!empty($requestProduct)):?>
<section class="section" id="men">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Ваши заявки</h2>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">
                        <?php foreach ($requestProduct as $requestProduct) :?>



                        <div class="item">
                            <div class="thumb">

                                <a href="/app/tables/products/showNoPublish.php?id=<?=$requestProduct->product_id?>"><img
                                        class="fcinindex" src="/upload/<?=$requestProduct->photo?>" alt=""></a>
                            </div>
                            <div class="down-content">
                                <h4><?=$requestProduct->product_name?></h4>
                                <span><?=$requestProduct->price?> ₽</span>
                                <ul class="stars">
                                    <li>Категория <?=$requestProduct->category?></li>
                                </ul>
                            </div>
                        </div>


                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php endif?>




<?php if(!empty($noProduct)):?>
<section class="section" id="men">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Отклоненные/скрытые</h2>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">
                        <?php foreach ($noProduct as $noProduct) :?>



                        <div class="item">
                            <div class="thumb">

                                <a href="/app/tables/products/showNoPublish.php?id=<?=$noProduct->product_id?>"><img
                                        class="fcinindex" src="/upload/<?=$noProduct->photo?>" alt=""></a>
                            </div>
                            <div class="down-content">
                                <h4><?=$noProduct->product_name?></h4>
                                <span><?=$noProduct->price?> ₽</span>
                                <ul class="stars">
                                    <li>Категория <?=$noProduct->category?></li>
                                </ul>
                            </div>
                        </div>


                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php endif?>




<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php" ?>
