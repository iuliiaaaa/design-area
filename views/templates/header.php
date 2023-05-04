<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="ru">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title><?=$name_page?></title>

    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
 
    <link rel="stylesheet" href="/assets/css/style2.css">
    <link rel="stylesheet" href="/assets/css/owl-carousel.css">

    <link rel="icon" type="image/x-icon" href="/upload/icons/logoone.svg">
    </head>
    
    <body>
    
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">

                        <a href="/" class="logo">
                            <img src="/upload/icons/logo.png">
                        </a>

                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/" >Главная</a></li>
                            <li class="scroll-to-section"><a href="/app/tables/products/catalog.php">Каталог</a></li>
                            <li class="scroll-to-section"><a href="/app/tables/users/authors.php">Авторы</a></li>
                            <?php if (!isset($_SESSION["auth"]) || !$_SESSION["auth"]) : ?>
                            <li class="scroll-to-section"><a href="/app/tables/users/auth.php">Войти</a></li>
                            <li class="scroll-to-section"><a href="/app/tables/users/create.php">Регистрация</a></li>
                            <?php else : ?>
                                <li class="scroll-to-section"><a href="/app/tables/products/requests.php">Создать заявку</a></li>
                                <li class="scroll-to-section"><a href="/app/tables/users/profile.php"><?= $_SESSION["login"] ?></a></li>
                                <li class="scroll-to-section"><a href="/app/tables/users/logaut.php">Выйти</a></li>
                                <?php endif ?>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Меню</span>
                        </a>

                    </nav>
                </div>
            </div>
        </div>
    </header>
