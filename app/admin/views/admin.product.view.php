<?php 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/templates/header.php";


if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}
?>
<div class="air"></div>
<h1 class="adstr">Все товары</h1>
<div class="air"></div>

<div class="bur1 orders2">

  <div class="poisk-seach ">
    <input class="input-seach" style="border:1px solid black; height: 45px; width: 200px; border-radius:0%;" name="name"
      id="searchName" type="text">

    <button class="serch buttonforComment3">Найти</button>
  </div>
</div>
<div class="form-check orders3">
  <input value="all" id="all" class="form-check-input" type="checkbox" name="category">
  <label class="form-check-label" for="all">Все</label>
</div>

<?php foreach ($categories as $category) : ?>
<div class="form-check orders3">
  <input value="<?= $category->id ?>" id="<?= $category->id ?>" class="form-check-input" type="checkbox"
    name="category">
  <label class="form-check-label" for="<?= $category->id ?>">
    <?= $category->name ?>
  </label>
</div>
<?php endforeach ?>

<p class="count-products orders3"></p>

<style>
  table {
    width: 100%;
    background: white;
    color: black;
    border-spacing: 50px;
  }

  td,
  th {
    padding: 5px;
    border-bottom: 1px rgba(128, 128, 128, 0.420) solid;
  }
</style>
<div class="orders3">
  <table>

  </table>
  <table class="productAdm">
    <hr>
  </table>
</div>

<script src="/app/admin/assets/js/fetch.js"></script>
<script src="/app/admin/assets/js/loadProducts.js"></script>