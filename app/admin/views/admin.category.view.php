<?php 
session_start();

if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]){
    header("location: /");
    die();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/admin/templates/header.php";
?>

<h1 class="adstr">Категории</h1>

<div class ="orders">

<table class="table">
  <thead>
    <tr>
      <th scope="col">Название</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    
  <form action="/app/admin/tables/category/catedelete.php" method="POST">
  <?php foreach ($res as $res) :?>
    <tr>
      <th scope="row"><?= $res->name ?></th>
      <td>
        <input type="checkbox" id="<?=$res->id?>" name="<?=$res->id?>" value="<?=$res->id?>"> <label for="<?=$res->id?>">Пометить на удаление</label>
      </td>

      <td><a href="/app/admin/tables/category/editCategory.php?id=<?=$res->id?>" class="buttonforComment3" >Редактировать</a></td>
      <td><a href="/app/admin/tables/inCategory.php?id=<?=$res->id?>" class="buttonforComment3" >Товары</a></td>
    </tr>
    <tr>
    <?php endforeach?>
</thead>
</table >

</div>
<div class="orders">
<a href="/app/admin/tables/category/createCategory.php" class="buttonforComment3">Создать категорию</a>
<button class="buttonforComment3" >Удалить</button>

</div>
</form>
