<?php 
session_start();
if(!isset($_SESSION["auth"]) || !$_SESSION["auth"]){
    header("location: /");
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";

?>

<div class="center-div3">

    <form action="/app/tables/users/save.profile.php" method="post" class="formaa" enctype="multipart/form-data">
        <h6>
            <?= $_SESSION["res"] ?? "" ?>
        </h6>
        <br>
        <input type="text" name="oldavatar" value="<?= $user->avatar?>" style="display:none;">

        <label>
            <img id="blah" class="blaha" style="object-fit: cover; border-radius:100%; height: 100px; width:100px;"
                src="/upload/users/<?= $user->avatar?>" alt="">
            <input name="image" accept="image/*" type='file' id="imgInp" style="display:none;" />
        </label>

        <br>
        <label for="name" class="form-label">Ваше имя</label>
        <input value="<?= $user->name?>" type="text" name="name" class="form-control" id="name">
        <p class="right-p">
            <?= $_SESSION["errors"]["name"] ?? "" ?>
        </p>

        <br>

        <label for="login" class="form-label">Логин</label>
        <input value="<?= $user->login?>" type="text" name="login" class="form-control" id="login">
        <p class="right-p">
            <?= $_SESSION["errors"]["login"] ?? "" ?>
        </p>

        <br>

        <label for="email" class="form-label">ваша почта</label>
        <input value="<?= $user->email?>" type="text" name="email" class="form-control" id="email">
        <p class="right-p">
            <?= $_SESSION["errors"]["email"] ?? "" ?>
        </p>
        <br>
        <input type="text" name="contact_id" value="<?= $user->contact_id?>" style="display: none;">
        <label for="vk" class="form-label">Ваша страница в ВК</label>
        <input value="<?= $user->vk?>" type="text" name="vk" class="form-control" id="vk">
        <br>

        <label for="tg" class="form-label">Ваш профиль в Телеграме</label>
        <input value="<?= $user->tg?>" type="text" name="tg" class="form-control" id="tg">
        <br>

        <label for="password" class="form-label">Старый пароль</label>
        <input type="password" name="oldpass" class="form-control" id="password">
        <br>
        <label for="password_confirmation" class="form-label">Новый пароль</label>
        <input type="password" name="newpass" class="form-control" id="password_confirmation">

        <input type="text" name="tryOldPass" value="<?= $user->password?>" style="display: none;">
        <p class="right-p">
            <?= $_SESSION["errors"]["password"] ?? "" ?>
        </p>

        <br>
        <br>

        <button class="buttonforComment3" name="id" value="<?= $user->id?>">Сохранить</button>

    </form>
</div>

<style>
    .right-p {
        color: red;
    }
</style>

<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
            blah.classList.add("blah");
        }
    }</script>


<script src="/assets/js/jquery-2.1.0.min.js"></script>

<script src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/owl-carousel.js"></script>
<script src="/assets/js/scrollreveal.min.js"></script>

<script src="/assets/js/custom.js"></script>

<?php
unset($_SESSION["res"]);
?>
















<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php" ?>