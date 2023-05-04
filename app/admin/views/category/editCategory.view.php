<?php 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/templates/header.php";

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

?>


<form action="/app/admin/tables/category/save.edit.category.php" method="POST" enctype="multipart/form-data">
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">

                        <label>
                            <img id="blah" style="object-fit: cover; " src="/upload/img/<?= $category->img?>" alt="">
                            <input accept="image/*" type='file' id="imgInp" name="img" style="display:none;" />
                        </label>

                    </div>
                </div>
                <div class="col-lg-4" style="margin-top: -25px;">
                    <div class="right-content">

                        <span>Название</span>
                        <input style="border: 1px black solid"  name="name" type="text" value="<?=$category->name?>">

                        <span>Описание</span>
                        <input style="border: 1px black solid" type="text" name="small_des" value="<?= $category->small_description?>">

                        <span>На главную</span>

                        <?php if($category->main==1):?>
                        <input type="radio" id="contactChoice2" name="main" value="1" checked>
                        <label for="contactChoice2">На главную</label>

                        <input type="radio" id="contactChoice3" name="main" value="0">
                        <label for="contactChoice3">Просто категория</label>
                        <?php else:?>
                        <input type="radio" id="contactChoice2" name="main" value="1">
                        <label for="contactChoice2">На главную</label>

                        <input type="radio" id="contactChoice3" name="main" value="0" checked>
                        <label for="contactChoice3">Просто категория</label>
                        <?php endif?>

                        <br>

                        <button name="id" value="<?= $category->id?>" class="buttonforComment3">Сохранить</button>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <input name="oldimg" type="text" value="<?= $category->img?>" style="display: none;">
</form>


<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }</script>