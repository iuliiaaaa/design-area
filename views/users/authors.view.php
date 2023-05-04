<?php 

session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";

use App\models\User;

?>


<section class="our-team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Авторы</h2>
                    <span>Здесь представлены все авторы на нашем сайте</span>

                    <br> <br>
                    <div class="center-div lololo" style="text-align: center; border: none;">
                        <form action="/app/tables/users/searchAuthor.php" method="POST">
                            <input type="text" class="input-seach" name="name" id="searchName" style="height: 40px;">
                            <button style="height: 40px; border:none; background-color:white;"><img class="serch"
                                    type="button" src="/upload/icons/search-svgrepo-com.svg"
                                    style="height: 20px; cursor: pointer; color:gray;"></button>

                        </form>
                    </div>
                </div>
            </div>

            <?php foreach ($authors as $authors) :?>
            <div class="col-lg-4">
                <div class="team-item">
                    <div class="thumb">
                        <div class="hover-effect">
                            <div class="inner-content">
                                <ul>

                                    <?php if(!empty($_SESSION["id"]) && $_SESSION["id"]==$authors->id):?>
                                    <li><a style="width: 150px; border-radius: 0%;"
                                            href="/app/tables/users/profile.php">Всего - <?=$authors->count?> шт</a>
                                    </li>
                                    <?php else:?>
                                    <li><a style="width: 150px; border-radius: 0%;"
                                            href="/app/tables/users/profile.other.php?id=<?=$authors->id?>">Всего -
                                            <?=$authors->count?> шт</a>
                                    </li>
                                    <?php endif ?>

                                    <?php $authorCount = User::getCountAuthor($authors->id);?>
                                    <?php foreach ($authorCount as $authorCount) :?>

                                    <?php if(!empty($_SESSION["id"]) && $_SESSION["id"]==$authors->id):?>
                                    <form action="/app/tables/users/profile.php" method="POST">
                                        <li><button style="width: 150px; border-radius: 0%;" name="cateid"
                                                value="<?=$authorCount->id?>"><?=$authorCount->name?> -
                                                <?=$authorCount->count?> шт</button></li>

                                        <input type="text" name="userid" value="<?=$authors->id?>"
                                            style="display:none;">
                                    </form>
                                    <?php else:?>
                                    <form action="/app/tables/users/profile.other.filter.php" method="POST">
                                        <li><button style="width: 150px; border-radius: 0%;" name="cateid"
                                                value="<?=$authorCount->id?>"><?=$authorCount->name?> -
                                                <?=$authorCount->count?> шт</button></li>

                                        <input type="text" name="userid" value="<?=$authors->id?>"
                                            style="display:none;">
                                    </form>
                                    <?php endif ?>

                                    <?php endforeach ?>

                                </ul>
                            </div>
                        </div>


                        <?php if (!empty($_SESSION["id"]) && $_SESSION["id"] == $authors->id) : ?>
                        <a href="/app/tables/users/profile.php">
                            <img class="avtorpageava" src="/upload/users/<?=$authors->avatar?>" alt="...">
                            <?php else : ?>
                            <a href="/app/tables/users/profile.other.php?id=<?=$authors->id?>">
                                <img class="avtorpageava" src="/upload/users/<?=$authors->avatar?>" alt="...">
                                <?php endif ?>

                            </a>

                    </div>
                    <div class="down-content">
                        <h4><?=$authors->name?></h4>
                        <span>Работ: <?=$authors->count?> шт.</span>

                    </div>
                </div>
                <br>
            </div>

            <?php endforeach ?>

        </div>
    </div>
</section>


<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>