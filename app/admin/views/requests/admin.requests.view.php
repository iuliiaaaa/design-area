<?php 
session_start();

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/templates/header.php";

?>
<div class="air"></div>
<h1 class="adstr">Заявки</h1>
<div class="air"></div>

<div class="orders">

  <a href="/app/admin/tables/products.php" class="buttonforComment3">Опубликованные</a>
  <a href="/app/admin/tables/requests/admin.requests.pending.php" class="buttonforComment3">В ожидании</a>
  <a href="/app/admin/tables/requests/admin.requests.rejected.php" class="buttonforComment3">Отклоненные</a>
  <div class="air"></div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Номер заявки</th>
        <th scope="col">Статус</th>
        <th scope="col">Пользователь</th>
        <th scope="col">Дата подачи</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($request as $request) :?>
      <tr>
        <th scope="row">
          <?= $request->id?>
        </th>
        <th scope="row">
          <?= $request->status?>
        </th>
        <th scope="row">
          <?= $request->login?>
        </th>
        <th scope="row">
          <?= $request->date_departures?>
        </th>

        <th><a href="/app/admin/tables/requests/requestProduct.php?id=<?=$request->product_id?>"
            class="buttonforComment3">Просмотр</a></th>
        <td>
      </tr>
      <tr>
        <?php endforeach?>
        </thead>
  </table>
  