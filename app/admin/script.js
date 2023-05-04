document.querySelector("#file").addEventListener("change", function(e){
    let file=  e.target.files["0"]
   document.querySelector("#img").setAttribute("src", URL.createObjectURL(file) )
   URL.revokeObjectURL(file)
})