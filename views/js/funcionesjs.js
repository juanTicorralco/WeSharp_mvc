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
function changeQualyty(quantity, move, stock, index) {
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

  $("#quant"+index).val(number);
  $("[quantitySC]").attr("quantitySC", number);
  totalp(index);
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
  } 
  if (tipo == "email") {
    let pattern = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
    if (!pattern.test(e.target.value)) {
      $(e.target).parent().addClass("was-validated");
      $(e.target)
        .parent()
        .children(".invalid-feedback")
        .html("Solo se acepta un formato email");
      return;
    }
  } 
  if (tipo == "pass") {
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
  } 
  if (tipo == "image") {
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
  if(tipo=="phone"){
    let  pattern = /^[-\\(\\)\\0-9 ]{1,}$/; 
    if (!pattern.test(e.target.value)) {
      $(e.target).parent().addClass("was-validated");
        $(e.target)
          .parent()
          .children(".invalid-feedback")
          .html("Solo se aceptan numeros");
      return;
    }
  }
  if(tipo=="parrafo"){
    let  pattern = /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/; 
    if (!pattern.test(e.target.value)) {
      $(e.target).parent().addClass("was-validated");
        $(e.target)
          .parent()
          .children(".invalid-feedback")
          .html("Algun caracter que estas usando no es valido");
      return;
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

// AGREGAR DOS PROductos a la lista de deseos 

function addWishListDos(urlProducto, urlApi, urlProductoDos) {
  addWishList(urlProducto, urlApi);
  setTimeout(() => {
    addWishList(urlProductoDos, urlApi);
  }, 1000);
}

// funcion para eliminar elementos a la lista de deseos
function removeWishlist(urlProduct, urlApi) {
  switAlert("confirm", "Esta seguro de eliminar de la lista de deseos?", null, null, null).then(resp => {

    if (resp == true) {
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
            if (list == urlProduct) {
              wishlist.splice(index, 1);
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

// funcion que remueve de bag
function removeBagSC(urlProduct, urlPagina){
  switAlert("confirm", "Esta seguro de eliminar del carrito de compras?", urlPagina, null, null).then(resp => {
     // preguntamos is la cookie ya existe
     let myCookie = document.cookie;
     let listCookie = myCookie.split(";");
     let count = 0;

     for (let i in listCookie) {
       var list = listCookie[i].search("listSC");
       // si list es mayor a -1 es por qu se ncontro la cooki
       if (list > -1) {
         count--;
         var arrayList = JSON.parse(listCookie[i].split("=")[1]);
       } else {
         count++;
       }
     }

     // trabajamos sobre la cookie que ya existe
     if (count != listCookie.length) {
       if (arrayList != undefined) {
          arrayList.forEach((list, index)=>{
            if(list.product == urlProduct){
              arrayList.splice(index,1);
            }
          });
          setCookie("listSC", JSON.stringify(arrayList), 1);
          switAlert("success", "El producto se elimino de el carrito", urlPagina, null, 1500);
        }
      }
  });
}

//Agredamos articulos al carrito de compras
function addBagCard(urlProduct, category, image, name, price, path, urlApi, tag) {
  // Traer informacion del producto 
  let select = "stock_product,specifications_product,shipping_product,offer_product";

  let settings = {
    url:
      urlApi + "products?linkTo=url_product&equalTo=" + urlProduct + "&select=" + select,
    method: "GET",
    timeaot: 0,
  };

  $.ajax(settings).done(function (response) {
    if (response.status == 200) {

      if (response.result[0].stock_product == 0) {
        switAlert("error", "Por el momento no tenemos en stock este producto", null, null, 3000);
        return;
      }

      // Creamos la estructura detalles, vaidamos existencia de detalles
      if(tag.getAttribute("detailSC") != ""){
        var detalleProduct = tag.getAttribute("detailSC");  
      }else{
        var detalleProduct = "";
      }

      // validamos la existecia de cantidad 
      if(tag.getAttribute("quantitySC") != ""){
        var quantity = tag.getAttribute("quantitySC");  
      }else{
        var quantity = 1;
      }

      //preguntamos si detalles viene bacio
      if(detalleProduct === ""){
        if (response.result[0].specifications_product != "" ) {
          if(response.result[0].specifications_product != null){
          let DetProd = JSON.parse(response.result[0].specifications_product);
          detalleProduct = '[{';
          for (const i in DetProd) {
            let propiety = Object.keys(DetProd[i]).toString();
            detalleProduct += '"' + propiety + '":"' + DetProd[i][propiety][0] + '",';
          }
          detalleProduct = detalleProduct.slice(0, -1);
          detalleProduct += '}]';
        }
      }
      }else{
        let newDetail= JSON.parse(detalleProduct);

        if (response.result[0].specifications_product != null) {
          let DetProd = JSON.parse(response.result[0].specifications_product);
          detalleProduct = '[{';
          for (const i in DetProd) {
            let propiety = Object.keys(DetProd[i]).toString();
            detalleProduct += '"' + propiety + '":"' + DetProd[i][propiety][0] + '",';
          }
          detalleProduct = detalleProduct.slice(0, -1);
          detalleProduct += '}]';
        }

        for(const i in JSON.parse(detalleProduct)[0]){
          if(newDetail[0][i] == undefined){
            Object.assign(newDetail[0], {[i]: JSON.parse(detalleProduct)[0][i]})
          }
        }

        detalleProduct= JSON.stringify(newDetail);
      }

      // preguntamos is la cookie ya existe
      let myCookie = document.cookie;
      let listCookie = myCookie.split(";");
      let count = 0;

      for (let i in listCookie) {
        var list = listCookie[i].search("listSC");
        // si list es mayor a -1 es por qu se ncontro la cooki
        if (list > -1) {
          count--;
          var arrayList = JSON.parse(listCookie[i].split("=")[1]);
        } else {
          count++;
        }
      }

      // trabajamos sobre la cookie que ya existe
      if (count != listCookie.length) {
        if (arrayList != undefined) {
          // Preguntar si el producto existe
          var count2 = 0;
          var index = null;
          for (let i in arrayList) {
            if (arrayList[i].product == urlProduct) {
              count2--;
              index = i;
            } else {
              count2++;
            }
          }
          if (count2 == arrayList.length) {
            arrayList.push({
              "product": urlProduct,
              "details": detalleProduct,
              "quantity": parseInt(quantity)
            });
          } else {
            arrayList[index].quantity += parseInt( quantity);
          }

          // creamos una cookie
          setCookie("listSC", JSON.stringify(arrayList), 1);
          switAlert("success", "El producto se agrego a la lista de deseos", null, null, 1500);

          // precio
          function priceFun(offer, price) {
            if (offer != null) {
              if (offer[0] == "Discount") {
                let offerPrice = price - (price * offer[1]) / 100;
                offerPrice = offerPrice.toFixed(2)
                return offerPrice;
              } else if (offer[0] == "Fixed") {
                let offerPrice = offer[1];
                return offerPrice;
              }
            } else {
              return price;
            }
          }

          // lista
          function listFun(lisArray) {
            let lista2 = JSON.parse(lisArray[0]["details"]);
            // html`<p class='mb-0'> <strong> Detalles por defecto:</strong></p>`;
            let newlist = [];
            for (let prop in lista2[0]) {
              newlist += prop + " : " + lista2[0][prop] + `<br>`;
            }

            return newlist;
          }

          function priceTotalFun(varer, varer2, varer3) {

            
            if (varer3 == null) {
              let priceSum;

              priceSum = varer + (varer2);
              priceSum = priceSum.toFixed(2)
              return priceSum;
            }else {
              let priceSum;

              priceSum = (varer * varer3);
              priceSum = priceSum.toFixed(2)
              return priceSum;
            }

          }

          function resetFinishEnv(varer, varer2, varer3, varer4){
           if(varer==0){
            let priceSum;

            priceSum = (varer3 * varer4);
            priceSum = priceSum.toFixed(2)
            return priceSum;
          }else{
            let priceSum;

            priceSum = varer2 + (varer4);
            priceSum = priceSum.toFixed(2)
            return priceSum;
          }

          }

          function resetenvio(var1, var2) {
            if (var1 > 2) {
              return 0;
            } else {

              return var2* 1.5;
            }
          }

          if (arrayList[index] == undefined) {
    
            $("#bagTok").after(`
              <div class="ps-product--cart-mobile bg-white p-3">
                <div class="ps-product__thumbnail">
                    <a class="m-0" href="${path + urlProduct}">
                    <img src="img/products/${category}/${image}" alt="${name}">
                    </a>
                </div>
  
                <div class="ps-product__content">
                <a class="ps-product__remove text-danger btn" onclick="removeBagSC('${urlProduct}', '${location.reload()}')">
                <i class="fas fa-trash-alt"></i>
                </a>
                    <a class="m-0" href="${path + urlProduct}">${name}</a>
                    <p class="m-0"><strong></strong> WeSharp</p>
                    <div class="small text-secondary">
                    <p class='mb-0'> <strong> Detalles por defecto:</strong></p>
                    <div class="mb-0">${listFun(arrayList)}</div>                         
                    </div>
                    <p class="m-0"><strong>Envio: </strong> $<span class="envibagcl">${JSON.parse(response.result[0].shipping_product) * 1.5}</span></p>
                    <small> <spam class="${urlProduct}">1</spam> x $
                    ${priceFun(JSON.parse(response.result[0].offer_product), price)}
                    </small>
                </div>
              </div>`
            );

            let var1 = parseFloat(priceFun(JSON.parse(response.result[0].offer_product), price));
            let var2 = parseInt(JSON.parse(response.result[0].shipping_product));
            let var3 = Number($(`.${urlProduct}`).html());
            let var5= arrayList.length - 1 ;

            let envios = JSON.parse(response.result[0].shipping_product);
            let var4 = resetenvio(var5, envios);

            $(".envibagcl").html(var4);

            let tobagtal = Number($('.tobagtal').html());
            $(".tobagtal").html(tobagtal + parseFloat(priceTotalFun(var1, var2, null)));

            let totalbager = Number($('.totalWishBag').html());
            $('.totalWishBag').html(totalbager + 1);
          } else {
           
            let var1 = parseFloat(priceFun(JSON.parse(response.result[0].offer_product), price));
            let var3 = Number($(`.${urlProduct}`).html());
            $(`.${urlProduct}`).html(var3 + 1);
            let envios = JSON.parse(response.result[0].shipping_product);
            let var4 = resetenvio(var3, envios);
            let tobagtal = Number($('.tobagtal').html());
    
            var3 = Number($(`.${urlProduct}`).html());
            $(".envibagcl").html(var4);
            var4 = Number($(".envibagcl").html());

            // parseFloat(priceTotalFun(resetenvio(var3, envios), var2, var3))
            $(".tobagtal").html(resetFinishEnv(var4, tobagtal, var3, var1));           
          }
        }
      } else {
        // creamos una cookie
        var arrayList = [];
        arrayList.push({
          "product": urlProduct,
          "details": detalleProduct,
          "quantity": 1
        });

        setCookie("listSC", JSON.stringify(arrayList), 1);
        switAlert("success", "El producto se agrego a la lista de deseos", null, null, 1500);

        // precio
        function priceFun(offer, price) {
          if (offer != null) {
            if (offer[0] == "Discount") {
              let offerPrice = price - (price * offer[1]) / 100;
              offerPrice = offerPrice.toFixed(2)
              return offerPrice;
            } else if (offer[0] == "Fixed") {
              let offerPrice = offer[1];
              return offerPrice;
            }
          } else {
            return price;
          }
        }

        // lista
        function listFun(lisArray) {
          let lista2 = JSON.parse(lisArray[0]["details"]);
          // html`<p class='mb-0'> <strong> Detalles por defecto:</strong></p>`;
          let newlist = [];
          for (let prop in lista2[0]) {
            newlist += prop + " : " + lista2[0][prop] + `<br>`;
          }

          return newlist;
        }

        function priceTotalFun(varer, varer2) {

          let priceSum;

          return priceSum = varer + (varer2 * 1.5);

        }

        $("#bagTok").after(`
        <div class="ps-product--cart-mobile bg-white p-3">
          <div class="ps-product__thumbnail">
              <a class="m-0" href="${path + urlProduct}">
              <img src="img/products/${category}/${image}" alt="${name}">
              </a>
          </div>

          <div class="ps-product__content">
          <a class="ps-product__remove text-danger btn" onclick="removeBagSC('${urlProduct}', '${location.reload()}')">
          <i class="fas fa-trash-alt"></i>
          </a>
              <a class="m-0" href="${path + urlProduct}">${name}</a>
              <p class="m-0"><strong></strong> WeSharp</p>
              <div class="small text-secondary">
              <p class='mb-0'> <strong> Detalles por defecto:</strong></p>
              <div class="mb-0">${listFun(arrayList)}</div>                         
              </div>
              <p class="m-0"><strong>Envio: </strong> $ <span class="envibagcl">${JSON.parse(response.result[0].shipping_product) * 1.5}</span></p>
              <small> <spam class="${urlProduct}">${1}</spam> x $
               ${priceFun(JSON.parse(response.result[0].offer_product), price)}
              </small>
          </div>
        </div>`
        );

        let var1 = parseFloat(priceFun(JSON.parse(response.result[0].offer_product), price));
        let var2 = parseInt(JSON.parse(response.result[0].shipping_product));

        $("#viewCardBag").html(` 
        <h3>Total: <strong>$ <span class="tobagtal">${priceTotalFun(var1, var2)}</span </strong></h3>
        <figure>
            <a class="ps-btn" href="shopping-cart.html">View Cart</a>
            <a class="ps-btn" href="checkout.html">Checkout</a>
        </figure>`);
        
        let totalbager = Number($('.totalWishBag').html());
        $('.totalWishBag').html(totalbager + 1);
      }
    }
  });
}

// seleccionar detalles al producto
$(document).on("click", ".details", function(){
  let details = $(this).attr("datailType");
  let value = $(this).attr("detailValue");
  let detailsLenth= $(".details."+ details);

  for(let i=0; i<detailsLenth.length; i++){
    $(detailsLenth[i]).css({"border":"1px solid #bbb"});
  }
  $(this).css({"border":"5px solid #80F"});

  // preguntar si se agregaron detalles
  if($("[detailSC]").attr("detailSC") != ""){
    
    let detailsSC = JSON.parse($("[detailSC]").attr("detailSC"));
    for(const i in detailsSC){
      detailsSC[i][details]= value;
      $("[detailSC]").attr("detailSC", JSON.stringify(detailsSC));
    }

  }else{
    $("[detailSC]").attr("detailSC", '[{\"'+details+'\":\"'+value+'\"}]')
  }
})

// AGREGAR DOS PROductos al carrito
function addBagCardDos(urlProduct, category, image, name, price, path, urlApi, tag, urlProductoDos) {
  addBagCard(urlProduct, category, image, name, price, path, urlApi, tag);
  setTimeout(() => {
    addBagCard(urlProductoDos, category, image, name, price, path, urlApi, tag);
  }, 1000);
}

// definir el subtotal y total del carrito de compras
let price = $(".price span");
let quantity= $(".quantity input");
let envio= $(".shopingcantidad span");
let subtotal= $(".subtotal");
let totalPrice= $(".totalPrice span");
let listtSC= $(".listtSC");

function totalp(index){
  let totalPri= 0;
  let arrayListSC= [];

  if(price.length>0){
    price.each(function(i){

    
      if(index != null){

        if($(quantity[index]).val() >= 3 || i >= 3 || index >= 3 || ($(quantity[index]).val() >= 3 && index >3) ){
        $(envio[index]).html(0);
        }else{
          $(envio[index]).html((5 * 1.5 )/ $(quantity[index]).val());
        }
          
      }

      let subt= parseFloat(($(price[i]).html()*$(quantity[i]).val()) + parseFloat( $(envio[i]).html()));
    
      totalPri += subt;
      $(subtotal[i]).html(`$${subt.toFixed(2)}`);

      // coocar la cookie 
      arrayListSC.push({
        "product": $(listtSC[i]).attr("url"),
        "details": $(listtSC[i]).attr("details"),
        "quantity": parseInt($(quantity[i]).val()) 
      });
    });
    $(totalPrice).html(totalPri.toFixed(2));

    // actualizar cookie
    setCookie("listSC", JSON.stringify(arrayListSC), 1);
  }
}

totalp(null);

function changeContry(event){
  $(".dialCode").html(event.target.value.split("_")[1]);
}

let metodpay= $('[name="payment-method"]').val()
function changemetodpay(event){
  metodpay = event.target.value;
}
// variable del total 
let total = $(".totalOrder").attr("total");

function checkout(){
  let forms = document.getElementsByClassName('needs-validation');
  var validation = Array.prototype.filter.call(forms, function(form) {
    if(form.checkValidity()){
      return [""];
    }
  })
  if(validation.length > 0){
    // pagar con paypal
    if(metodpay == "paypal"){
      switAlert("html", '<div id="paypal-button-container"></div>', null, null,null);
      paypal.Buttons({
         createOrder: function(data, actions){
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: total
              }
            }]
          });
        },

        onApprove: function(data, actions){
          return actions.order.capture().then(function(details){
            if(details.status == 'COMPLETED'){
               newOrden("paypal","pending", details.id,total);
            }
            return false;
          })
        },

        onCancel: function(data){
          switAlert("error", "La transaccion a sido cancelada", null,null,null );
          return false;
        },

        onError: function(err){
          switAlert("error", "Ocurrio un error al hacer la transaccion", null,null,null );
          return false;
        }
    }).render('#paypal-button-container');

    }
    // pagar con payu
    if(metodpay== "payu"){

    }
    // pagar con mercado pago
    if(metodpay=="mercado-pago"){

    }
    return false;
  }else{
    return false;
  }
}

function formatFecha(fecha){
  let day = fecha.getDate();
  let Mes=fecha.getMonth()+1;
  let año=fecha.getFullYear();

  return año + '-' + Mes + '-' + day;
}

// crear orden
function newOrden(metodo,status,id,totals){
  // id tienda
  let idStoreClass= $(".idStore");
  let idStore =[];

  idStoreClass.each(i=>{
    idStore.push($(idStoreClass[i]).val());
  });

  // url store
  let urlStoreClass= $(".urlStore");
  let urlStore =[];

  urlStoreClass.each(i=>{
    urlStore.push($(urlStoreClass[i]).val());
  });

  // id usuario
  let idUser = $("#idUser").val();

  // id producto
  let idProductClass= $(".idProduct");
  let idProduct =[];

  idProductClass.each(i=>{
    idProduct.push($(idProductClass[i]).val());
  });

  let stockProductClass= $(".stockProduct");
  let stockProduct =[];

  stockProductClass.each(i=>{
    stockProduct.push($(stockProductClass[i]).val());
  });

  let salesProductClass= $(".salesProduct");
  let salesProduct =[];

  salesProductClass.each(i=>{
    salesProduct.push($(salesProductClass[i]).val());
  });

  // detalles
  let detailOrderClass= $(".detailsOrder");
  let detailsOrder =[];

  detailOrderClass.each(i=>{
    detailsOrder.push($(detailOrderClass[i]).html().replace(/\s+/gi,''));
  });

  // cantidad de productos
  let quantityOrderClass= $(".quantityOrder");
  let quantityOrder =[];

  quantityOrderClass.each(i=>{
    quantityOrder.push($(quantityOrderClass[i]).html());
  });

  // precio de cada producto 
  let priceProductClass= $(".priceProd");
  let priceProduct =[];

  priceProductClass.each(i=>{
    priceProduct.push($(priceProductClass[i]).html().replace(/\s+/gi,''));
  });

  // Inforacion del usuario
  let emailOrder = $("#emailOrder").val();
  let countryOrder = $("#countryOrder").val().split("_")[0];
  let cityOrder = $("#cityOrder").val();
  let phoneOrder = $("#countryOrder").val().split("_")[1]+"_"+ $("#phoneOrder").val();
  let addresOrder = $("#addresOrder").val();
  let infoOrder = $("#infoOrder").val();

  // tiempo de entrega
  let delytimeClass= $(".deliverytime");
  let deliveryTime =[];

  delytimeClass.each(i=>{
    deliveryTime.push($(delytimeClass[i]).val());
  });

  // preguntamos is la cookie ya existe
  let myCookie = document.cookie;
  let listCookie = myCookie.split(";");
  var arrayCoupon = "";

  for (const i in listCookie) {
    let list = listCookie[i].search("cuponMP");
    // si list es mayor a -1 es por qu se ncontro la cooki
    if (list > -1) {
      arrayCoupon = listCookie[i].split("=")[1]
      arrayCoupon = JSON.parse(decodeURIComponent(arrayCoupon));
    } 
  }

  // preguntar si el usuario quiere guardar su direccion
  let saveAdres= $("#create-account")[0].checked;
  if(saveAdres){
  
    let settings = {
      "url": $("#urlApi").val()+"users?id="+idUser+"&nameId=id_user&token=" + localStorage.getItem("token_user"),
      "method": "PUT",
      "timeaot": 0,
      "headers": {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      "data": {
        "country_user": countryOrder,
        "city_user": cityOrder,
        "phone_user": phoneOrder,
        "address_user": addresOrder
      },
    };

    $.ajax(settings).done(function (response) {});

  }

  idProduct.forEach((value,i) => {

    let moment= Math.ceil(Number(deliveryTime[i]/2));
    let sendDate = new Date();
    sendDate.setDate(sendDate.getDate()+moment);

    let delyvereDate= new Date();
    delyvereDate.setDate(delyvereDate.getDate()+Number(deliveryTime[i]));

    let procesOrder=[
      {"stage":"reviewed",
      "status":"ok",
      "comment":"We have received your order, we start delivery process",
      "date":formatFecha(new Date())},

      {"stage":"sent",
      "status":"pending",
      "comment":"",
      "date":formatFecha(sendDate)},
      
      {"stage":"delivered",
      "status":"pending",
      "comment":"",
      "date":formatFecha(delyvereDate)}
    ];

    // guardar orden
    let settings = {
      "url": $("#urlApi").val() + "orders?token=" + localStorage.getItem("token_user"),
      "method": "POST",
      "timeaot": 0,
      "headers": {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      "data": {
        "id_store_order": idStore[i],
        "id_user_order": idUser,
        "id_product_order": value,
        "details_order": JSON.stringify(detailsOrder),
        "quantity_order": quantityOrder[i],
        "price_order": priceProduct[i],
        "email_order": emailOrder,
        "country_order": countryOrder,
        "city_order": cityOrder,
        "phone_order": phoneOrder,
        "address_order": addresOrder,
        "notes_order": infoOrder,
        "process_order": JSON.stringify(procesOrder),
        "status_order": status,
        "date_created_order": formatFecha(new Date())  
      },
    };



    $.ajax(settings).done(function (response) {
      if (response.status == 200) {
        // Crear comision
        let unitPrice = 0;
        let commissionPrice = 0;
        let count = 0;

        if(arrayCoupon.length > 0){
          arrayCoupon.forEach(value2=> {
            if(value2 == urlStore[i]){
              count--;
            }else{
              count++;
            }
          });
        }
        if(arrayCoupon.length == count){
          // comision organica
          unitPrice= (Number(priceProduct[i])*0.75).toFixed(2);
          commissionPrice=(Number(priceProduct[i])*0.25).toFixed(2);
        }else{
          // comision por cupon
          unitPrice= (Number(priceProduct[i])*0.95).toFixed(2);
          commissionPrice=(Number(priceProduct[i])*0.05).toFixed(2);
        }
        
        // crear venta
        let settings = {
          "url": $("#urlApi").val() + "sales?token=" + localStorage.getItem("token_user"),
          "method": "POST",
          "timeaot": 0,
          "headers": {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          "data": {
            "id_order_sale": idStore[i],
            "unit_price_sale": unitPrice,
            "commission_sale": commissionPrice,
            "payment_method_sale": metodo,
            "id_payment_sale": id,
            "status_sale": status,
            "date_created_sale": formatFecha(new Date())  
          },
        };

        $.ajax(settings).done(function (response) {
          // contruir venta y stock
          let settings2 = {
            "url": $("#urlApi").val()+"products?id="+value+"&nameId=id_product&token=" + localStorage.getItem("token_user"),
            "method": "PUT",
            "timeaot": 0,
            "headers": {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            "data": {
              "stock_product": Number(stockProduct[i])-Number(quantityOrder[i]),
              "sales_product": Number(salesProduct[i])+Number(quantityOrder[i])
            },
          };

          $.ajax(settings2).done(function (response) {
            console.log(response);
          });
        })
        // switAlert("success", "El producto se añadio a la lista de deseos", null, null, 1500);

      }
    });
  });
}

 