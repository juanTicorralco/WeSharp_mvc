<?php
/* Direction Route  */
$routesArray = explode("/", $_SERVER['REQUEST_URI']);

//$routeArray= array_filter($routesArray);
if (!empty(array_filter($routesArray)[1])) {
    $urlParams = explode("&", array_filter($routesArray)[1]);
}

if (!empty($urlParams[0])) {
    /* filter categorys whidt URL paremers */
    $url = CurlController::api() . "categories?linkTo=url_category&equalTo=" . $urlParams[0] . "&select=url_category";
    $method = "GET";
    $field = array();
    $header = array();

    $urlCategories = CurlController::request($url, $method, $field, $header);

    if ($urlCategories->status == 404) {
        /* filter subcategorys whidt URL paremers */
        $url = CurlController::api() . "subcategories?linkTo=url_subcategory&equalTo=" . $urlParams[0] . "&select=url_subcategory";
        $method = "GET";
        $field = array();
        $header = array();

        $urlSubcategories = CurlController::request($url, $method, $field, $header);

        if ($urlSubcategories->status == 404) {
            /* filter porducts whidt URL paremers */
            $url = CurlController::api() . "products?linkTo=url_product&equalTo=" . $urlParams[0] . "&select=url_product";
            $method = "GET";
            $field = array();
            $header = array();

            $urlProduct = CurlController::request($url, $method, $field, $header);

            if ($urlProduct->status == 404) {

                /* valdate if there is pagination */
                if (isset($urlParams[1])) {
                    if (is_numeric($urlParams[1])) {
                        /* aqui se cambia la paginacion */
                        $starAt = ($urlParams[1] * 24) - 24;
                    } else {
                        echo '<script> 
                                window.location= "' . $path . $urlParams[1] . '"
                            </script>';
                    }
                } else {
                    $starAt = 0;
                }

                /* validar que haya parametros de orden */
                if (isset($urlParams[2])) {
                    if (is_string($urlParams[2])) {
                        if ($urlParams[2] == "new") {
                            $orderBy = "id_product";
                            $orderMode = "DESC";
                        } else if ($urlParams[2] == "latets") {
                            $orderBy = "id_product";
                            $orderMode = "ASC";
                        } else if ($urlParams[2] == "low") {
                            $orderBy = "price_product";
                            $orderMode = "ASC";
                        } else if ($urlParams[2] == "higt") {
                            $orderBy = "price_product";
                            $orderMode = "DESC";
                        } else {
                            echo '<script> 
                                window.location= "' . $path . $urlParams[0] . '";
                            </script>';
                        }
                    } else {
                        echo '<script> 
                            window.location= "' . $path . $urlParams[0] . '";
                        </script>';
                    }
                } else {
                    $orderBy = "id_product";
                    $orderMode = "DESC";
                }

                $linkTo = ["name_product", "title_list_product", "tags_product", "summary_product"];
                $selecte = "url_product,url_category,image_product,name_product,stock_product,offer_product,price_product,url_store,name_store,reviews_product,views_category,name_category,id_category,views_subcategory,name_subcategory,id_subcategory,summary_product";

                foreach ($linkTo as $key => $value) {

                    /* filtrar por busqueda con el parametro url de busqueda*/
                    $url = CurlController::api() . "relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=" . $value . "&search=" . $urlParams[0] . "&orderBy=" . $orderBy . "&orderMode=" . $orderMode . "&startAt=" . $starAt . "&endAt=24&select=" . $selecte;
                    $method = "GET";
                    $field = array();
                    $header = array();

                    $urlSearch = CurlController::request($url, $method, $field, $header);
                    if ($urlSearch->status != 404) {
                        $totalSearch = $urlSearch->total;
                        break;
                    }
                }
            }
        }
    }
}

/* Bring principal route */
$path = TemplateController::path();

/* BRING THE TOTAL OF PRODUCT */
$url = CurlController::api() . "products?select=id_product";
$method = "GET";
$field = array();
$header = array();

$totalProducts = CurlController::request($url, $method, $field, $header)->total;

//echo '<pre>'; print_r($totalProducts); echo '</pre>';
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>MarketPlace | Home</title>

    <base href="views/">

    <link rel="icon" href="img/template/icono.png">

    <!--=====================================
	CSS
	======================================-->

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="css/plugins/fontawesome.min.css">

    <!-- linear icons -->
    <link rel="stylesheet" href="css/plugins/linearIcons.css">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/plugins/owl.carousel.css">

    <!-- Slick -->
    <link rel="stylesheet" href="css/plugins/slick.css">

    <!-- Light Gallery -->
    <link rel="stylesheet" href="css/plugins/lightgallery.min.css">

    <!-- Font Awesome Start -->
    <link rel="stylesheet" href="css/plugins/fontawesome-stars.css">

    <!-- jquery Ui -->
    <link rel="stylesheet" href="css/plugins/jquery-ui.min.css">

    <!-- Select 2 -->
    <link rel="stylesheet" href="css/plugins/select2.min.css">

    <!-- Scroll Up -->
    <link rel="stylesheet" href="css/plugins/scrollUp.css">

    <!-- DataTable -->
    <link rel="stylesheet" href="css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/plugins/responsive.bootstrap.datatable.min.css">

    <!-- estilo principal -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Market Place 4 -->
    <link rel="stylesheet" href="css/market-place-4.css">

    <!-- Preloader placeholder loading  -->
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">

    <!--=====================================
	PLUGINS JS
	======================================-->

    <!-- jQuery library -->
    <script src="js/plugins/jquery-1.12.4.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Owl Carousel -->
    <script src="js/plugins/owl.carousel.min.js"></script>

    <!-- Images Loaded -->
    <script src="js/plugins/imagesloaded.pkgd.min.js"></script>

    <!-- Masonry -->
    <script src="js/plugins/masonry.pkgd.min.js"></script>

    <!-- Isotope -->
    <script src="js/plugins/isotope.pkgd.min.js"></script>

    <!-- jQuery Match Height -->
    <script src="js/plugins/jquery.matchHeight-min.js"></script>

    <!-- Slick -->
    <script src="js/plugins/slick.min.js"></script>

    <!-- jQuery Barrating -->
    <script src="js/plugins/jquery.barrating.min.js"></script>

    <!-- Slick Animation -->
    <script src="js/plugins/slick-animation.min.js"></script>

    <!-- Light Gallery -->
    <script src="js/plugins/lightgallery-all.min.js"></script>
    <script src="js/plugins/lg-thumbnail.min.js"></script>
    <script src="js/plugins/lg-fullscreen.min.js"></script>
    <script src="js/plugins/lg-pager.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui.min.js"></script>

    <!-- Sticky Sidebar -->
    <script src="js/plugins/sticky-sidebar.min.js"></script>

    <!-- Slim Scroll -->
    <script src="js/plugins/jquery.slimscroll.min.js"></script>

    <!-- Select 2 -->
    <script src="js/plugins/select2.full.min.js"></script>

    <!-- Scroll Up -->
    <script src="js/plugins/scrollUP.js"></script>

    <!-- DataTable -->
    <script src="js/plugins/jquery.dataTables.min.js"></script>
    <script src="js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="js/plugins/dataTables.responsive.min.js"></script>

    <!-- Chart -->
    <script src="js/plugins/Chart.min.js"></script>

    <!-- pagination -->
    <script src="js/plugins/twbs-pagination.min.js"></script>

     <!-- Preloader placeholder loader -->
     <script src="https://cdn.jsdelivr.net/npm/placeholder-loading/dist/css/placeholder-loading.min.css"></script>


</head>

<body>

    <!--=====================================
    Preload
    ======================================-->

    <!-- <div id="loader-wrapper">
        <img src="img/template/loader.jpg">
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div> -->

    <!--=====================================
	Banner Promotion 
	======================================-->

    <?php include "modules/banerModule.php"; ?>

    <!--=====================================
	Header
	======================================-->

    <?php include "modules/headerModule.php"; ?>

    <!--=====================================
	Header Mobile
	======================================-->

    <?php include "modules/headerMobileModule.php"; ?>

    <!--=====================================
    Home Content
    ======================================-->
    <?php
    /* choose which page to enter */
    if (!empty($urlParams[0])) {
        if ($urlCategories->status == 200 || $urlSubcategories->status == 200) {
            include "pages/products/products.php";
        } else if ($urlProduct->status == 200) {
            include "pages/product/product.php";
        } else if ($urlSearch->status == 200) {
            include "pages/search/search.php";
        } else {
            include "pages/404/404.php";
        }
    } else {
        include "pages/home/home.php";
    }
    ?>
    <!--=====================================
	Newletter
	======================================-->

    <div class="ps-newsletter">

        <div class="container">

            <form class="ps-form--newsletter" action="do_action" method="post">

                <div class="row">

                    <div class="col-xl-5 col-12 ">
                        <div class="ps-form__left">
                            <h3>Newsletter</h3>
                            <p>Subscribete para recibir cupones y promociones!</p>
                        </div>
                    </div>

                    <div class="col-xl-7 col-12 ">

                        <div class="ps-form__right">

                            <div class="form-group--nest">

                                <input class="form-control" type="email" placeholder="Escribe tu Email">
                                <button class="ps-btn">Subscribir</button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!--=====================================
	Footer
	======================================-->

    <?php include "modules/footerModule.php"; ?>

    <!--=====================================
	JS PERSONALIZADO
	======================================-->

    <script src="js/main.js"></script>
    <script src="js/funcionesjs.js"></script>

</body>

</html>