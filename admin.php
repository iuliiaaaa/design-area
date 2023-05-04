<?php 
session_start();

?>

<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">

<link rel="stylesheet" href="/assets/css/owl-carousel.css">
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/style2.css">

<title>Вход в панель Администратора</title>

<div class="center-div3">

    <form action="/app/tables/users/authCheckAdmin.php" method="post" class="form">


        <label for="login" class="form-label">Ваш логин</label>
        <br>
        <input class="form-control auth" value="<?= $_SESSION[" login"]??"" ?>" type="text" name="login"
        class="form-control" id="login">
        <br>

        <label for="password" class="form-label">Пароль</label>
        <br>
        <input class="form-control auth" type="password" name="password" class="form-control" id="password">

        <p class="error">
            <?= $_SESSION["error"]??"" ?>
        </p>
        <br>
        <button class="buttonforComment3" name="btn">Войти</button>

    </form>
</div>


<style>
    .error {
        color: red;
    }
</style>

<?php unset($_SESSION["error"]); ?>