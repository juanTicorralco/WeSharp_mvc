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
                preg_match('/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/', $_POST["createEmail"]) &&
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["createApellido"]) &&
                preg_match('/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["createPassword"])
            ) {

                $displayName = TemplateController::capitalize(strtolower($_POST["createNombre"])) . " " . TemplateController::capitalize(strtolower($_POST["createApellido"]));
                $user = TemplateController::capitalize(strtolower(explode("@", $_POST["createEmail"])[0]));
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

                if ($response->status == 200) {

                    // registrar email
                    $name = $displayName;
                    $subject = "Registro WeSharp";
                    $message = "Confirma tu email para crear una cuenta en WeSharp";
                    $url = TemplateController::path() . "acount&login&" . base64_encode($email);
                    $post = "Confirmar Email";
                    $sendEmail = TemplateController::sendEmail($name, $subject, $email, $message, $url, $post);

                    if ($sendEmail == "ok") {
                        echo '<div class="alert alert-success">Tu usuario se registro correctamente, confirma tu cuenta en email (aveces esta en spam)</div>
                        <script>
                        formatearAlertas()
                    </script>';
                    } else {
                        echo '<div class="alert alert-danger">' . $sendEmail . '</div>
                        <script>
                        formatearAlertas()
                    </script>';
                    }
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible">Error en la sintaxis de los campos</div>
                <script>
                formatearAlertas()
            </script>';
            }
        }
    }

    /* login de usuarios */
    public function login()
    {
        if (isset($_POST["logEmail"])) {
            /* validar los campos */
            if (
                preg_match('/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/', $_POST["logEmail"]) &&
                preg_match('/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["logPassword"])
            ) {
                echo '
                <script>
                switAlert("loading", "Accesando a WeSharp", "","");
                </script>
                ';
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
                if ($response->status == 200) {
                    if ($response->result[0]->verificated_user > 0) {
                        $_SESSION['user'] = $response->result[0];
                        echo '
                        <script> 
                        formatearAlertas();
                        localStorage.setItem("token_user", "' . $_SESSION["user"]->token_user . '");
                        window.location="' . TemplateController::path() . 'acount&wishAcount";
                        </script>
                        ';
                        
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible">El email no esta confirmado, por favor confirmalo</div>
                        <script>
                        formatearAlertas()
                        switAlert("close", "", "","");
                        </script>
                        ';
                    }
                } else {
                    echo '<div class="alert alert-danger alert-dismissible">El email o la contraseña no son correctas</div>
                    <script>
                    formatearAlertas()
                    switAlert("close", "", "","");
                </script>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible">Error en la sintaxis de los campos</div>
                <script>
                formatearAlertas()
                switAlert("close", "", "","");
            </script>';
            }
        }
    }

    /* login con facebook */
    // static public function loginFacebook($url){
    //     $fb = new \Facebook\Facebook([
    //         'app_id' => '1279275769213584',
    //         'app_secret' => 'fdf5eb9f167c65de79c3b6293216e999',
    //         'default_graph_version' => 'v2.10',
    //         //'default_access_token' => '{access-token}', // optional
    //       ]);

    //       /* creamos la redireccion hacia la API de facebook */
    //       $handler=$fb->getRedirectLoginHelper();

    //       /* solcitar datos relacionados al email */
    //       $data=["email"];

    //       /* activamos la url de facebook con los parametro: url de regreso y parametros que pedimos */
    //       $fullUrl= $handler->getLoginUrl($url, $data);

    //       /* redireccionamos la pagina de facebook  */
    //       echo '<script>
    //             window.location="'.$fullUrl.'";
    //       </script>';
    //               //  echo '<pre>'; print_r($fb); echo '</pre>';
    // }

    public function resetPassword()
    {
        if (isset($_POST["resetPassword"])) {
            /* validar los campos */
            if (
                preg_match('/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/', $_POST["resetPassword"])
            ) {
                $url = CurlController::api() . "users?linkTo=email_user&equalTo=" . $_POST["resetPassword"] . "&select=email_user,id_user,displayname_user,method_user";
                $method = "GET";
                $fields = array();
                $header = array();

                $user = CurlController::request($url, $method, $fields, $header);
                if ($user->status == 200) {
                    if ($user->result[0]->method_user == "direct") {
                        function genPassword($Length)
                        {
                            $password = "";
                            $chain = "123456789abcdefghijklmnopqrstuvwxyz";
                            $max = strlen($chain) - 1;

                            for ($i = 0; $i < $Length; $i++) {
                                $password .= substr($chain, mt_rand(0, $max), 1);
                            }
                            return $password;
                        }

                        $newPassword = genPassword(11);
                        $crypt = crypt($newPassword, '$2a$07$pdgtwzaldisoqrtrswqpxzasdte$');

                        $url = CurlController::api() . "users?id=" . $user->result[0]->id_user . "&nameId=id_user&token=no&except=password_user";
                        $method = "PUT";
                        $fields = "password_user=" . $crypt;
                        $header = array();

                        $respuesta = CurlController::request($url, $method, $fields, $header);
                        if ($respuesta->status == 200) {

                            // Email donde esta la nueva contraseña
                            $email = $_POST["resetPassword"];
                            $name = $user->result[0]->displayname_user;
                            $subject = "Nueva contraseña WeSharp";
                            $message = "Confirma tu nueva contraseña para ingresar a WeSharp... Tu nueva contraseña es: " . $newPassword;
                            $url = TemplateController::path() . "acount&login";
                            $post = "Confirmar Nueva Contraseña";
                            $sendEmail = TemplateController::sendEmail($name, $subject, $email, $message, $url, $post);

                            if ($sendEmail == "ok") {
                                echo '
                                    <script>
                                    formatearAlertas();
                                    notiAlert(1, "Tu nueva contraseña se envio correctamente, confirma en tu cuenta email (aveces esta en spam)");
                                </script>';
                            } else {
                                echo '
                                    <script>
                                    formatearAlertas();
                                    notiAlert(3, "' . $sendEmail . '");
                                </script>';
                            }
                        } else {
                            echo '
                            <script>
                            formatearAlertas();
                            notiAlert(3, "no se pudo resetear la contraseña");
                        </script>';
                        }
                    } else {
                        echo '
                            <script>
                            formatearAlertas();
                            notiAlert(3, "Te registraste por face o por gmail");
                        </script>';
                    }
                } else {
                    echo '
                        <script>
                        formatearAlertas();
                        notiAlert(3, "El email no esta registrado");
                    </script>';
                }
            } else {
                echo '
                        <script>
                        formatearAlertas();
                        notiAlert(3, "Error en la sintaxis de los campos");
                    </script>';
            }
        }
    }

    public function actualiarContraseña()
    {
        if (isset($_POST["newPassword"])) {
            /* validar los campos */
            if (
                preg_match('/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["newPassword"])
            ) {
                if ($_SESSION["user"]->method_user == "direct") {

                    $crypt = crypt($_POST["newPassword"], '$2a$07$pdgtwzaldisoqrtrswqpxzasdte$');

                    $url = CurlController::api() . "users?id=" . $_SESSION["user"]->id_user . "&nameId=id_user&token=" . $_SESSION["user"]->token_user;
                    $method = "PUT";
                    $fields = "password_user=" . $crypt;
                    $header = array();

                    $respuesta = CurlController::request($url, $method, $fields, $header);

                    if ($respuesta->status == 200) {
                        // Email donde esta la nueva contraseña
                        $email = $_SESSION["user"]->email_user;
                        $name = $_SESSION["user"]->displayname_user;
                        $subject = "Nueva contraseña WeSharp";
                        $message = "Acabas de cambiar tu contraseña... si es un error Por favor de notificar a WeSharp... ";
                        $url = TemplateController::path() . "acount&login";
                        $post = "Confirmar Nueva Contraseña";
                        $sendEmail = TemplateController::sendEmail($name, $subject, $email, $message, $url, $post);

                        if ($sendEmail == "ok") {
                            echo '
                                 <script>
                                 formatearAlertas();
                                 notiAlert(1, "Tu nueva contraseña se envio correctamente, confirma en tu cuenta email (aveces esta en spam)");
                             </script>';
                        } else {
                            echo '
                                 <script>
                                 formatearAlertas();
                                 notiAlert(3, "' . $sendEmail . '");
                             </script>';
                        }
                    } else {
                        if ($respuesta->status == 303) {
                            echo '<script>
                            formatearAlertas();
                            switAlert("error", "' . $respuesta->result . '", "' . TemplateController::path() . 'acount&logout","");
                            </script>';
                        } else {
                            echo '
                                 <script>
                                 formatearAlertas();
                                 notiAlert(3, "no se pudo cambiar tu contraseña");
                             </script>';
                        }
                    }
                } else {
                    echo '
                                 <script>
                                 formatearAlertas();
                                 notiAlert(3, "Te logeaste con metodo Facebook o google");
                             </script>';
                }
            } else {
                echo '
                <script>
                formatearAlertas();
                notiAlert(3, "El formato de la contraseña es incorrecto");
            </script>';
            }
        }
    }

    public function CambiarPhoto()
    {
        // validar la sintaxis de los campos 
        if (isset($_FILES['changePhoto']["tmp_name"]) && !empty($_FILES["changePhoto"]["tmp_name"])) {
            $image = $_FILES["changePhoto"];
            $folder = "img/users";
            $path = $_SESSION["user"]->id_user;
            $width = 200;
            $heigt = 200;
            $name = $_SESSION["user"]->username_user;

            $photo = TemplateController::AlmacenPhoto($image, $folder, $path, $width, $heigt, $name);

            if ($photo != "error") {
                // actualizar la foto
                $url = CurlController::api() . "users?id=" . $_SESSION["user"]->id_user . "&nameId=id_user&token=" . $_SESSION["user"]->token_user;
                $method = "PUT";
                $fields = "picture_user=" . $photo;
                $header = array();

                $respuesta = CurlController::request($url, $method, $fields, $header);
                if ($respuesta->status == 303) {
                    echo '<script>
                    formatearAlertas();
                    switAlert("error", "' . $respuesta->result . '", "' . TemplateController::path() . 'acount&logout","");
                    </script>';
                } else if ($respuesta->status == 200) {
                    $_SESSION["user"]->picture_user = $photo;
                    echo '<script>
                    formatearAlertas();
                    switAlert("success", "Tu foto a sido modificada correctamente", "' . $_SERVER["REQUEST_URI"] . '","");
                    </script>';
                } else {
                    echo '
                        <script>
                        formatearAlertas();
                        notiAlert(3, "Ocurrio un error al guardar la imagen");
                    </script>';
                }
            } else {
                echo '
                        <script>
                        formatearAlertas();
                        notiAlert(3, "Ocurrio un error al crear la imagen. Vuelve a intentarlo");
                    </script>';
            }
        }
    }
}
