<?php
class ControllerVendor{
    public function newVendor(){
        if(isset($_POST["nameStore"])){
            if(preg_match('/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["nameStore"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,10000}$/', $_POST["infoStore"] &&
                preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["cityStore"]) &&
                preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["phoneOrder"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["addresStore"]))
            ){

                if(
                    isset($_FILES['logoStore']["tmp_name"]) &&
                    !empty($_FILES['logoStore']["tmp_name"]) &&
                    isset($_FILES['portStore']["tmp_name"]) &&
                    !empty($_FILES['portStore']["tmp_name"]) 
                    ){

                        $imageLogo = $_FILES['logoStore'];
                        $folderLogo = "img/stores";
                        $pathLogo = $_POST['urlStore'];
                        $widthLogo = 270;
                        $heigthLogo = 270;
                        $nameLogo = "logo";

                        $saveImageLogo = TemplateController::AlmacenPhoto($imageLogo, $folderLogo, $pathLogo, $widthLogo, $heigthLogo, $nameLogo);
                        if($saveImageLogo != 'error'){

                            $imagePort = $_FILES['portStore'];
                            $folderPort = "img/stores";
                            $pathPort = $_POST['urlStore'];
                            $widthPort = 1424;
                            $heigthPort = 768;
                            $namePort = "portada";

                            $saveImagePort = TemplateController::AlmacenPhoto($imagePort, $folderPort, $pathPort, $widthPort, $heigthPort, $namePort);
                            if($saveImagePort != 'error'){

                                $sosialNetwork=array();
                                $mapaStore=array();

                                if(isset($_POST["facebookStore"]) && !empty($_POST["facebookStore"])){
                                    array_push($sosialNetwork,["facebook" => "https://www.facebook.com".$_POST["facebookStore"]]);
                                }
                                if(isset($_POST["youtubeStore"]) && !empty($_POST["youtubeStore"])){
                                    array_push($sosialNetwork,["youtube" => "https://www.youtube.com/".$_POST["youtubeStore"]]);
                                }
                                if(isset($_POST["instagramStore"]) && !empty($_POST["instagramStore"])){
                                    array_push($sosialNetwork,["instagram" => "https://www.instagram.com/".$_POST["instagramStore"]]);
                                }
                                if(isset($_POST["twitterStore"]) && !empty($_POST["twitterStore"])){
                                    array_push($sosialNetwork,["twitter" => "https://twitter.com/".$_POST["twitterStore"]]);
                                }

                                if($sosialNetwork > 0){
                                    $sosialNetwork = json_encode($sosialNetwork);
                                }else{
                                    $sosialNetwork = null;
                                }

                                if(isset($_POST["mapStore"])){
                                    array_push($mapaStore, explode(",", $_POST["mapStore"])[0] ,explode(",", $_POST["mapStore"])[1]);
                                }else{
                                    $mapaStore=null;
                                }
                                
                                $dataStore = array(
                                    "name_store" => TemplateController::capitalize( $_POST["nameStore"]),
                                    "url_store" => $_POST["urlStore"],
                                    "logo_store" => $saveImageLogo,
                                    "cover_store" => $saveImagePort,
                                    "about_store" => $_POST["infoStore"],
                                    "abstract_store" => substr($_POST["infoStore"],0,100)."...",
                                    "email_store" => $_POST["emailStore"],
                                    "country_store" => explode("_", $_POST["countryStore"])[0],
                                    "city_store" => $_POST["cityStore"],
                                    "phone_store" => explode("_", $_POST["countryStore"])[1]."_".$_POST["phoneOrder"],
                                    "address_store" => $_POST["addresStore"],
                                    "map_store" =>  json_encode($mapaStore),
                                    "socialnetwork_store" => $sosialNetwork,
                                    "products_store" => 1,
                                    "date_created_store" => date("Y-m-d")
                                );

                                echo '<pre>'; print_r($dataStore); echo '</pre>';
                            }else{
                                echo '<div class="alert alert-danger alert-dismissible">Error: al salvar la portada</div>
                                <script>
                                    formatearAlertas()
                                </script>';        
                            }

                        }else{
                            echo '<div class="alert alert-danger alert-dismissible">Error: al salvar el logo</div>
                            <script>
                                formatearAlertas()
                            </script>';        
                        }
                }else{
                    echo '<div class="alert alert-danger alert-dismissible">Error: los archivos de imagen no son los indicados</div>
                    <script>
                        formatearAlertas()
                    </script>';
                }

            }else{
                echo '<div class="alert alert-danger alert-dismissible">Error en la sintaxis de los campos</div>
                    <script>
                        formatearAlertas()
                    </script>';
            }
        }
    }
}
?>