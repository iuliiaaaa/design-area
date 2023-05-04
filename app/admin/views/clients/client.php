<?php 
session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/templates/header.php";

?>

<div class="about-us">
    <div class="center-div2">
        <div class="row">

            <div class="col-lg-12">
                <div class="right-content">
                    <br>
                    <img class="profava" style="margin-left: 160px;" src="/upload/users/<?= $client->avatar?>" alt="">

                    <h4>
                        <?= $client->name?>
                    </h4>
                    <span>
                        <?= $client->email?>,
                        <?= $client->login?>
                    </span>
                    <?php if ($client->is_blocked==0):?>
                    <p>Не в бане</p>
                    <?php else:?>
                    <p>Забанен</p>
                    <?php endif?>

                    <ul style="border: 0%;">
                        <li><a href="https://vk.com/<?= $client->tg?>">Tg</a></li>
                        <li><a href="https://vk.com/<?= $client->vk?>">Vk</a></li>

                    </ul> <br>
                    <?php if ($client->is_blocked==0):?>
                    <li> <a href="/app/admin/tables/clients/client/clientBanned.php?id=<?=$client->id?>"
                            class="buttonforCommentNo">Забанить</a></li>
                    <?php else:?>
                    <li> <a href="/app/admin/tables/clients/client/clientUnban.php?id=<?=$client->id?>"
                            class="buttonforCommentYes">Разбанить</a></li>

                    <?php endif?>
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
                    <h2>Опубликованные</h2>

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

                                <a href="/app/admin/tables/requests/requestProduct.php?id=<?=$products->product_id?>"><img
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
                    <h2>Заявки</h2>

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
                            <div class="thumb" >

                                <a href="/app/admin/tables/requests/requestProduct.php?id=<?=$requestProduct->product_id?>"><img 
                                        class="fcinindex"  src="/upload/<?=$requestProduct->photo?>" alt=""></a>
                            </div>
                            <div class="down-content">
                                <h4><?=$requestProduct->product_name?></h4>
                                <span><?=$requestProduct->price?> руб</span>
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

                                <a href="/app/admin/tables/requests/requestProduct.php?id=<?=$noProduct->product_id?>"><img
                                        class="fcinindex" src="/upload/<?=$noProduct->photo?>" alt=""></a>
                            </div>
                            <div class="down-content">
                                <h4><?=$noProduct->product_name?></h4>
                                <span><?=$noProduct->price?> руб</span>
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

<script src="/assets/js/jquery-2.1.0.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/owl-carousel.js"></script>
<script src="/assets/js/scrollreveal.min.js"></script>

<script src="/assets/js/custom.js"></script>
