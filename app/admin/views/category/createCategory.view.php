<?php 
session_start();

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/templates/header.php";
?>

<h1 class="adstr">Создание категории</h1>

<div class="center-div3">

  <form action="/app/admin/tables/newCategory.php" method="post" class="form" enctype="multipart/form-data">

    <label for="name">Название</label>
    <input type="text" name="name" class="form-control auth">
    <br>

    <label for="small-des">Мини описание</label>
    <input type="text" name="small-des" class="form-control auth">
    <br>

    <br>
    <label>
      <img id="blah" style="object-fit: cover; width: 300px; height: 300px" src="/upload/img/newReq.jpg" alt="">
      <input accept="image/*" type='file' id="imgInp" name="img" style="display:none;" />
    </label>

    <label for="title">На главную страницу</label>
    <input type="checkbox" name="title" id="title">

    <br>

    <button class="buttonforComment3">Добавить</button>

  </form>
</div>


<script>
  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }</script>