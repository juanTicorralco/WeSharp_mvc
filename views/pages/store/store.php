<?php
    $select = "cover_store,logo_store,name_store,email_store,country_store,city_store,address_store,phone_store,socialnetwork_store,id_store,url_store,about_store,id_user_store";
    $url = CurlController::api()."stores?linkTo=url_store&equalTo=".$urlParams[0]."&select=".$select;
    $method = "GET";
    $fields = array();
    $headers = array();
    $storeRes = CurlController::request($url,$method,$fields,$headers);
    $storeRes2 = $storeRes;

    if($storeRes->status == 200){
        $storeRes = $storeRes->result[0];
    }else{
        $storeRes = array();
    }

    $select = "reviews_product";
    $url = CurlController::api()."products?linkTo=id_store_product,approval_product,state_product&equalTo=".$storeRes->id_store.",approved,show&select=".$select;
    $dataReview = CurlController::request($url,$method,$headers,$fields);
    $reviews = 0;
    $totalReviews = 0;
    $totalProductsStore = 0;

    if($dataReview->status == 200){
        $totalProductsStore = $dataReview->total;
        foreach($dataReview->result as $index => $item){
            if($item->reviews_product != null){
                foreach(json_decode($item->reviews_product, true) as $indx => $item2){
                    $reviews += $item2["review"];
                    $totalReviews++;
                }
            }
        }
        if($reviews > 0 && $totalReviews >0){
            $reviews = round($reviews/$totalReviews);
        }
    }

    /* Bring the best sales products */
    $select2 = "name_product,reviews_product,price_product,offer_product,image_product,url_product,stock_product,url_category,summary_product";
    $url2=CurlController::api()."relations?rel=products,categories&type=product,category&linkTo=id_store_product,approval_product,state_product&equalTo=".$storeRes->id_store.",approved,show&select=".$select2."&orderBy=sales_product&orderMode=DESC&startAt=0&endAt=7";
    $bestSalesStore= CurlController::request($url2, $method, $field, $header);
    if($bestSalesStore->status == 200){
        $bestSalesStore = $bestSalesStore->result;
    }else{
        $bestSalesStore = array();
    }

     /* valdate if there is pagination */
     if(isset($urlParams[1])){
        if(is_numeric($urlParams[1])){
            /* aqui se cambia la paginacion */
            $starAt= ($urlParams[1]*20) - 20;
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
    $endAt = 20;
    /* Bring all products */
    // $select3 = "name_product,reviews_product,price_product,offer_product,image_product,url_product,stock_product,url_category";
    $url3=CurlController::api()."relations?rel=products,categories&type=product,category&linkTo=id_store_product,approval_product,state_product&equalTo=".$storeRes->id_store.",approved,show&orderBy=" . $orderBy . "&orderMode=" . $orderMode . "&startAt=" . $starAt . "&endAt=".$endAt."&select=".$select2;
    $AllProductStore= CurlController::request($url3, $method, $field, $header);
    if($AllProductStore->status == 200){
        $AllProductStore = $AllProductStore->result;
    }else{
        $AllProductStore = array();
    }
?>
<!--=====================================
Breadcrumb
======================================-->  

    <div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="/">Home</a></li>

                <li><?php echo $storeRes->name_store; ?></li>

            </ul>

        </div>

    </div>

    <!--=====================================
    Vendor Store
    ======================================--> 
    <div class="container-fluid preloadTrue">
        <div class="ph-col-6">
            <div class="ph-item border-0">
                <div class="ph-col-2">
                    <div class="ph-picture" style="height:900px"></div>
                </div>
                <div class="ph-col-10">
                    <div class="ph-picture" style="height:400px"></div>
                    <div class="ph-item">
                        <div class="ph-col-12">
                            <div class="ph-picture"></div>
                        </div>

                        <div class="ph-col-12">
                            <div class="ph-row">
                                <div class="ph-col-12 "></div>
                                <div class="ph-col-8 "></div>
                                <div class="ph-col-4 empty"></div>
                                <div class="ph-col-4 "></div>
                                <div class="ph-col-8 empty"></div>
                            </div>
                        </div>
                    </div>
                    <div class="ph-item">
                        <div class="ph-col-12">
                            <div class="ph-picture"></div>
                        </div>
                        <div class="ph-col-12">
                            <div class="ph-row">
                                <div class="ph-col-12 "></div>
                                <div class="ph-col-8 "></div>
                                <div class="ph-col-4 empty"></div>
                                <div class="ph-col-4 "></div>
                                <div class="ph-col-8 empty"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="ps-vendor-store preloadFalse">
        <div class="container"> 
            <div class="ps-section__container">

                <!-- tienda -->
                <div class="ps-section__left">
                    <div class="ps-block--vendor">
                        <div class="ps-block__thumbnail"><img src="img/stores/<?php echo $storeRes->url_store; ?>/<?php echo $storeRes->logo_store; ?>" alt=""></div>
                        <div class="ps-block__container">
                            <div class="ps-block__header">
                                <h4><?php echo $storeRes->name_store; ?></h4>

                                <select class="ps-rating" data-read-only="true" style="display: none;">
                                    <?php
                                        if($reviews > 0){
                                            for($i = 0; $i < 5; $i++){
                                                if($reviews < ($i + 1)){
                                                    echo '<option value="1">'.($i+1).'</option>';
                                                }else{
                                                    echo '<option value="2">'.($i+1).'</option>';
                                                }
                                            }
                                        }else{
                                            echo '<option value="0">0</option>';
                                            for($i = 0; $i < 5; $i++){
                                                echo '<option value="1">'.($i+1).'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <p><strong><?php echo ($reviews*100)/5; ?>% Positive</strong> (<?php echo $totalReviews; ?> rating)</p>
                            </div><span class="ps-block__divider"></span>
                            <div class="ps-block__content">
                                <p><strong><?php echo $storeRes->name_store; ?></strong>, <?php echo $storeRes->about_store; ?></p>
                                <?php if($storeRes->socialnetwork_store != null): ?>
                                    <figure>

                                        <ul class="ps-list--social-color">

                                            <?php foreach(json_decode( $storeRes->socialnetwork_store, true) as $index => $item): ?>
                                                <li>
                                                    <a target="_blank" class="<?php  echo array_keys($item)[0]; ?>" href="<?php  echo $item[array_keys($item)[0]]; ?>">
                                                        <i class="fab fa-<?php  echo array_keys($item)[0]; ?>"></i></a>
                                                </li>
                                            <?php endforeach;?>

                                        </ul>

                                    </figure>
                                <?php endif; ?>
                            </div>
                            <div class="ps-block__footer">
                                <p>Call us directly<strong>(+<?php echo explode("_", $storeRes->phone_store)[0]; ?>) <?php echo explode("_", $storeRes->phone_store)[1]; ?></strong></p>
                                <!-- <p>or Or if you have any question</p><a class="ps-btn ps-btn--fullwidth" href="">Contact Seller</a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catalogo products -->
                <div class="ps-section__right">
                    <div class="ps-block--vendor-filter">
                        <div class="ps-block__left">
                            <ul>
                                <li class="active"><a href="#">Products</a></li>
                                <li><a href="#">Reviews</a></li>
                                <li><a href="#">About</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- mas venddos -->
                    <?php if($totalProductsStore > 1): ?>
                    <div class="ps-vendor-best-seller">
                        <div class="ps-section__header">
                            <h3>Mas vendidos</h3>
                            <div class="ps-section__nav"><a class="ps-carousel__prev" href="#vendor-bestseller"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#vendor-bestseller"><i class="icon-chevron-right"></i></a></div>
                        </div>
                        <div class="ps-section__content">
                            <div class="owl-slider" id="vendor-bestseller" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                                <?php foreach($bestSalesStore as $key => $value): ?>
                                    <div class="ps-product">
                                        <div class="ps-product__thumbnail"><a href="<?php echo $path.$value->url_product; ?>"><img src="img/products/<?php echo $value->url_category ?>/<?php echo $value->image_product ?>" alt="<?php echo $value->image_product ?>"></a>
                                        <?php if ($value->stock_product != 0) : ?>
                                            <?php if ($value->offer_product != null) : ?>

                                                <div class="ps-product__badge">-<?php echo TemplateController::percentOffer($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); ?>%</div>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <div class="ps-product__badge out-stock">Out Of Stock</div>
                                        <?php endif; ?>

                                        <?php
                                        if (in_array($value->url_product, $wishlist)) {
                                            echo '  <p mb-5></p>  <div class="ps-product__badge bg-danger mt-5 "><i class="fas fa-heart"></i></div>';
                                        }
                                        ?>

                                        <div class="invisibleCorazon <?php echo $value->url_product; ?>">
                                        <p mb-5></p>  <div class="ps-product__badge bg-danger mt-5 "><i class="fas fa-heart"></i></div>
                                        </div>
                                            <ul class="ps-product__actions">
                                                <li>
                                                    <a 
                                                    class="btn" 
                                                    onclick="addBagCard('<?php echo $value->url_product; ?>', '<?php echo $value->url_category; ?>', '<?php echo $value->image_product; ?>', '<?php echo $value->name_product; ?>', '<?php echo $value->price_product; ?>', '<?php echo $path ?>', '<?php echo CurlController::api(); ?>', this)"
                                                    detailSC 
                                                    quantitySC
                                                    data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                        <i class="icon-bag2"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="<?php echo $path . $value->url_product; ?>" data-toggle="tooltip" data-placement="top" title="Quick View">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="btn" onclick="addWishList('<?php echo $value->url_product; ?>', '<?php echo CurlController::api(); ?>')" data-toggle="tooltip" data-placement="top" title="Lo deseo">
                                                        <i class="icon-heart"></i>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                        <div class="ps-product__container">
                                            <a class="ps-product__vendor" href="<?php echo $path . $value->url_product?>"></a>
                                            <div class="ps-product__content">
                                                <a class="ps-product__title" href="<?php echo $path . $value->url_product?>"><?php echo $value->name_product ?></a>
                                                <div class="ps-product__rating">
                                                <?php $reviews = TemplateController::calificationStars(json_decode($value->reviews_product, true)); ?>

                                                    <select class="ps-rating" data-read-only="true">

                                                        <?php
                                                        if ($reviews > 0) {
                                                            for ($i = 0; $i < 5; $i++) {
                                                                if ($reviews < ($i + 1)) {
                                                                    echo '<option value="1">' . $i + 1 . '</option>';
                                                                } else {
                                                                    echo '<option value="2">' . $i + 1 . '</option>';
                                                                }
                                                            }
                                                        } else {
                                                            echo '<option value="0">0</option>';
                                                            for ($i = 0; $i < 5; $i++) {
                                                                echo '<option value="1">' . $i + 1 . '</option>';
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                    <span>(<?php
                                                        if ($value->reviews_product != null) {
                                                            echo count(json_decode($value->reviews_product, true));
                                                        } else {
                                                            echo "0";
                                                        }
                                                        ?> review)
                                                    </span>
                                                </div>
                                                <?php if ($value->offer_product != null) : ?>
                                                    <p class="ps-product__price sale">$<?php echo TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); ?> <del>$<?php echo $value->price_product; ?></del></p>
                                                <?php else : ?>
                                                    <p class="ps-product__price">$<?php echo $value->price_product; ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo $path . $value->url_product; ?>"><?php echo $value->name_product ?></a>
                                                <?php if ($value->offer_product != null) : ?>
                                                    <p class="ps-product__price sale">$<?php echo TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); ?> <del>$<?php echo $value->price_product; ?></del></p>
                                                <?php else : ?>
                                                    <p class="ps-product__price">$<?php echo $value->price_product; ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="ps-shopping ps-tab-root">
                        <div class="ps-shopping__header">
                            <p><strong> Total: </strong> <?php echo $totalProductsStore ?></p>
                            <div class="ps-shopping__actions">
                                <select class="ps-select select2" data-placeholder="Sort Items" onchange="sortProduct(event)">
                                <?php if (isset($urlParams[2])) : ?>
                                    <?php if ($urlParams[2] == "new") : ?>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
                                    <?php endif; ?>
                                    <?php if ($urlParams[2] == "latets") : ?>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
                                    <?php endif; ?>
                                    <?php if ($urlParams[2] == "low") : ?>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
                                    <?php endif; ?>
                                    <?php if ($urlParams[2] == "higt") : ?>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                                        <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>

                                    <?php endif; ?>

                                    <?php else : ?>
                                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>
                                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
                                    <?php endif; ?>
                                    </select>
                                </select>
                                <div class="ps-shopping__view">
                                    <p>View</p>
                                    <ul class="ps-tab-list">
                                         <!-- checkar si hay una cookie -->
                                        <?php if(isset($_COOKIE["tab"])): ?>
                                        <?php if($_COOKIE["tab"]=="grid" || $_COOKIE["tab"] == "undefined"): ?>
                                            <li class="active" type="grid">
                                        <?php else: ?>
                                            <li class="" type="grid">
                                        <?php endif; ?>
                                        <?php else: ?>
                                            <li class="active" type="grid">  
                                        <?php endif; ?>

                                            <a href="#tab-1">
                                                <i class="icon-grid"></i>
                                            </a>
                                        </li>

                                        <!-- checkar si hay una cookie -->
                                        <?php if(isset($_COOKIE["tab"])): ?>
                                        <?php if($_COOKIE["tab"]=="list"): ?>
                                            <li class="active" type="list">
                                        <?php else: ?>
                                            <li class="" type="list">
                                        <?php endif; ?>
                                        <?php else: ?>
                                            <li class="" type="list">  
                                        <?php endif; ?>
                                            <a href="#tab-2">
                                                <i class="icon-list4"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- todos los productos -->
                        <?php if($totalProductsStore > 0): ?>
                        <div class="ps-tabs">
                             <!-- checkar si hay una cookie -->
                            <?php if (isset($_COOKIE["tab"])) : ?>
                                <?php if ($_COOKIE["tab"] == "grid" || $_COOKIE["tab"] == "undefined") : ?>
                                    <div class="ps-tab active" id="tab-1">
                                <?php else : ?>
                                        <div class="ps-tab" id="tab-1">
                                <?php endif; ?>
                            <?php else : ?>
                                        <div class="ps-tab active" id="tab-1">
                            <?php endif; ?>
                                <div class="row">
                                    <?php if($AllProductStore > 0): ?>
                                        <?php foreach($AllProductStore as $key => $value):?>
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                                <div class="ps-product">
                                                    <div class="ps-product__thumbnail"><a href="<?php echo $path . $value->url_product; ?>"><img src="img/products/<?php echo $value->url_category; ?>/<?php echo $value->image_product; ?>" alt="<?php echo $value->name_product; ?>"></a>
                                                    <?php if ($value->stock_product != 0) : ?>
                                                        <?php if ($value->offer_product != null) : ?>

                                                            <div class="ps-product__badge">-<?php echo TemplateController::percentOffer($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); ?>%</div>
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <div class="ps-product__badge out-stock">Out Of Stock</div>
                                                    <?php endif; ?>

                                                    <?php
                                                        if (in_array($value->url_product, $wishlist)) {
                                                            echo '  <p mb-5></p>  <div class="ps-product__badge bg-danger mt-5 "><i class="fas fa-heart"></i></div>';
                                                        }
                                                    ?>

                                                    <div class="invisibleCorazon <?php echo $value->url_product; ?>">
                                                        <p mb-5></p>  <div class="ps-product__badge bg-danger mt-5 "><i class="fas fa-heart"></i></div>
                                                    </div>
                                                        <ul class="ps-product__actions">
                                                            <li>
                                                                <a  
                                                                class="btn" 
                                                                onclick="addBagCard('<?php echo $value->url_product; ?>', '<?php echo $value->url_category; ?>', '<?php echo $value->image_product; ?>', '<?php echo $value->name_product; ?>', '<?php echo $value->price_product; ?>', '<?php echo $path ?>', '<?php echo CurlController::api(); ?>', this)"
                                                                detailSC 
                                                                quantitySC
                                                                data-toggle="tooltip" data-placement="top" title="Agregar al carrito">
                                                                    <i class="icon-bag2"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="<?php echo $path . $value->url_product; ?>" data-toggle="tooltip" data-placement="top" title="Quick View">
                                                                    <i class="icon-eye"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a class="btn" onclick="addWishList('<?php echo $value->url_product; ?>', '<?php echo CurlController::api(); ?>')" data-toggle="tooltip" data-placement="top" title="Lo deseo">
                                                                    <i class="icon-heart"></i>
                                                                </a>
                                                            </li>   
                                                        </ul>
                                                    </div>
                                                    <div class="ps-product__container"><a class="ps-product__vendor" href="#"></a>
                                                        <div class="ps-product__content">
                                                        <a class="ps-product__title" href="<?php echo $path . $value->url_product; ?>"><?php echo $value->name_product; ?></a>
                                                            <div class="ps-product__rating">
                                                            <?php $reviews = TemplateController::calificationStars(json_decode($value->reviews_product, true)); ?>

                                                                <select class="ps-rating" data-read-only="true">

                                                                    <?php
                                                                    if ($reviews > 0) {
                                                                        for ($i = 0; $i < 5; $i++) {
                                                                            if ($reviews < ($i + 1)) {
                                                                                echo '<option value="1">' . $i + 1 . '</option>';
                                                                            } else {
                                                                                echo '<option value="2">' . $i + 1 . '</option>';
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo '<option value="0">0</option>';
                                                                        for ($i = 0; $i < 5; $i++) {
                                                                            echo '<option value="1">' . $i + 1 . '</option>';
                                                                        }
                                                                    }
                                                                    ?>

                                                                </select>

                                                                <span>
                                                                    (<?php
                                                                        if ($value->reviews_product != null) {
                                                                            echo count(json_decode($value->reviews_product, true));
                                                                        } else {
                                                                            echo "0";
                                                                        }
                                                                        ?>)
                                                                </span>
                                                            </div>
                                                            <?php if ($value->offer_product != null) : ?>
                                                                <p class="ps-product__price sale">$<?php echo TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); ?> <del>$<?php echo $value->price_product; ?></del></p>
                                                            <?php else : ?>
                                                                <p class="ps-product__price">$<?php echo $value->price_product; ?></p>
                                                            <?php endif; ?>
                                                                </div>
                                                        <div class="ps-product__content hover">
                                                        <a class="ps-product__title" href="<?php echo $path . $value->url_product; ?>"><?php echo $value->name_product; ?></a>
                                                        <?php if ($value->offer_product != null) : ?>
                                                        <p class="ps-product__price sale">$<?php echo TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); ?> <del>$<?php echo $value->price_product; ?></del></p>
                                                    <?php else : ?>
                                                        <p class="ps-product__price">$<?php echo $value->price_product; ?></p>
                                                    <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <h4>No hay Productos</h4>
                                    <?php endif; ?>
                                </div>
                                <div class="ps-pagination">
                                    <?php if (isset($urlParams[1])) {
                                        $CurrentPage = $urlParams[1];
                                    } else {
                                        $CurrentPage = 1;
                                    } ?>

                                    <ul class="pagination" data-total-page="<?php echo ceil($totalProductsStore / $endAt) ?>" data-current-page="<?php echo $CurrentPage; ?>" data-url-page="<?php echo $_SERVER["REQUEST_URI"]; ?>"></ul>
                                </div>
                            </div>
                            <!-- checkar si hay una cookie -->
                                <?php if (isset($_COOKIE["tab"])) : ?>
                                <?php if ($_COOKIE["tab"] == "list") : ?>
                                 <div class="ps-tab active" id="tab-2">
                                <?php else : ?>
                                    <div class="ps-tab" id="tab-2">
                                <?php endif; ?>
                                <?php else : ?>
                                  <div class="ps-tab" id="tab-2">
                                <?php endif; ?>
                                <?php if($AllProductStore > 0 ) :  ?>
                                <?php foreach($AllProductStore as $key => $value):?>
                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail">
                                            <a href="<?php echo $path . $value->url_product; ?>">
                                                <img style="height: 100%;" src="img/products/<?php echo $value->url_category; ?>/<?php echo $value->image_product; ?>" alt="<?php echo $value->name_product; ?>">
                                            </a>

                                            <?php if ($value->stock_product != 0) : ?>
                                                <?php if ($value->offer_product != null) : ?>

                                                    <div class="ps-product__badge">-<?php echo TemplateController::percentOffer($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); ?>%</div>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <div class="ps-product__badge out-stock">Out Of Stock</div>
                                            <?php endif; ?>

                                            <?php
                                            if (in_array($value->url_product, $wishlist)) {
                                                echo '  <p mb-5></p>  <div class="ps-product__badge bg-danger mt-5 "><i class="fas fa-heart"></i></div>';
                                            }
                                            ?>

                                            <div class="invisibleCorazon <?php echo $value->url_product; ?>">
                                            <p mb-5></p>  <div class="ps-product__badge bg-danger mt-5 "><i class="fas fa-heart"></i></div>
                                            </div>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content">
                                                <a class="ps-product__title" href="<?php echo $path . $value->url_product; ?>">
                                                    <?php echo $value->name_product; ?></a>

                                                <p class="ps-product__vendor">Sold by:
                                                    <a href="<?php echo $path . $storeRes->url_store; ?>"><?php echo $storeRes->name_store; ?></a>
                                                </p>

                                                <div class="ps-product__rating">

                                                    <?php $reviews = TemplateController::calificationStars(json_decode($value->reviews_product, true)); ?>

                                                    <select class="ps-rating" data-read-only="true">

                                                        <?php
                                                        if ($reviews > 0) {
                                                            for ($i = 0; $i < 5; $i++) {
                                                                if ($reviews < ($i + 1)) {
                                                                    echo '<option value="1">' . $i + 1 . '</option>';
                                                                } else {
                                                                    echo '<option value="2">' . $i + 1 . '</option>';
                                                                }
                                                            }
                                                        } else {
                                                            echo '<option value="0">0</option>';
                                                            for ($i = 0; $i < 5; $i++) {
                                                                echo '<option value="1">' . $i + 1 . '</option>';
                                                            }
                                                        }
                                                        ?>

                                                    </select>

                                                    <span>
                                                        (<?php
                                                            if ($value->reviews_product != null) {
                                                                echo count(json_decode($value->reviews_product, true));
                                                            } else {
                                                                echo "0";
                                                            }
                                                            ?> review)
                                                    </span>


                                                </div>

                                                <ul class="ps-product__desc">
                                                    <?php foreach (json_decode($value->summary_product) as $key2 => $value2) : ?>
                                                        <li> <?php echo $value2; ?> </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <?php if ($value->offer_product != null) : ?>
                                                    <p class="ps-product__price sale">$<?php echo TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); ?> <del>$<?php echo $value->price_product; ?></del></p>
                                                <?php else : ?>
                                                    <p class="ps-product__price">$<?php echo $value->price_product; ?></p>
                                                <?php endif; ?>

                                                <a class="ps-btn" 
                                                class="btn" 
                                                onclick="addBagCard('<?php echo $value->url_product; ?>', '<?php echo $value->url_category; ?>', '<?php echo $value->image_product; ?>', '<?php echo $value->name_product; ?>', '<?php echo $value->price_product; ?>', '<?php echo $path ?>', '<?php echo CurlController::api(); ?>', this)"
                                                detailSC 
                                                quantitySC
                                                >Add to cart</a>

                                                <ul class="ps-product__actions">
                                                    <li><a href="<?php echo $path . $value->url_product; ?>"><i class="icon-eye"></i>View</a></li>
                                                    <li>
                                                    <a class="btn" onclick="addWishList('<?php echo $value->url_product; ?>', '<?php echo CurlController::api(); ?>')" >
                                                    <strong> <i class="icon-heart"></i> Wishlist</strong></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <h4>No hay Productos</h4>
                                <?php endif; ?>
                                <div class="ps-pagination">
                                    <?php if (isset($urlParams[1])) {
                                        $CurrentPage = $urlParams[1];
                                    } else {
                                        $CurrentPage = 1;
                                    } ?>

                                    <ul class="pagination" data-total-page="<?php echo ceil($totalProductsStore / $endAt) ?>" data-current-page="<?php echo $CurrentPage; ?>" data-url-page="<?php echo $_SERVER["REQUEST_URI"]; ?>"></ul>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>