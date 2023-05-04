<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";

use App\models\Category;
use App\models\Product;

?>


<div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content">
                    <div class="thumb">
                        <div class="inner-content ">
                            <h4>Загрузите <br>свою первую работу</h4>

                            <div class="main-border-button">
                                <a href="/app/tables/products/requests.php">Создать заявку!</a>
                            </div>
                        </div>
                        <img class="create-req" src="/upload/img/mainbanner.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                        <?php foreach($mainCategory as $mc): ?>
                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content vnesh">
                                        <h4><?=$mc->name?></h4>
                                        <span>Категория</span>
                                    </div>
                                    <div class="hover-content ">
                                        <div class="inner ">
                                            <h4><?=$mc->name?></h4>
                                            <p>Товары в категории <?=$mc->name?></p>
                                            <div class="main-border-button">
                                                <a href="/app/tables/products/catalog.php?id=<?=$mc->id?>">Просмотр</a>
                                            </div>
                                        </div>
                                    </div>
                                    <img class="title-category" src="upload/img/<?=$mc->img?>">
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach($mainCategory as $mc): ?>


<?php $count = Category::getCountCategory($mc->id);

    if($count->ct>=1):

?>

<section class="section" id="men">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Новинки в категории <?=$mc->name?></h2>
                    <span><?=$mc->small_description?></span>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">
                        <?php $FiveCreate=Product::get5ProductsTitleCategory($mc->id) ?>

                        <?php foreach($FiveCreate as $FC):?>

                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">

                                </div>
                                <a href="/app/tables/products/show.php?id=<?= $FC->product_id?>"> <img class="fcinindex"
                                        src="/upload/<?=$FC->photo?>" alt=""></a>
                            </div>
                            <div class="down-content">
                                <h4><?=$FC->product_name?></h4>
                                <span><?=$FC->price?> ₽</span>

                            </div>
                        </div>

                        <?php endforeach ?>




                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif?>

<?php endforeach ?>

<section class="section" id="explore">
    <div class="container">
        <div class="row">
            <div class="left-content">
                <h2>Каталог</h2>
                <div class="main-border-button">
                    <a href="/app/tables/products/catalog.php">Перейти в каталог</a>
                </div>
                <span>В нашем каталоге собраны все товары во всех категориях</span>
            </div>

        </div>
    </div>
</section>



<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>