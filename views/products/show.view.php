<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php"; 
session_start();


?>


<br><br>
<section class="section borders" id="product">
  <?php if(isset($_SESSION["open_comment"])):?>
  <div style="display:none" id="open_comment_block_aaaa"></div>
  <?php endif?>
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="left-images ">
          <img class="imgshowoneprod" src="/upload/<?= $product->photo?>" alt="">

        </div>
      </div>
      <div class="col-lg-4">
        <div class="right-content">
          <h4>
            <?= $product->product_name?>
          </h4>

          <b><span><a style="color:black; border-top: 1px gray solid;  border-bottom: 1px gray solid; padding:5px;"
                href="/app/tables/products/catalog.php?id=<?=$product->cateid?>">Категория:
                <?= $product->category?>
              </a></span></b>

          <br>

          <span class="price">
            <?= $product->price?> ₽
          </span>


          <ul class="stars">
            <li>
              <?= $product->updated_at?>
            </li>
          </ul>
          <span>Описание: <br>
            <?= $product->description?>
          </span>


          <?php if (!empty($_SESSION["id"]) && $_SESSION["id"] == $product->user_id) : ?>
          <div class="quantity-content">
            <a href="/app/tables/users/profile.php"> <img class="avaavtor3" src="/upload/users/<?= $product->ava?>"
                alt="">
              <h4>
                <?= $product->username?>
              </h4>
            </a>

          </div>
          <?php else : ?>

          <div class="quantity-content">
            <a href="/app/tables/users/profile.other.php?id=<?=$product->user_id?>"> <img class="avaavtor3"
                src="/upload/users/<?= $product->ava?>" alt="">
              <h4>
                <?= $product->username?>
              </h4>
            </a>

          </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="section bordertop" id="men">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="section-heading">
          <h2>Похожие товары</h2>
          <span>В категории
            <?= $product->category?>
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="men-item-carousel">
          <div class="owl-men-item owl-carousel">

            <?php foreach ($last as $last) :?>

            <div class="item">
              <div class="thumb">

                <a href="/app/tables/products/show.php?id=<?=$last->product_id?>">
                  <img class="fcinindex" src="/upload/<?=$last->photo?>" alt="">
                </a>
              </div>
              <div class="down-content">
                <h4><?=$last->product_name?></h4>
                <span><?=$last->price?> ₽</span>

              </div>
            </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<br><br>
<div class="center-divComment">
  <input id="click-to-hide-2" type="button" class="buttonforComment" value="Показать комменарии">

</div>

<div class="wpcraft-box-2 hide-element">

  <?php if(!isset($_SESSION["auth"]) || !$_SESSION["auth"]):?>
  <p style="text-align: center; "><a style="color:black; border-bottom: 1px solid gray"
      href="/app/tables/users/auth.php">авторизируйся чтобы написать комментарий</a> </p>
  <?php else : ?>

  <form action="/app/tables/users/comment.php" method="POST" enctype="multipart/form-data">
    <div class="center-divCC">
      <div class="inner">
        <input name="content" class="inputforcomment" type="text" id="name" placeholder="Ваш комментарий">
        <label>
          <input accept="image/*" type='file' id="imgInp" name="image" style="display:none;" />
          <img src="/upload/icons/file.svg" class="fileprek" alt="">
        </label>
        <br>
        <div class="forcenter">
          <button name="prodid" value="<?=$product->product_id?>" class="buttonforComment">Отправить</button>
          <p>
            <?=$_SESSION["errorsComment"]??""?>
          </p>
          <br><br>
          <img id="blah" style="width: 250px; object-fit: cover;" src="#" alt="" />
        </div>

      </div>
    </div>
  </form>
  <?php endif ?>



  <br><br>

  <?php if(!empty($reviews)) :?>


  <?php foreach ($reviews as $reviews) :?>


  <div class="center-divC" style=" border: 1px solid rgba(0, 0, 0, 0.438);">
    <div class="inner">

      <?php if (!empty($_SESSION["id"]) && $_SESSION["id"] == $reviews->user_id) : ?>
      <a href="/app/tables/users/profile.php" style="color:black;">
        <img src="/upload/users/<?=$reviews->avatar?>" class="avaavtorCom" alt="">
        <?= $reviews->username?>
      </a>
      <br><br>
      <?php else : ?>
      <a style="color:black;" href="/app/tables/users/profile.other.php?id=<?=$reviews->user_id?>">

        <img src="/upload/users/<?=$reviews->avatar?>" class="avaavtorCom" alt="">
        <?= $reviews->username?>
      </a>
      <?php endif ?>

      <p class="commentContetnt">
        <?= $reviews->content?>
      </p>

      <br>
      <div class="forcenter">


        <?php if ($reviews->photo_comment !=NULL):?>

        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
          tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-body">
                <img src="/upload/comment/<?=$reviews->photo_comment?>" alt="">
              </div>

            </div>
          </div>
        </div>

        <img src="/upload/comment/<?=$reviews->photo_comment?>" style="width: 250px; object-fit: cover;" alt="">
        <br><br>

        <?php else : ?>
        <?php endif ?>


        <?php if (!empty($_SESSION["id"]) && $_SESSION["id"] == $reviews->user_id || !empty($_SESSION["admin"]) && $_SESSION["admin"]==true)  : ?>

        <form action="/app/tables/users/deleteComment.php" method="POST">
          <input name="image" type="text" value="<?=$reviews->photo_comment?>" style="display:none">
          <input name="prod" type="text" value="<?=$reviews->product_id?>" style="display:none">
          <button class="buttonforCommentDel" name="btn-delete" value="<?=$reviews->id?>">Удалить</button>
          <p style="text-align: left; margin-left:10px;">
            <?= $reviews->date_writing?>
          </p>
        </form>
        <?php else : ?>
        <p style="text-align: left; margin-left:10px;">
          <?= $reviews->date_writing?>
        </p>
        <?php endif ?>


      </div> <br>
    </div>
  </div>
  <br>
  <?php endforeach?>

  <?php else:?>
  <p style="text-align: center;">Комментариев пока нет, вы можете оставить первый комментарий!</p>

  <?php endif?>
</div>


<script>
  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
      blah.classList.add("blah");
    }
  }</script>


<style>
  .hide-element {
    display: none !important;
  }
</style>

<script>
  let clickToHide2 = document.querySelector('#click-to-hide-2');
  clickToHide2.addEventListener("click", hideVisibleElem);
  let block = document.querySelector("#open_comment_block_aaaa")
  if (block != null) {
    hideVisibleElem()
  }
  function hideVisibleElem() {
    let wpcraftBox2 = document.querySelector('.wpcraft-box-2');
    wpcraftBox2.classList.toggle("hide-element");

    if (wpcraftBox2.classList.contains("hide-element")) {
      clickToHide2.value = 'Показать комментарии ';
    } else {
      clickToHide2.value = 'Скрыть комментарии';
    }
  }
</script>

<?php 
unset($_SESSION["errorsComment"]);
unset($_SESSION["open_comment"]);
require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>