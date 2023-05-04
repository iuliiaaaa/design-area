//получение данных
 async function getData(route, params = "") {
  if (params != "") {
    route += `?${params}`;
  }
  let response = await fetch(route);
  
  return await response.json();
}

//передача данных в формате json
 async function postJSON(route, data, action){
    let response = await fetch(route, {
        method: "POST",
        headers: {
          "Content-Type": "application/json;charset=UTF-8", //обязательный заголовок для формата json
        },
        body: JSON.stringify({data, action}),
      });
      
      return await response.json();

}


