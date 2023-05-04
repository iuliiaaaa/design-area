document.addEventListener("DOMContentLoaded", async () => {
  let countProducts = document.querySelector(".count-products");
  let containerProducts = document.querySelector(".catog");
  let categoriesChecks = document.querySelectorAll("[name = category]");

  let search = document.getElementById('searchName');

  let catsChecks = document.querySelectorAll("[name = category]:not(#all)");

  let categoriesAllCheck = document.getElementById("all");


  //
  let categoriesChecked = [...categoriesChecks]
  .filter((item) => item.checked)
  .map((item) => item.value);
  await getProductsByCategories(categoriesChecked)
  let valuesChecks = [];

  catsChecks.forEach((i) => {
    valuesChecks.unshift(i.value);
  });
//



  // getProductsByCategories(valuesChecks);


  function checksChecked(arr) {
    check = 0;
    arr.forEach((i) => {
      if (i.checked) check++;
    });

    return check == arr.length;
  }


  categoriesAllCheck.addEventListener("change", () => {

    if (categoriesAllCheck.checked) {
      catsChecks.forEach((i) => {
        i.checked = true;
      });
    } else {
      catsChecks.forEach((i) => {
        i.checked = false;
      });
    }
  });


  categoriesChecks.forEach((btn) => {
    btn.addEventListener("change", async () => {
      //проверка для включения ВСЁ
      if (checksChecked(catsChecks)) categoriesAllCheck.checked = true;
      else categoriesAllCheck.checked = false;


      let categoriesChecked = [...categoriesChecks]
        .filter((item) => item.checked)
        .map((item) => item.value);
      await getProductsByCategories(categoriesChecked);
    });
  });


  async function getProductsByCategories(categoriesID) {

    //2 способ
    let parameter = new URLSearchParams();
    parameter.append("category", JSON.stringify(categoriesID));

    let products = await getData("/app/tables/products/search.check.php", parameter);
    outOnPange(products);
  }
  async function getProductsByCategoriesONserch(categoriesID, serchText) {

    //2 способ
    let parameter = new URLSearchParams();
    parameter.append("category", JSON.stringify(categoriesID));

    let products = await getData("/app/tables/products/search.check.php", parameter);
    outOnPangeONserch(products, serchText)
  }

  function outOnPange(products) {
    countProducts.textContent = "Всего: " + products.length + " шт";

    containerProducts.innerHTML = "";

    products.forEach((product) => {
      containerProducts.insertAdjacentHTML("beforeend", getOneCard(product));
    });
  }
  function outOnPangeONserch(products, serchText) {
    countProducts.textContent = products.length + " шт";

    containerProducts.innerHTML = "";
    console.log(serchText)
    products.forEach((product) => {
      if(product.product_name == serchText){
        containerProducts.insertAdjacentHTML("beforeend", getOneCard(product));
      }

    });
  }





  function getOneCard({product_id, product_name, photo, category, price}) {
    return `
  
    <div class="col-lg-4 pagitem">
    <div class="item">
        <div class="thumb">
        <a href="/app/tables/products/show.php?id=${product_id}">
            <img class="imgCatalog" src="/upload/${photo}" alt="">
            </a>
        </div>
        <div class="down-content">
            <h4>${product_name}</h4>
            <span>${price} ₽</span>
            <ul class="stars">
            <li>Категория: ${category}</li>
            </ul>
        </div>
    </div>
</div>
        `;
  }

  document.addEventListener("click", function(e){
    if(e.target.classList.contains("serch")){
      let sechText = document.querySelector("#searchName").value
      let categoriesChecked = [...categoriesChecks]
      .filter((item) => item.checked)
      .map((item) => item.value);
      getProductsByCategoriesONserch(categoriesChecked, sechText)
    }
  })

});
