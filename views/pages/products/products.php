<?php 
    /* valdate if there is pagination */
    if(isset($urlParams[1])){
        if(is_numeric($urlParams[1])){
            /* aqui se cambia la paginacion */
            $starAt= ($urlParams[1]*24) - 24;
        }else{
            echo '<script> 
                window.location= "'.$path.$urlParams[1].'"
            </script>';   
        }
    }else{
        $starAt=0;
    }

    /* validar que haya parametros de orden */
    if(isset($urlParams[2])){
        if(is_string($urlParams[2])){
            if($urlParams[2]=="new"){
                $orderBy="id_product";
                $orderMode="DESC";
            }
            else if($urlParams[2]=="latets"){
                $orderBy="id_product";
                $orderMode="ASC";
            }
            else if($urlParams[2]=="low"){
                $orderBy="price_product";
                $orderMode="ASC";
            }
            else if($urlParams[2]=="higt"){
                $orderBy="price_product";
                $orderMode="DESC";
            }else{
                echo '<script> 
                window.location= "'.$path.$urlParams[0].'";
            </script>';
            }
        }else{
            echo '<script> 
            window.location= "'.$path.$urlParams[0].'";
        </script>';
        }
    }else{
        $orderBy="id_product";
        $orderMode="DESC";
    }

    /* Bring the products of categories */
    $url=CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&linkTo=url_category&equalTo=".$urlParams[0]."&orderBy=id_category&startAt=0&endAt=7";
    $method="GET";
    $field=array();
    $header=array();

    $productRelation= CurlController::request($url, $method, $field, $header)->result;

    if( $productRelation =="no found"){
        /* Bring the products of subcategories */
        $url=CurlController::api()."relations?rel=products,subcategories,stores&type=product,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[0]."&orderBy=id_category&startAt=0&endAt=7";
        $productRelation= CurlController::request($url, $method, $field, $header)->result;

        /* Bring all subcategories */
        $url2=CurlController::api()."relations?rel=products,subcategories,stores&type=product,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[0];
        $totalProducts = CurlController::request($url2, $method, $field, $header)->total;

         /* actualizar las vistas de subcategorias */
         $views= $productRelation[0]->views_subcategory+1;

         $url123= CurlController::api()."subcategories?id=".$productRelation[0]->id_subcategory."&nameId=id_subcategory";
         $method123= "PUT";
         $field123= "views_subcategory=".$views;
         $header123=array();
 
         $upDateSubCategory= CurlController::request($url123,$method123,$field123, $header123); 
    }else{
        /* Bring all categories */
        $url2=CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&linkTo=url_category&equalTo=".$urlParams[0];
        $totalProducts = CurlController::request($url, $method, $field, $header)->total;

      /* actualizar las vistas de categorias */
        $views= $productRelation[0]->views_category+1;

        $url123= CurlController::api()."categories?id=".$productRelation[0]->id_category."&nameId=id_category";
        $method123= "PUT";
        $field123= "views_category=".$views;
        $header123=array();

        $upDateCategory= CurlController::request($url123,$method123,$field123, $header123); 
    }

    /* Bring the best sales of categories */
    $url2=CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&linkTo=url_category&equalTo=".$urlParams[0]."&orderBy=sales_product&orderMode=DESC&startAt=0&endAt=7";
    $bestSalesItem= CurlController::request($url2, $method, $field, $header)->result;

    if( $bestSalesItem =="no found"){
        /* Bring the products of subcategories */
        $url2=CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[0]."&orderBy=sales_product&orderMode=DESC&startAt=0&endAt=7";
        $bestSalesItem= CurlController::request($url2, $method, $field, $header)->result;
    }

    /* Bring the best sales of categories */
    $url3=CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&linkTo=url_category&equalTo=".$urlParams[0]."&orderBy=views_product&orderMode=DESC&startAt=0&endAt=7";
    $moreViewsItem= CurlController::request($url3, $method, $field, $header)->result;

    if( $moreViewsItem =="no found"){
        /* Bring the products of subcategories */
        $url3=CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[0]."&orderBy=views_product&orderMode=DESC&startAt=0&endAt=7";
        $moreViewsItem= CurlController::request($url3, $method, $field, $header)->result;
    }
?>

<!--=====================================
Breadcrumb
======================================-->  

<?php include "modules/breadCrumb.php"; ?>

<!--=====================================
Categories Content
======================================--> 

<div class="container-fuid bg-white my-4">

    <div class="container">

        <!--=====================================
        Layout Categories
        ======================================--> 

        <div class="ps-layout--shop">
        
            <section>

                <!--=====================================
                Best Sale Items
                ======================================--> 

                <?php include "modules/bestSales.php"; ?>

                <!--=====================================
                Recommended Items
                ======================================--> 

               <?php include "modules/recomended.php"; ?>

                <!--=====================================
                Products found
                ======================================--> 

                <div id="showCase" class="ps-shopping ps-tab-root">

                    <!--=====================================
                    Shoping Header
                    ======================================--> 

                    <?php include "modules/shopingHeader.php"; ?>

                    <!--=====================================
                    Shoping Body
                    ======================================--> 

                    <?php include "modules/shopingBody.php"; ?>

                </div>

            </section>

        </div><!-- End Layout Categories -->

    </div><!-- End Container -->

</div><!-- End Container Fluid -->