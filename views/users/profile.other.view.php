<?php 
session_start();


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
                    <span>Товаров: <?=$countWork[0]->pub?> шт.</span>
                    <ul style="border: 0%;">
 <?php if(!empty($user->vk)):?>
                        <li><a href="https://vk.com/<?= $user->vk?>"><img style="height: 25px;"
                                    src="/upload/img/vki.png.svg" alt=""></a></li>
                        <?php endif?>
                        <?php if(!empty($user->tg)):?>
                        <li><a href="https://t.me/<?= $user->tg?>"><img style="height: 25px;"
                                    src="/upload/img/tg.png.svg" alt=""></a></li>
                        <?php endif?>

                    </ul>
                    <ul style="border: 0%;">

                        <form action="/app/tables/users/profile.other.filter.php" method="POST">
                            <input type="text" style="display:none" name="userid" value="<?=$user->id?>">
                            <?php foreach($categories as $i):?>
                            <li> <button class="buttonforComment2" style="min-weight: 100px;" value="<?=$i->id?>"
                                    name="cateid"><?=$i->name?></button></li>

                            <?php endforeach?>
                        </form>
                    </ul>
                    <ul style="border: 0%;">

                        <form action="/app/tables/users/profile.other.php" method="POST">

                            <li> <button class="buttonforComment2" style="min-weight: 100px;" value="<?=$user->id?>"
                                    name="id">Все</button></li>

                        </form>
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
                    <h2>Товары автора</h2>

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

                                <a href="/app/tables/products/show.php?id=<?=$products->product_id?>"><img
                                        class="fcinindex" src="/upload/<?=$products->photo?>" alt=""></a>
                            </div>
                            <div class="down-content">
                                <h4><?=$products->product_name?> </h4>
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

<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php" ?>
