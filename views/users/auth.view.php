<?php 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php"; 
?>

<br><br><br>

<div class="center-div3">
    <div class="col-lg-12">
        <div class="under-footer">
            <ul>
                <li><a href="/"><img style="height: 30px;" src="/upload/icons/logoone.svg" alt=""></a></li>

            </ul>
        </div>
    </div>
    <form action="/app/tables/users/authCkeck.php" method="post" class="form">

        <br>

        <label for="login" class="form-label">Ваш логин</label>
        <input value="<?= $_SESSION[" login"]??"" ?>" type="text" name="login" class="form-control auth" id="login">

        <br>

        <label for="password" class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control auth" id="password">

        <p class="error">
            <?= $_SESSION["error"]??"" ?>
        </p>
        <br>
        <div class="form-group">
            <button class="buttonforComment2" name="btn">Войти</button>
        </div>

        <a href="/app/tables/users/create.php" style="color:black; border-bottom: 1px solid black;">Еще нет
            аккаунта?
        </a>

    </form>
</div>

<br><br>
<?php // require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>

<style>
    .error {
        color: red;
    }
</style>

<?php unset($_SESSION["error"]); ?>

<script src="/assets/js/jquery-2.1.0.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/owl-carousel.js"></script>
<script src="/assets/js/scrollreveal.min.js"></script>
<script src="/assets/js/custom.js"></script>