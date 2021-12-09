<!-- traer toda la informacion del producto -->
<?php
$url9 = CurlController::api() . "relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_product&equalTo=" . $urlParams[0]."&select=url_category,image_product,name_product,offer_product,price_product,offer_product,views_product,id_product,name_category,url_subcategory,name_subcategory,stock_product,gallery_product,reviews_product,name_store,summary_product,video_product,specifications_product,title_list_product,tags_product,description_product,details_product,about_store,url_store,logo_store,id_store";
$method9 = "GET";
$field9 = array();
$header9 = array();

$producter = CurlController::request($url9, $method9, $field9, $header9)->result[0];

 /* actualizar las vistas de productos */
 $viewsProduct= $producter->views_product+1;

 $url12= CurlController::api()."products?id=".$producter->id_product."&nameId=id_product&token=no&except=views_product";
 $method12= "PUT";
 $field12= "views_product=".$viewsProduct;
 $header12=array();

 $upDateProduct= CurlController::request($url12,$method12,$field12, $header12); 

?>

<!--=====================================
	call to action 
======================================-->

<?php include "modules/callToAction.php"; ?>

<!--=====================================
Breadcrumb
======================================-->

<?php include "modules/breadCrumb.php"; ?>

<!--=====================================
Product Content
======================================-->

<div class="ps-page--product">

    <div class="ps-container">

        <!--=====================================
        Product Container
        ======================================-->

        <div class="ps-page__container">

            <!--=====================================
            Left Column
            ======================================-->

            <div class="ps-page__left">

                <div class="ps-product--detail ps-product--fullwidth">

                    <!--=====================================
                    Product Header
                    ======================================-->

                    <div class="ps-product__header">

                        <!--=====================================
                        Gallery
                        ======================================-->
                        <?php include "modules/gallery.php"; ?>
                        <!--=====================================
                        Product Info
                        ======================================-->

                        <?php include "modules/infoProduct.php"; ?>

                    </div> <!-- End Product header -->

                    <!--=====================================
                    Product Content
                    ======================================-->

                    <div class="ps-product__content ps-tab-root">

                        <!-- Comprados con frecuencia -->
                        <?php include "modules/frecuently.php"; ?>

                        <!-- menu del producto -->
                        <?php include "modules/menuProduct.php"; ?>

                    </div><!--  End product content -->

                </div>

            </div><!-- End Left Column -->

            <!--=====================================
            Right Column
            ======================================-->

            <div class="ps-page__right d-block d-sm-none d-xl-block">

                <aside class="widget widget_product widget_features">

                    <p><i class="icon-network"></i> Envios a toda la republica </p>

                    <p><i class="icon-3d-rotate"></i> Devolución gratuita en 7 días si es elegible, muy fácil</p>

                    <p><i class="icon-receipt"></i> Se factura este producto.</p>

                    <p><i class="icon-credit-card"></i> Pague en línea o al recibir el producto</p>

                </aside>

                <!-- misma marca -->
                <?php include "modules/someBrand.php"; ?>

            </div><!-- End Right Column -->

        </div><!--  End Product Container -->

        <!--=====================================
        Customers who bought
        ======================================-->

        <?php include "modules/coustomersWhoBouht.php"; ?>
        <!--=====================================
        Related products
        ======================================-->

        <?php include "modules/relatedProducts.php"; ?>

    </div>

</div><!-- End Product Content -->