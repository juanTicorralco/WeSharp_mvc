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

/* funcion para validar un formiulario */
function validatejs(e, tipo){
    if(tipo=="text"){
        let pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/;
    if(!pattern.test(e.target.value)){
        $(e.target).parent().addClass("was-validated");
        $(e.target).parent().children(".invalid-feedback").html("No uses numeros ni caracteres especiales");
        return;
    }} else if(tipo=="email"){
        let pattern = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
        if(!pattern.test(e.target.value)){
            $(e.target).parent().addClass("was-validated");
            $(e.target).parent().children(".invalid-feedback").html("Solo se acepta un formato email");
            return;
        }
    }else if(tipo=="pass"){
        let pattern = /^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/;
        if(!pattern.test(e.target.value)){
            $(e.target).parent().addClass("was-validated");
            $(e.target).parent().children(".invalid-feedback").html("No se admiten espacios ni tampoco algunos caracteres especiales");
            e.target.value="";
            return;
        }
    }
}

/* funcion para validar un formiulario */
function emailRepeat(e){
    let settings={
        "url": $("#urlApi").val()+"users?equalTo="+e.target.value+"&linkTo=email_user&select=email_user",
        "metod": "GET",
        "timeaot": 0,
    };

    $.ajax(settings).done(function(response){
        if(response.status==200){    
        $(e.target).parent().addClass("was-validated");
        $(e.target).parent().children(".invalid-feedback").html("Este email ya esta registrado");
        e.target.value="";
        return;
        }
    }); 

    validatejs(e, "email");
}