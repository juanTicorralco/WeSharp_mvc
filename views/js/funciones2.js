/* funcion para formatear las alertas */
function formatearAlertas(){
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href)
    }
}