<?php  
    /* Bring the products of categories */
    $url4=CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&linkTo=url_category&equalTo=".$urlParams[0]."&orderBy=id_product&orderMode=DESC&startAt=0&endAt=7";
    $totalResultProducts= CurlController::request($url4, $method, $field, $header)->result;
    if(  $totalResultProducts =="no found"){
        /* Bring the products of categories */
        $url4=CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[0]."&orderBy=id_product&orderMode=DESC&startAt=0&endAt=7";
        $totalResultProducts= CurlController::request($url4, $method, $field, $header)->result;
    }
?>
<div class="ps-tabs">

    <!--=====================================
    Grid View
    ======================================--> 

    <div class="ps-tab active" id="tab-1">

        <div class="ps-shopping-product">

            <div class="row">

                <!--=====================================
                Product
                ======================================--> 

                <?php foreach($totalResultProducts as $key=>$value): ?>
                    <div class="col-lg-2 col-md-4 col-6">

                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                                <a href="<?php echo $path.$value->url_product; ?>">
                                    <img src="img/products/<?php echo $value->url_category; ?>/<?php echo $value->image_product; ?>" alt="<?php echo $value->name_product; ?>">
                                </a>

                                <?php if($value->stock_product!=0): ?>
                                <?php if($value->offer_product!=null ):?>
                                
                                <div class="ps-product__badge">-<?php echo TemplateController::percentOffer($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]) ; ?>%</div>
                                <?php endif; ?>
                                <?php else: ?>
                                <div class="ps-product__badge out-stock">Out Of Stock</div>
                                <?php endif; ?>

                                <ul class="ps-product__actions">

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                            <i class="icon-bag2"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo $path.$value->url_product; ?>" data-toggle="tooltip" data-placement="top" title="Quick View">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist">
                                            <i class="icon-heart"></i>
                                        </a>
                                    </li>

                                    

                                </ul>

                            </div>

                                <div class="ps-product__container">

                                    <a class="ps-product__vendor" href="<?php echo $path.$value->url_store; ?>"><?php echo $value->name_store; ?></a>

                                    <div class="ps-product__content">

                                    <a class="ps-product__title" href="<?php echo $path.$value->url_product; ?>">
                                    <?php echo $value->name_product; ?></a>

                                    <div class="ps-product__rating">
                                        <?php $reviews= TemplateController::calificationStars(json_decode($value->reviews_product, true));?>

                                        <select class="ps-rating" data-read-only="true">

                                            <?php 
                                            if($reviews>0){
                                                for($i=0;$i<5;$i++){
                                                    if($reviews<($i+1)){
                                                        echo '<option value="1">' . $i+1 . '</option>';
                                                    }else{
                                                        echo '<option value="2">' . $i+1 . '</option>';
                                                    }
                                                }
                                            }else{
                                                echo '<option value="0">0</option>';
                                                for($i=0;$i<5;$i++){
                                                    echo '<option value="1">' . $i+1 . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>

                                        <span>
                                            (<?php 
                                                if($value->reviews_product!=null){
                                                echo count(json_decode($value->reviews_product, true));}else{
                                                    echo "0";
                                                }
                                            ?>)
                                        </span>
                                    </div>

                                    <?php if($value->offer_product!=null):?>
                                        <p class="ps-product__price sale">$<?php echo TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]) ; ?> <del>$<?php echo $value->price_product; ?></del></p>
                                    <?php else: ?>
                                        <p class="ps-product__price">$<?php echo $value->price_product; ?></p>
                                    <?php endif; ?>

                                </div>

                                <div class="ps-product__content hover">

                                    <a class="ps-product__title" href="<?php echo $path.$value->url_product; ?>">
                                    <?php echo $value->name_product; ?></a>

                                    <?php if($value->offer_product!=null):?>
                                        <p class="ps-product__price sale">$<?php echo TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]) ; ?> <del>$<?php echo $value->price_product; ?></del></p>
                                    <?php else: ?>
                                        <p class="ps-product__price">$<?php echo $value->price_product; ?></p>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div><!-- End Product -->
                <?php endforeach; ?>

            </div>

        </div>

        <div class="ps-pagination">

            <ul class="pagination">
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li>
            </ul>

        </div>

    </div><!-- End Grid View-->

    <!--=====================================
    List View
    ======================================--> 

    <div class="ps-tab" id="tab-2">

        <div class="ps-shopping-product">

            <!--=====================================
            Product
            ======================================--> 

            <?php foreach($totalResultProducts as $key=>$value): ?>
                <div class="ps-product ps-product--wide">

                    <div class="ps-product__thumbnail">

                        <a href="<?php echo $path.$value->url_product; ?>">
                            <img src="img/products/<?php echo $value->url_category; ?>/<?php echo $value->image_product; ?>" alt="<?php echo $value->name_product; ?>">
                        </a>

                        <?php if($value->stock_product!=0): ?>
                        <?php if($value->offer_product!=null ):?>
                        
                        <div class="ps-product__badge">-<?php echo TemplateController::percentOffer($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]) ; ?>%</div>
                        <?php endif; ?>
                        <?php else: ?>
                        <div class="ps-product__badge out-stock">Out Of Stock</div>
                            <?php endif; ?>

                    </div>

                    <div class="ps-product__container">

                        <div class="ps-product__content">

                            <a class="ps-product__title" href="<?php echo $path.$value->url_product; ?>">
                            <?php echo $value->name_product; ?></a>

                            <p class="ps-product__vendor">Sold by:
                                <a href="<?php echo $path.$value->url_store; ?>"><?php echo $value->name_store; ?></a>
                            </p>

                            <div class="ps-product__rating">

                            <?php $reviews= TemplateController::calificationStars(json_decode($value->reviews_product, true));?>

                            <select class="ps-rating" data-read-only="true">

                                <?php 
                                if($reviews>0){
                                    for($i=0;$i<5;$i++){
                                        if($reviews<($i+1)){
                                            echo '<option value="1">' . $i+1 . '</option>';
                                        }else{
                                            echo '<option value="2">' . $i+1 . '</option>';
                                        }
                                    }
                                }else{
                                    echo '<option value="0">0</option>';
                                    for($i=0;$i<5;$i++){
                                        echo '<option value="1">' . $i+1 . '</option>';
                                    }
                                }
                                ?>

                            </select>

                            <span>
                                (<?php 
                                    if($value->reviews_product!=null){
                                    echo count(json_decode($value->reviews_product, true));}else{
                                        echo "0";
                                    }
                                ?> review)
                            </span>


                            </div>

                            <ul class="ps-product__desc">
                                <?php foreach(json_decode($value->summary_product) as $key2 => $value2): ?>
                                    <li> <?php echo $value2; ?> </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>

                        <div class="ps-product__shopping">

                             <?php if($value->offer_product!=null):?>
                                <p class="ps-product__price sale">$<?php echo TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]) ; ?> <del>$<?php echo $value->price_product; ?></del></p>
                            <?php else: ?>
                                <p class="ps-product__price">$<?php echo $value->price_product; ?></p>
                            <?php endif; ?>

                            <a class="ps-btn" href="#">Add to cart</a>

                            <ul class="ps-product__actions">
                                <li><a href="<?php echo $path.$value->url_product; ?>"><i class="icon-eye"></i>View</a></li>
                                <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                            </ul>

                        </div>

                    </div>

                </div> <!-- End Product -->
            <?php endforeach; ?>

        </div>

        <div class="ps-pagination">

            <ul class="pagination">

                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li>

            </ul>

        </div>

    </div>

</div>