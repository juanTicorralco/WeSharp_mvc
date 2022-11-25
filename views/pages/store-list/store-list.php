<?php
    /* valdate if there is pagination */
    if(isset($urlParams[1])){
        if(is_numeric($urlParams[1])){
            /* aqui se cambia la paginacion */
            $starAt= ($urlParams[1]*6) - 6;
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
                $orderBy="id_store";
                $orderMode="DESC";
            }
            else if($urlParams[2]=="latets"){
                $orderBy="id_store";
                $orderMode="ASC";
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
        $orderBy="id_store";
        $orderMode="DESC";
    }

    $endAt = 6;
    $select = "cover_store,logo_store,name_store,email_store,country_store,city_store,address_store,phone_store,socialnetwork_store,id_store,url_store";
    $url = CurlController::api()."stores?orderBy=".$orderBy."&orderMode=".$orderMode."&startAt=".$starAt."&endAt=".$endAt."&select=".$select;
    $method = "GET";
    $fields = array();
    $headers = array();
    $storesResult = CurlController::request($url,$method,$fields,$headers);
    $storesResult2 = $storesResult;

    if($storesResult->status == 200){
        $storesResult = $storesResult->result;
    }else{
        $storesResult = array();
    }
?>
<!--=====================================
Breadcrumb
======================================-->  

<div class="ps-breadcrumb">

    <div class="container">

        <ul class="breadcrumb">

            <li><a href="/">Home</a></li>

            <li>Store List</li>

        </ul>

    </div>

</div>

<!--=====================================
Store List
======================================--> 

<section class="ps-store-list">

    <div class="container">

        <div class="ps-section__header">

            <h3>Store list</h3>

        </div>

        <div class="ps-section__wrapper" data-select2-id="14">

            <div class="ps-section__center" data-select2-id="33">

                <section class="ps-store-box" data-select2-id="32">

                    <?php if($storesResult2->status == 200): ?>
                    <?php 
                        $url = CurlController::api()."stores?select=id_store";
                        $totalStores = CurlController::request($url,$method,$fields,$headers)->total;
                    ?>

                    <div class="ps-section__header">

                        <p>Total <?php echo $totalStores; ?> results</p>                  

                        <!-- <form class="form-inline" action="/action">
                            
                            <label for="search pr-3">Search: </label>
                            
                            <input type="search" class="ml-3" id="search" placeholder="Input here...">

                        </form> -->

                        <select class="select2 w-25" data-placeholder="Sort Items" onchange="sortProduct(event)">
                            <?php if (isset($urlParams[2])) : ?>
                                <?php if ($urlParams[2] == "new") : ?>
                                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                                <?php endif; ?>
                                <?php if ($urlParams[2] == "latets") : ?>
                                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                                <?php endif; ?>
                            <?php else : ?>
                            <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                            <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                            <?php endif; ?>
                        </select>

                    </div>

                    <div class="ps-section__content">

                        <div class="row">

                        <?php foreach($storesResult as $key => $value):?>

                            <div class="col-lg-4 col-md-6 col-12">

                                <article class="ps-block--store">

                                    <div class="ps-block__thumbnail bg--cover" style="background: url(img/stores/<?php echo $value->url_store; ?>/<?php echo $value->cover_store; ?>);"></div>

                                    <div class="ps-block__content">

                                        <div class="ps-block__author">

                                            <a class="ps-block__user" href="<?php echo TemplateController::path().$value->url_store; ?>">

                                                <img src="img/stores/<?php echo $value->url_store; ?>/<?php echo $value->logo_store; ?>" alt="img/stores/<?php echo $value->url_store; ?>/<?php echo $value->logo_store; ?>"></a><a class="ps-btn" href="<?php echo TemplateController::path().$value->url_store; ?>">Visit Store</a>

                                        </div>

                                        <h4><?php echo $value->name_store; ?></h4>

                                        <div class="br-wrapper br-theme-fontawesome-stars">

                                            <?php
                                               $select = "reviews_product";
                                               $url = CurlController::api()."products?linkTo=id_store_product&equalTo=".$value->id_store."&select=".$select;
                                               $dataReview = CurlController::request($url,$method,$headers,$fields);
                                               $reviews = 0;
                                               $totalReviews = 0;

                                               if($dataReview->status == 200){
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
                                            ?>

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

                                        </div>

                                        <p><?php echo $value->country_store." | ".$value->city_store." | ".$value->address_store ; ?></p>

                                        <ul class="ps-block__contact">

                                            <li>
                                                <i class="icon-envelope"></i>
                                                <a href="mailto:<?php echo $value->email_store; ?>"><?php echo $value->email_store; ?></a>
                                            </li>

                                            <li>
                                                <i class="icon-telephone"></i> (+<?php echo explode("_", $value->phone_store)[0]; ?>) <?php echo explode("_", $value->phone_store)[1]; ?>
                                            </li>

                                        </ul>

                                        <?php if($value->socialnetwork_store != null): ?>
                                            <figure>

                                                <ul class="ps-list--social-color">

                                                    <?php foreach(json_decode( $value->socialnetwork_store, true) as $index => $item): ?>
                                                        <li>
                                                            <a target="_blank" class="<?php  echo array_keys($item)[0]; ?>" href="<?php  echo $item[array_keys($item)[0]]; ?>">
                                                                <i class="fab fa-<?php  echo array_keys($item)[0]; ?>"></i></a>
                                                        </li>
                                                    <?php endforeach;?>

                                                </ul>

                                            </figure>
                                        <?php endif; ?>

                                    </div>

                                </article>

                            </div>
                        
                        <?php endforeach; ?>

                        </div>
                        <div class="ps-pagination">
                            <?php if (isset($urlParams[1])) {
                            $CurrentPage = $urlParams[1];
                            } else {
                                $CurrentPage = 1;
                            } ?>

                            <ul class="pagination" data-total-page="<?php echo ceil($totalStores / $endAt) ?>" data-current-page="<?php echo $CurrentPage; ?>" data-url-page="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                            </ul>
                        </div>
                    </div>

                    <?php endif; ?>
                </section>
            </div>
        </div>
    </div>
</section>
