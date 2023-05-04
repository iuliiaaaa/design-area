<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";

?>

<section class="section sectop" id="products">
  <div class="col-lg-12">
    <div class="section-heading">
      <h2>Каталог</h2>
      <span>Здесь представлены все товары на нашем сайте</span>

      <br><br>
      <input type="text" class="input-seach" name="name" id="searchName" style="height: 40px;">
      <img class="serch" src="/upload/icons/search-svgrepo-com.svg" style="height: 20px; cursor: pointer; color:gray;"
        alt="">
      <label for="pseudoBtn" class="btnOpenFilter">≡</label>
      <div class="center-divvv" style="text-align: left; border: none;">

        <input type="checkbox" id="pseudoBtn" class="pseudoBtn">
        <div class="blockFilter">

          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" value="all" id="all" name="category">
            <label class="custom-control-label" for="all">Все</label>
          </div>

          <?php if(isset($_GET["id"])):?>
          <?php foreach ($categories as $category): ?>

          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" value="<?= $category->id ?>" id="<?= $category->id ?>"
              name="category" <?=$category->id == $_GET["id"]??""?"checked" :"" ?>>
            <label class="custom-control-label" for="<?= $category->id ?>">
              <?= $category->name ?>
            </label>
          </div>

          <?php endforeach ?>
          <?php else:?>
          <?php foreach ($categories as $category): ?>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" value="<?= $category->id ?>" id="<?= $category->id ?>"
              name="category">
            <label class="custom-control-label" for="<?= $category->id ?>">
              <?= $category->name ?>
            </label>
          </div>
          <?php endforeach ?>
          <?php endif?>
          <p class="count-products">Всего</p>

        </div>
      </div>
    </div>

  </div>

  <div class="container">
    <div class="row catog">

  </div>
  </div>

</section>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadProducts.js"></script>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>