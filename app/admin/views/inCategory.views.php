<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/templates/header.php";

session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

?>
<div class="air"></div>
<h1 class="adstr">Товары в категории </h1>
<div class="air"></div>

<div class="orders">

  <table class="table">

    <thead>
      <tr>
        <th scope="col">Название </th>
        <th scope="col">Цена </th>
        <th scope="col">Картинка </th>
        <th scope="col">Категория </th>
        <th scope="col">Дата обноваления</th>
        <th scope="col"></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($res as $prod) :?>
      <tr>
        <td><?=$prod->name?></td>
        <td><?=$prod->price?></td>
        <td><?=$prod->photo?></td>
        <td><?=$prod->category?></td>
        <td><?=$prod->updated_at?></td>
        <td><a href="/app/admin/tables/requests/requestProduct.php?id=<?=$prod->id?>" name="btn_show"
            class="buttonforComment3">Просмотр </a></td>
      </tr>

      <?php endforeach?>
      </thead>
  </table>
  <a class="buttonforComment3 " href="/app/admin/tables/category.php">Обратно</a>
</div>
