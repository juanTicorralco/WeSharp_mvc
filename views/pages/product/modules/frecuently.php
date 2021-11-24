<?php
    $url10 = CurlController::api() . "relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=title_list_product&equalTo=" . $producter->title_list_product;
    $method10 = "GET";
    $field10 = array();
    $header10 = array();

    $newProduct = CurlController::request($url10, $method10, $field10, $header10)->result;
?>
<?php if(count($newProduct)>1): ?>
<div class="ps-block--bought-toggether">

    <h4>Frecuentemente se compran juntos</h4>

    <div class="ps-block__content">

        <div class="ps-block__items">

            <!-- producto actual -->
            <div class="ps-block__item">

                <div class="ps-product ps-product--simple">

                    <div class="ps-product__thumbnail">

                        <!-- imagen del producto -->
                        <img src="img/products/<?php echo $producter->url_category; ?>/<?php echo $producter->image_product; ?>" alt="<?php echo $producter->name_product ?>">

                    </div>

                    <div class="ps-product__container">

                        <div class="ps-product__content">
                            <a class="ps-product__title" href="#"><?php echo $producter->name_product ?></a>

                            <!-- precio  -->
                            <?php if ($producter->offer_product != null) : ?>
                                <p class="ps-product__price sale text-success">$<?php 
                                    
                                    $price1=TemplateController::offerPrice($producter->price_product, json_decode($producter->offer_product, true)[1], json_decode($producter->offer_product, true)[0]); 
                                    echo $price1;
                                    ?> <del>$<?php echo $producter->price_product; ?></del></p>
                            <?php else : ?>
                                <p class="ps-product__price">$<?php 
                                    $price1=$producter->price_product; 
                                    echo $price1; ?></p>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

            <!-- producto nuevo -->

            <?php foreach ($newProduct as $key => $value) : ?>
                <?php if ($value->id_product != $producter->id_product) : ?>
                    <div class="ps-block__item">

                        <div class="ps-product ps-product--simple">

                            <div class="ps-product__thumbnail">

                                <!-- imagen del producto -->
                                <img src="img/products/<?php echo $value->url_category; ?>/<?php echo $value->image_product; ?>" alt="<?php echo $value->name_product ?>">

                            </div>

                            <div class="ps-product__container">

                                <div class="ps-product__content">

                                    <a class="ps-product__title" href="#"><?php echo $value->name_product ?></a>

                                    <!-- precio  -->
                                    <?php if ($value->offer_product != null) : ?>
                                        <p class="ps-product__price sale text-success">$<?php 
                                            $price2= TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); 
                                            echo $price2;
                                            ?> <del>$<?php echo $value->price_product; ?></del></p>
                                    <?php else : ?>
                                        <p class="ps-product__price">$<?php 
                                            $price2= $value->price_product;
                                            echo $price2; ?></p>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="ps-block__item ps-block__total">

                        <p >Total Precio:<strong class="text-success"> $<?php echo $price1 + $price2 ?></strong></p>

                        <a class="ps-btn" href="#">Add All to cart</a>
                        <a class="ps-btn ps-btn--gray ps-btn--outline" href="#">Add All to whishlist</a>

                    </div>

        </div>

    </div>

</div>
<?php return; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>