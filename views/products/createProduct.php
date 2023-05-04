<?php 
session_start();


session_start();
if(!isset($_SESSION["auth"]) || !$_SESSION["auth"]){
    header("location: /app/tables/users/auth.php");
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php"; 
?>

<br><br><br>

<form action="/app/tables/products/save.products.php" method="POST" enctype="multipart/form-data">
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">
                        <label>
                            <img id="blah" class="blaha" style="object-fit: cover;" src="/upload/img/newReq.jpg" alt="">
                            <input name="image" accept="image/*" type='file' id="imgInp" name="image"
                                style="display:none;" />
                        </label>
                    </div>
                </div>
                <div class="col-lg-4" style="margin-top: -25px;">
                    <div class="right-content">

                        <span>Название</span>
                        <input type="text" style=" width: 250px;" name="name">

                        <span>Категории</span>
                        <select name="category_id" style=" width: 250px;">
                            <?php foreach ($categories as $category) :?>
                            <option value="<?=$category->id?>"><?=$category->name?></option>
                            <?php endforeach?>
                        </select>

                        <span>Цена</span>
                        <input type="number" style=" width: 250px;" name="price">


                        <span>Описание: </span>
                        <input type="text" style=" width: 250px;" name="discription">

                        <br><br>
                        <button class="buttonforComment">Отправить</button>

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
    }
</script>


<div class="nrdf"></div>
<style>
    .nrdf {
        height: 300px;
    }
</style>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php" ?>