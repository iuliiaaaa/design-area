<?php 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php"; 


?>

<br><br><br>

<form action="/app/tables/products/save.edit.php" method="POST" enctype="multipart/form-data">

  <section class="section" id="product">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="left-images">
            <img id="blah" style="object-fit: cover;" src="/upload/<?= $product->photo?>" alt="">
          </div>
        </div>
        <div class="col-lg-4" style="margin-top: -25px;">
          <div class="right-content">

            <span>Название</span>
            <input type="text" style=" width: 250px;" name="name" value="<?=$product->product_name?>">

            <span>категории</span>
            <input type="text" disabled style=" width: 250px;" value="<?= $product->category?>">

            <span>Цена</span>
            <input type="number" style=" width: 250px;" name="price" value="<?=$product->price?>">

            <span>Описание: </span>
            <input type="text" style=" width: 250px;" name="discription" value="<?=$product->description?>">

            <span><?=$product->updated_at?></span>
            <br><br>
            <button name="id" value="<?= $product->product_id?>" class="buttonforComment">Сохранить</button>

          </div>
        </div>
      </div>
    </div>
  </section>

</form>


<script>
  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
      blah.classList.add("blah");
    }
  }</script>


<div class="nrdf"></div>
<style>
  .nrdf {
    height: 300px;
  }
</style>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php" ?>