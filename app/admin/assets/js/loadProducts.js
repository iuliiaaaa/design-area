document.addEventListener("DOMContentLoaded", async () => {
  let countProducts = document.querySelector(".count-products");
  let containerProducts = document.querySelector(".productAdm");
  let categoriesChecks = document.querySelectorAll("[name = category]");

  let search = document.getElementById('searchName');

  let catsChecks = document.querySelectorAll("[name = category]:not(#all)");

  let categoriesAllCheck = document.getElementById("all");


  let categoriesChecked = [...categoriesChecks]
  .filter((item) => item.checked)
  .map((item) => item.value);
  await getProductsByCategories(categoriesChecked)
  let valuesChecks = [];

  catsChecks.forEach((i) => {
    valuesChecks.unshift(i.value);
  });

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
      if (checksChecked(catsChecks)) categoriesAllCheck.checked = true;
      else categoriesAllCheck.checked = false;


      let categoriesChecked = [...categoriesChecks]
        .filter((item) => item.checked)
        .map((item) => item.value);
      await getProductsByCategories(categoriesChecked);
    });
  });


  async function getProductsByCategories(categoriesID) {

    let parameter = new URLSearchParams();
    parameter.append("category", JSON.stringify(categoriesID));

    let products = await getData("/app/tables/products/search.check.php", parameter);
    outOnPange(products);
  }
  async function getProductsByCategoriesONserch(categoriesID, serchText) {

    let parameter = new URLSearchParams();
    parameter.append("category", JSON.stringify(categoriesID));

    let products = await getData("/app/tables/products/search.check.php", parameter);
    outOnPangeONserch(products, serchText)
  }

  function outOnPange(products) {
    countProducts.textContent = products.length + " шт";

    containerProducts.innerHTML = "";

    products.forEach((product) => {
      containerProducts.insertAdjacentHTML("beforeend", getOneCard(product));
    });
  }
  function outOnPangeONserch(products, serchText) {
    countProducts.textContent = products.length + " шт";

    containerProducts.innerHTML = "   ";
    console.log(serchText)
    products.forEach((product) => {
      if(product.product_name == serchText){
        containerProducts.insertAdjacentHTML("beforeend", getOneCard(product));
      }

    });
  }





  function getOneCard({product_id, product_name, updated_at, category, price}) {
    return `
    
    <tr>
    
    <td>${product_name}</td>
    <td>${price}</td>
    <td>${category}</td>
    <td>${updated_at}</td>
    <td><a href="/app/admin/tables/requests/requestProduct.php?id=${product_id}" name="btn_show" class="buttonforComment3" >Просмотр</a></td>
   </tr>
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
