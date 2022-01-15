/* funcion para resetear url de los filtros */
function sortProduct(event) {
  let url = event.target.value.split("+")[0];
  let sort = event.target.value.split("+")[1];
  let endUrl = url.split("&")[0];
  window.location = endUrl + "&1&" + sort + "#showCase";
}
/* funcion para cear una cooky para la vitrina */
function setCookie(name, value, exp) {
  let now = new Date();
  now.setTime(now.getTime() + exp * 24 * 60 * 60 * 1000);

  let expDate = "expires=" + now.toUTCString();
  document.cookie = name + "=" + value + "; " + expDate;
}

/* fucion para almacenar en cookies la vitrina */
$(document).on("click", ".ps-tab-list li", function () {
  setCookie("tab", $(this).attr("type"), 1);
});

/* funcion para el buscador */
$(document).on("click", ".btnSearch", function (e) {
  e.preventDefault();
  let path = $(this).attr("path");
  let search = $(this).parent().children(".inputSearch").val().toLowerCase();
  let match = /^[a-z0-9ñÑáéíóú ]*$/;

  if (match.test(search)) {
    let searchTest = search.replace(/[ ]/g, "_");
    searchTest = searchTest.replace(/[ñ]/g, "n");
    searchTest = searchTest.replace(/[á]/g, "a");
    searchTest = searchTest.replace(/[é]/g, "e");
    searchTest = searchTest.replace(/[í]/g, "i");
    searchTest = searchTest.replace(/[ó]/g, "o");
    searchTest = searchTest.replace(/[ú]/g, "u");

    window.location = path + searchTest;
  } else {
    $(this).parent().children(".inputSearch").val("");
  }
});

/* funcion para buscador con enter */
let inputSearch = $(".inputSearch");
let btnSearch = $(".btnSearch");

for (let i = 0; i < inputSearch.length; i++) {
  $(inputSearch[i]).keyup(function (e) {
    e.preventDefault();
    if (e.keyCode == 13 && $(inputSearch[i]).val() != "") {
      let path = $(btnSearch[i]).attr("path");
      let search = $(this).val().toLowerCase();
      let match = /^[a-z0-9ñÑáéíóú ]*$/;

      if (match.test(search)) {
        let searchTest = search.replace(/[ ]/g, "_");
        searchTest = searchTest.replace(/[ñ]/g, "n");
        searchTest = searchTest.replace(/[á]/g, "a");
        searchTest = searchTest.replace(/[é]/g, "e");
        searchTest = searchTest.replace(/[í]/g, "i");
        searchTest = searchTest.replace(/[ó]/g, "o");
        searchTest = searchTest.replace(/[ú]/g, "u");

        window.location = path + searchTest;
      } else {
        $(this).val("");
      }
    }
  });
}

/* funcion para cambiar la cantidad del carrito */
function changeQualyty(quantity, move, stock) {
  let number = 1;
  if (Number(quantity) > stock - 1) {
    quantity = stock - 1;
  }
  if (move == "up") {
    number = Number(quantity) + 1;
  }
  if (move == "down" && Number(quantity) > 1) {
    number = Number(quantity) - 1;
  }

  $(".quantity input").val(number);
}

/* funcion para validar un formiulario */
function validatejs(e, tipo) {
  if (tipo == "text") {
    let pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/;
    if (!pattern.test(e.target.value)) {
      $(e.target).parent().addClass("was-validated");
      $(e.target)
        .parent()
        .children(".invalid-feedback")
        .html("No uses numeros ni caracteres especiales");
      return;
    }
  } else if (tipo == "email") {
    let pattern = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
    if (!pattern.test(e.target.value)) {
      $(e.target).parent().addClass("was-validated");
      $(e.target)
        .parent()
        .children(".invalid-feedback")
        .html("Solo se acepta un formato email");
      return;
    }
  } else if (tipo == "pass") {
    let pattern = /^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/;
    if (!pattern.test(e.target.value)) {
      $(e.target).parent().addClass("was-validated");
      $(e.target)
        .parent()
        .children(".invalid-feedback")
        .html(
          "No se admiten espacios ni tampoco algunos caracteres especiales"
        );
      e.target.value = "";
      return;
    }
  } else if (tipo == "image") {
    let image = e.target.files[0];
    if (image["type"] !== "image/jpeg" && image["type"] !== "image/png") {
      switAlert("error", "La imagen tiene que ser PNG  JPEG", null, null);
      return;
    } else if (image["size"] > 2000000) {
      switAlert("error", "La imagen tiene que ser menor a 2MB", null, null);
      return;
    } else {
      var data = new FileReader();
      data.readAsDataURL(image);

      $(data).on("load", function (event) {
        let path = event.target.result;
        $(".changePhoto").attr("src", path);
      });
    }
  }
}

/* funcion para validar un formiulario */
function emailRepeat(e) {
  let settings = {
    url:
      $("#urlApi").val() +
      "users?equalTo=" +
      e.target.value +
      "&linkTo=email_user&select=email_user",
    metod: "GET",
    timeaot: 0,
  };

  $.ajax(settings).done(function (response) {
    if (response.status == 200) {
      $(e.target).parent().addClass("was-validated");
      $(e.target)
        .parent()
        .children(".invalid-feedback")
        .html("Este email ya esta registrado");
      e.target.value = "";
      return;
    }
  });

  validatejs(e, "email");
}

// funcion para agregar producto a la list de deseos
function addWishList(urlProducto, urlApi) {
  // valdar que es token exista

  if (localStorage.getItem("token_user") != null) {
    // validar que el token sea el mismo que en la bd
    let token = localStorage.getItem("token_user");
    let settings = {
      url:
        urlApi + "users?equalTo=" + token + "&linkTo=token_user&select=id_user,wishlist_user",
      method: "GET",
      timeaot: 0,
    };

    //   respuesta incorrecta
    $.ajax(settings).error(function (response) {
      if (response.responseJSON.status == 404) {
        switAlert("error", "Ocurrio un error... por favor vuelve a logearte", null, null, 3000);
        return;
      }
    });

    // respuesta correcta
    $.ajax(settings).done(function (response) {
      if (response.status == 200) {
        let id = response.result[0].id_user;
        let wishlist = JSON.parse(response.result[0].wishlist_user);
        let noRepeat = 0;
        // preguntar si hay articulos en la lista de deseos 
        if (wishlist != null && wishlist.length > 0) {
          wishlist.forEach(list => {
            if (list == urlProducto) {
              noRepeat--;
            } else {
              noRepeat++;
            }
          });


          // preguntamos si ya esta en la lista de deseos
          if (wishlist.length != noRepeat) {
            switAlert("error", "El producto ya se agrego a tu lista de deseos", null, null, 2000);
          } else {

            wishlist.push(urlProducto);
            // Cuando no exista la lista de deseos inicialmente
            let settings = {
              "url": urlApi + "users?id=" + id + "&nameId=id_user&token=" + token + "&select=id_user",
              "method": "PUT",
              "timeaot": 0,
              "headers": {
                "Content-Type": "application/x-www-form-urlencoded",
              },
              "data": {
                "wishlist_user": JSON.stringify(wishlist),
              },
            };

            $.ajax(settings).done(function (response) {
              if (response.status == 200) {

                let totalWishlist = Number($(".totalWishList").html());
                $(".totalWishList").html(totalWishlist + 1);
                $(`.${urlProducto}`).removeClass("invisibleCorazon");
                $(`#visibl-cor`).remove();
                switAlert("success", "El producto se añadio a la lista de deseos", null, null, 1500);
              }
            });
          }
        } else {

          // Cuando no exista la lista de deseos inicialmente
          let settings = {
            "url": urlApi + "users?id=" + id + "&nameId=id_user&token=" + token + "&select=id_user",
            "method": "PUT",
            "timeaot": 0,
            "headers": {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            "data": {
              "wishlist_user": '["' + urlProducto + '"]',
            },
          };

          $.ajax(settings).done(function (response) {
            if (response.status == 200) {

              let totalWishlist = Number($(".totalWishList").html());
              $(".totalWishList").html(totalWishlist + 1);
              $(`.${urlProducto}`).removeClass("invisibleCorazon");
              switAlert("success", "El producto se añadio a la lista de deseos", null, null, 1500);
            }
          });
        }
      }
    });
  } else {
    switAlert("error", "Para agregar a la lista de deseos debes estar logeado", null, null, 3000);
  }
}

// funcion para eliminar elementos a la lista de deseos
function removeWishlist(urlProduct, urlApi){
  switAlert("confirm", "Esta seguro de eliminar de la lista de deseos?", null, null, null).then(resp=>{
    
    if(resp==true){
      // revisar que el token coincida con la bd
      let token = localStorage.getItem("token_user");
    let settings = {
      url:
        urlApi + "users?equalTo=" + token + "&linkTo=token_user&select=id_user,wishlist_user",
      method: "GET",
      timeaot: 0,
    };
    $.ajax(settings).done(function (response) {
      if (response.status == 200) {
        let id = response.result[0].id_user;
        let wishlist = JSON.parse(response.result[0].wishlist_user);
        wishlist.forEach((list, index) => {
          if(list== urlProduct){
            wishlist.splice(index,1);
            $(`.${urlProduct}`).remove();
          }
        });
        
         // Cuando no se quite de la lista 
         let settings = {
          "url": urlApi + "users?id=" + id + "&nameId=id_user&token=" + token,
          "method": "PUT",
          "timeaot": 0,
          "headers": {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          "data": {
            "wishlist_user": JSON.stringify(wishlist),
          },
        };

        $.ajax(settings).done(function (response) {
          if (response.status == 200) {

            let totalWishlist = Number($(".totalWishList").html());
            $(".totalWishList").html(totalWishlist - 1);

            switAlert("success", "El producto se elimino de la lista de deseos", null, null, 1500);
            
          }
        });

      }
    })
    }
  });

}