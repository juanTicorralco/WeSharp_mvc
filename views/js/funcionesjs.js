/* funcion para resetear url de los filtros */
function sortProduct(event){
    let url= event.target.value.split("+")[0];
    let sort= event.target.value.split("+")[1];
    let endUrl= url.split("&")[0];
    window.location= endUrl+"&1&"+sort+"#showCase";
}
/* funcion para cear una cooky para la vitrina */
function setCookie(name, value, exp){
    let now = new Date();
    now.setTime(now.getTime() + (exp*24*60*60*1000));

    let expDate= "expires="+now.toUTCString();
    document.cookie= name + "=" + value + "; " + expDate;
    
}

/* fucion para almacenar en cookies la vitrina */
$(document).on("click",".ps-tab-list li", function(){
    setCookie("tab", $(this).attr("type"), 1);
})

/* funcion para el buscador */
$(document).on("click", ".btnSearch", function(e){
    e.preventDefault();
    let path= $(this).attr("path");
    let search= $(this).parent().children(".inputSearch").val().toLowerCase();
    let match= /^[a-z0-9ñÑáéíóú ]*$/;

    if(match.test(search)){
        let searchTest=search.replace(/[ ]/g, "_");
        searchTest=searchTest.replace(/[ñ]/g, "n");
        searchTest=searchTest.replace(/[á]/g, "a");
        searchTest=searchTest.replace(/[é]/g, "e");
        searchTest=searchTest.replace(/[í]/g, "i");
        searchTest=searchTest.replace(/[ó]/g, "o");
        searchTest=searchTest.replace(/[ú]/g, "u");

        window.location= path+searchTest;
    }else{
        $(this).parent().children(".inputSearch").val("");
    }
})

/* funcion para buscador con enter */
let inputSearch = $(".inputSearch");
let btnSearch = $(".btnSearch");

for(let i=0;i<inputSearch.length;i++){
    $(inputSearch[i]).keyup(function(e){
        e.preventDefault();
        if(e.keyCode==13 && $(inputSearch[i]).val() != ""){
            let path= $(btnSearch[i]).attr("path");
            let search= $(this).val().toLowerCase();
            let match= /^[a-z0-9ñÑáéíóú ]*$/;

            if(match.test(search)){
                let searchTest=search.replace(/[ ]/g, "_");
                searchTest=searchTest.replace(/[ñ]/g, "n");
                searchTest=searchTest.replace(/[á]/g, "a");
                searchTest=searchTest.replace(/[é]/g, "e");
                searchTest=searchTest.replace(/[í]/g, "i");
                searchTest=searchTest.replace(/[ó]/g, "o");
                searchTest=searchTest.replace(/[ú]/g, "u");

                window.location= path+searchTest;
            }else{
                $(this).val("");
            }
        }
    })
}

/* funcion para cambiar la cantidad del carrito */
function  changeQualyty(quantity, move, stock){
    let number=1;
    if(Number(quantity) > stock-1){
        quantity= stock -1;
    }
    if(move=="up" ){
            number = Number(quantity)+1;
        
    }
    if(move == "down" && Number(quantity)>1){
        number=Number(quantity)-1;
    }

    $(".quantity input").val(number);
}