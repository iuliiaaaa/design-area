<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";

?>

<div class="center-div3">

    <div class="col-lg-12">
        <div class="under-footer">
            <ul>
                <li><a href="/"><img style="height: 30px;" src="/upload/icons/logoone.svg" alt=""></a></li>

            </ul>
        </div>
    </div>

    <form action="/app/tables/users/insert-user.php" method="post" class="formaa" enctype="multipart/form-data">
        <h6>
            <?= $_SESSION["res"] ?? "" ?>
        </h6>

        <br>
        <label for="name" class="form-label">Ваше имя</label>
        <input value="<?= $_SESSION[" name"] ?? "" ?>" type="text" name="name" class="form-control" id="name">
        <p class="right-p">
            <?= $_SESSION["errors"]["name"] ?? "" ?>
        </p>

        <br>

        <label for="login" class="form-label">Логин</label>
        <input value="<?= $_SESSION[" login"] ?? "" ?>" type="text" name="login" class="form-control" id="login">
        <p class="right-p">
            <?= $_SESSION["errors"]["login"] ?? "" ?>
        </p>

        <br>

        <label for="avatar" class="form-label">Фото профиля</label><br>

        <label>
            <img id="blah" class="blaha" style="object-fit: cover; border-radius:100%; height: 75px; width:75px;"
                src="/upload/users/defprofileava.jpg" alt="">
            <input name="image" accept="image/*" type='file' id="imgInp" style="display:none;" />
        </label>

        <br>

        <label for="email" class="form-label">ваша почта</label>
        <input value="<?= $_SESSION[" email"] ?? "" ?>" type="text" name="email" class="form-control" id="email">
        <p class="right-p">
            <?= $_SESSION["errors"]["email"] ?? "" ?>
        </p>
        <br>

        <label for="vk" class="form-label">Ваша страница в ВК</label>
        <input value="<?= $_SESSION[" vk"] ?? "" ?>" type="text" name="vk" class="form-control" id="vk">
        <br>

        <label for="tg" class="form-label">Ваш профиль в Телеграме</label>
        <input value="<?= $_SESSION[" tg"] ?? "" ?>" type="text" name="tg" class="form-control" id="tg">
        <br>

        <label for="password" class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control" id="password">
        <br>
        <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
        <p class="right-p">
            <?= $_SESSION["errors"]["password"] ?? "" ?>
        </p>

        <br>
        <br>

        <button class="buttonforComment3" name="btn">Зарегистрироваться</button>

    </form>
</div>

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

<style>
    .right-p {
        color: red;
    }
</style>