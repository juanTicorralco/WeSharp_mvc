<?php 
    /* choose a ramdom id for the banner */
    $randomId= rand(1, $totalProducts);
    /* request to the api about the product banner */
    $url= CurlController::api()."relations?rel=products,categories&type=product,category&linkTo=id_product&equalTo=$randomId";
    $method="GET";
    $field=array();
    $header=array();

    $randomProduct= CurlController::request($url, $method, $field, $header)->result[0];
    $topBanner= json_decode( $randomProduct->top_banner_product, true);
?>

<div class="ps-block--promotion-header bg--cover" style="background: url(img/products/<?php echo $randomProduct->url_category; ?>/top/<?php echo $topBanner["IMG tag"]; ?>);">
        <div class="container">
            <div class="ps-block__left">
                <!-- filter the categories and subcategories -->
                <h3>  <?php echo $topBanner["H3 tag"]; ?>  </h3>
                <figure>
                    <p><?php echo $topBanner["P1 tag"]; ?></p>
                    <h4> <?php echo $topBanner["H4 tag"]; ?> </h4>
                </figure>
            </div>
            <div class="ps-block__center">
                <p> <?php echo $topBanner["P2 tag"]; ?> <span><?php echo $topBanner["Span tag"]; ?></span></p>
            </div><a class="ps-btn ps-btn--sm" href="<?php echo $path.$randomProduct->url_product; ?>"><?php echo $topBanner["Button tag"]; ?></a>
        </div>
    </div>
