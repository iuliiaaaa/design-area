<?php 
session_start();

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/templates/header.php";

?>

<h1 class="adstr">Клиенты</h1>
<div class="air"></div>
<div class="orders">

  <a href="/app/admin/tables/clients/banned.php" class="buttonforComment3">Заблокированные</a>
  <a href="/app/admin/tables/clients/nobanned.php" class="buttonforComment3">не бане</a>
  <a href="/app/admin/tables/clients/authors.php" class="buttonforComment3">Авторы</a>
  <a href="/app/admin/tables/clients/users.php" class="buttonforComment3">Пользователи</a>

  <div class="air"></div>

  <form action="/app/admin/tables/clients/search.php" method="POST">
    <label for="name">Поиск по имени</label>
    <input type="text" style="border:1px solid black; height: 45px; width: 200px;" name="name" id="searchName">
    <button class="buttonforComment3">Найти</button>
  </form>
  <div class="air"></div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Логин, имя</th>
        <th scope="col">Почта</th>
        <th scope="col">Количество работ</th>
        <th scope="col">Статус</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($res as $res) :?>
      <tr>
        <th scope="row"><?=$res->id?></th>
        <th scope="row"><?=$res->login?>, <?=$res->name?></th>
        <th scope="row"><?=$res->email?></th>
        <th scope="row"><?=$res->count?></th>
        <?php if($res->is_blocked==0):?>
        <th scope="row">Пользователь</th>
        <?php else:?>
        <th scope="row">Забанен</th>
        <?php endif?>
        <th><a href="/app/admin/tables/clients/client.php?id=<?=$res->id?>" class="buttonforComment3">Просмотр</a></th>
        <td>
      </tr>
      <tr>
        <?php endforeach?>
        </thead>
  </table>
  