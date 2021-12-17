<!--=====================================
Breadcrumb
======================================-->

<div class="ps-breadcrumb">

    <div class="container">

        <ul class="breadcrumb">

            <li><a href="/">Home</a></li>

            <li>Mi Cuenta</li>

        </ul>

    </div>

</div>

<?php
if (isset($urlParams[1])) {
    if ($urlParams[1] == "enrollment" || $urlParams[1] == "login" || $urlParams[1]=="wishAcount") {
        include $urlParams[1] . "/" . $urlParams[1] . ".php";
        // if (isset($urlParams[2])) {
        //     if ($urlParams[2] == "facebook") {
        //         $url = $path . "acount&enrollment&facebook";
        //         $responseLoGFace = ControllerUser::loginFacebook($url);
        //     }
        // }
    } else {
        echo '<script> 
                window.location= "' . $path . '";
              </script>';
    }
} else {
    echo '<script> 
    window.location= "' . $path . '";
</script>';
}
?>