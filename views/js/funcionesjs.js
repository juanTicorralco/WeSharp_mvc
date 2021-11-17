function sortProduct(event){
    let url= event.target.value.split("+")[0];
    let sort= event.target.value.split("+")[1];
    let endUrl= url.split("&")[0];
    window.location= endUrl+"&1&"+sort;
}


/* fucion para almacenar en cookies la vitrina */
$(document).on("click",".ps-tab-list li", function(){
    console.log($(this).attr("type"));
    console.log("hola");
})