<?php
class ControllerUser
{
    /* registro de usuarios */
    public function register()
    {
        if (isset($_POST["createEmail"])) {
            /* validar los campos */
            if (
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["createNombre"]) &&
                preg_match('/^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["createEmail"]) &&
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["createApellido"]) &&
                preg_match('/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["createPassword"])
            ) {

                $displayName = TemplateController::capitalize( strtolower( $_POST["createNombre"])) . " " . TemplateController::capitalize( strtolower( $_POST["createApellido"]));
                $user = TemplateController::capitalize( strtolower(explode("@", $_POST["createEmail"])[0]));
                $email = strtolower($_POST["createEmail"]);

                $url = CurlController::api() . "users?register=true";
                $method = "POST";
                $fields = array(
                    "rol_user" => "default",
                    "displayname_user" => $displayName,
                    "username_user" => $user,
                    "email_user" => $email,
                    "password_user" => $_POST["createPassword"],
                    "method_user" => "direct",
                    "date_created_user" => date("Y-m-d")
                );
                $header = array(
                    "Content-Type" => "application/x-www-form-urlencoded"
                );

                
                $response = CurlController::request($url, $method, $fields, $header);
                echo '<pre>';
                print_r($response);
                echo '</pre>';
                return;
            } else {
                echo '<div class="alert alert-danger alert-dismissible">Error en la sintaxis de los campos</div>';
            }
        }
    }

     /* login de usuarios */
     public function login()
     {
        if (isset($_POST["logEmail"])) {
            /* validar los campos */
            if (preg_match('/^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["logEmail"]) &&
                preg_match('/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["logPassword"])
            ) {
                $url = CurlController::api() . "users?login=true";
                $method = "POST";
                $fields = array(
                    "email_user" =>  $_POST["logEmail"],
                    "password_user" => $_POST["logPassword"]
                );
                $header = array(
                    "Content-Type" => "application/x-www-form-urlencoded"
                );

                
                $response = CurlController::request($url, $method, $fields, $header);
                if($response->status==200){

                }else{
                    echo '<div class="alert alert-danger alert-dismissible">El email o la contraseña no son correctas</div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible">Error en la sintaxis de los campos</div>';
            }
        }
     }

}
