/* funcion para formatear las alertas */
function formatearAlertas() {
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
}

function notiAlert(type, text) {
  notie.alert({
    type: type,
    text: text,
    time: 10,
  });
}

function switAlert(type, text, url, icon) {
  switch (type) {
    // cuando ocurre un error
    case "error":
      if (url == null && icon == null) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: text,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: text,
        }).then((result) => {
          if (result.value) {
            window.open(url, "_top");
          }
        });
      }
      break;

    // cuando ocurre un successfull
    case "success":
      if (url == null && icon == null) {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: text,
        });
      } else {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: text,
        }).then((result) => {
          if (result.value) {
            window.open(url, "_top");
          }
        });
      }
      break;

    case "loading":
      Swal.fire({
        allowOutsideClick: false,
        title: text,
        width: 600,
        padding: "3em",
        color: "#716add",
        background: "#fff url(img/users/default/fondo.jpg)",
        backdrop: `
            rgba(0,0,123,0.4)
            url("img/users/default/we4.gif")
            center top
            no-repeat
        `,
      });
      Swal.showLoading();
      break;

    case "close":
        Swal.close();
    break;
  }
}
