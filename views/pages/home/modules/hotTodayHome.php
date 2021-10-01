<?php 
/* bring all the products */
$today= date("Y-m-d");
$url=CurlController::api()."relations?rel=products,categories&type=product,category";
$method="GET";
$field=array();
$header=array();

$promotionToday=CurlController::request($url, $method, $field, $header)->result;

foreach($promotionToday as $key=>$value){
    /* we ask if the product bring offer and stock */
    if($value->offer_product==null || $value->stock_product==0){
        unset($promotionToday[$key]);
    }

    /* We ask if the offer date has not expired */
    if($value->offer_product!=null){
        if($today > json_decode($value->offer_product, true)[2]){
            unset($promotionToday[$key]);
        }
    }
}

/* if more than 10 products come to be displayed */
if(count($promotionToday)>10){
    $random= rand(0, (count($promotionToday)-10));
    $promotionToday= array_slice($promotionToday, $random, 10);

}

?>

<div class="ps-deal-hot">

    <div class="container">

        <div class="row">

            <!--=====================================
            Column Deal Hot
            ======================================-->

            <div class="col-xl-9 col-12 ">

                <div class="ps-block--deal-hot" data-mh="dealhot">

                    <div class="ps-block__header">

                        <h3>Deal hot today</h3>

                        <div class="ps-block__navigation">
                            <a class="ps-carousel__prev" href=".ps-carousel--deal-hot">
                                <i class="icon-chevron-left"></i>
                            </a>
                            <a class="ps-carousel__next" href=".ps-carousel--deal-hot">
                                <i class="icon-chevron-right"></i>
                            </a>
                        </div>

                    </div>

                    <div class="ps-product__content">

                        <div class="ps-carousel--deal-hot ps-carousel--deal-hot owl-slider" data-owl-auto="true"
                            data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false"
                            data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1"
                            data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">

                            <!--=====================================
                            Product Deal Home
                            ======================================-->

                            <?php foreach($promotionToday as $key => $value): 
                                //echo '<pre>'; print_r($value); echo '</pre>';?>
                                
                                <div class="ps-product--detail ps-product--hot-deal">

                                    <div class="ps-product__header">

                                        <div class="ps-product__thumbnail" data-vertical="true">

                                            <figure>

                                                <div class="ps-wrapper">

                                                    <div class="ps-product__gallery" data-arrow="true">
                                                    <?php 
                                                    $galeriProducts= json_decode( $value->gallery_product);
                                                    
                                                     foreach($galeriProducts as $key2 => $value2):
                                                    ?>
                                                        <div class="item">
                                                            <a href="img/products/<?php echo $value->url_category;?>/gallery/<?php echo $value2;?>">
                                                                <img src="img/products/<?php echo $value->url_category;?>/gallery/<?php echo $value2;?>" alt="<?php echo $value->name_category;?>">
                                                            </a>
                                                        </div>

                                                    <?php endforeach; ?>

                                                    </div>

                                                    <!-- offer of product -->
                                                    <?php $offer = json_decode($value->offer_product);?>
                                                    
                                                    <div class="ps-product__badge">
                                                        <span>Save <br> $<?php echo TemplateController::SavePrice($value->price_product, $offer[1], $offer[0] ) ;?></span>
                                                    </div>

                                                </div>

                                            </figure>

                                            <div class="ps-product__variants" data-item="4" data-md="3" data-sm="3"
                                                data-arrow="false">
                                                <?php
                                                foreach($galeriProducts as $key3 => $value3):
                                                ?>
                                                <div class="item">
                                                    <img src="img/products/<?php echo $value->url_category;?>/gallery/<?php echo $value3;?>" alt="<?php echo $value->name_category;?>">
                                                </div>
                                                <?php endforeach; ?>
                                            </div>

                                        </div>

                                        <div class="ps-product__info">

                                            <h5><?php echo $value->name_category;?></h5>

                                            <h3 class="ps-product__name">
                                                <a href="<?php echo $path.$value->url_product;?>">
                                                <strong><?php echo $value->name_product;?></strong>
                                            </a>
                                            </h3>

                                            <div class="ps-product__meta">

                                                <h4 class="ps-product__price sale">$<?php echo TemplateController::offerPrice($value->price_product, $offer[1], $offer[0]) ;?> <del> <?php echo $value->price_product;?></del></h4>

                                                <div class="ps-product__rating">

                                                <?php $reviews= TemplateController::calificationStars(json_decode($value->reviews_product, true));
                                                //echo '<pre>'; print_r($reviews); echo '</pre>'?>

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

                                                    <span>(<?php 
                                                    if($value->reviews_product!=null){
                                                    echo count(json_decode($value->reviews_product, true));}else{
                                                        echo "0";
                                                    }
                                                     ?> review)</span>

                                                </div>

                                                <div class="ps-product__specification">

                                                    <p>Status:<strong class="in-stock"> In Stock</strong></p>

                                                </div>

                                            </div>

                                            <div class="ps-product__expires">

                                                <p>Expires In</p>

                                                <ul class="ps-countdown" data-time="<?php echo $offer[2]; ?>">

                                                    <li><span class="days"></span>
                                                        <p>Days</p>
                                                    </li>

                                                    <li><span class="hours"></span>
                                                        <p>Hours</p>
                                                    </li>

                                                    <li><span class="minutes"></span>
                                                        <p>Minutes</p>
                                                    </li>

                                                    <li><span class="seconds"></span>
                                                        <p>Seconds</p>
                                                    </li>

                                                </ul>

                                            </div>

                                            <div class="ps-product__processs-bar">

                                                <div class="ps-progress" data-value="<?php echo $value->stock_product;?>">
                                                    <span class="ps-progress__value"></span>
                                                </div>

                                                <p><strong><?php echo $value->stock_product;?>/100</strong> Sold</p>

                                            </div>

                                        </div>

                                    </div>

                                </div><!-- End Product Deal Hot -->
                            <?php endforeach; ?>
                            

                        </div><!-- End carousel Deal Hot -->

                    </div><!-- End product content Deal Hot -->

                </div><!-- End deal hot -->

            </div><!-- End Columns -->

            <!--=====================================
            Column Top 20 Best Seller
            ======================================-->

            <div class="col-xl-3 col-12 ">

                <aside class="widget widget_best-sale" data-mh="dealhot">

                    <h3 class="widget-title">Top 20 Best Seller</h3>

                    <div class="widget__content">

                        <div class="owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000"
                            data-owl-gap="0" data-owl-nav="false" data-owl-dots="false" data-owl-item="1"
                            data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1"
                            data-owl-duration="1000" data-owl-mousedrag="on">

                            <div class="ps-product-group">

                                <!--=====================================
                                Product
                                ======================================-->

                                <div class="ps-product--horizontal">

                                    <div class="ps-product__thumbnail">
                                        <a href="product-default.html">
                                            <img src="img/products/technology/1.jpg" alt="">
                                        </a>
                                    </div>

                                    <div class="ps-product__content">

                                        <a class="ps-product__title" href="product-default.html">Sound Intone I65
                                            Earphone White Version</a>

                                        <div class="ps-product__rating">

                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select>

                                            <span>01</span>

                                        </div>

                                        <p class="ps-product__price">105.30</p>

                                    </div>

                                </div><!-- End Product -->

                                <!--=====================================
                                Product
                                ======================================-->

                                <div class="ps-product--horizontal">

                                    <div class="ps-product__thumbnail">

                                        <a href="product-default.html">
                                            <img src="img/products/technology/2.jpg" alt="">
                                        </a>

                                    </div>

                                    <div class="ps-product__content">

                                        <a class="ps-product__title" href="product-default.html">Beat Spill 2.0
                                            Wireless Speaker – White</a>

                                        <div class="ps-product__rating">

                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select>
                                            <span>01</span>

                                        </div>

                                        <p class="ps-product__price">$125.00 <del>$135.00 </del></p>

                                    </div>

                                </div><!-- End Product -->

                                <!--=====================================
                                Product
                                ======================================-->

                                <div class="ps-product--horizontal">

                                    <div class="ps-product__thumbnail">

                                        <a href="product-default.html">
                                            <img src="img/products/technology/3.jpg" alt="">
                                        </a>

                                    </div>

                                    <div class="ps-product__content">

                                        <a class="ps-product__title" href="product-default.html">ASUS Chromebook
                                            Flip – 10.2 Inch</a>

                                        <div class="ps-product__rating">

                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select>
                                            <span>02</span>

                                        </div>

                                        <p class="ps-product__price sale">$990.00 <del>$1250.00 </del></p>

                                    </div>

                                </div><!-- End Product -->

                                <!--=====================================
                                Product
                                ======================================-->

                                <div class="ps-product--horizontal">

                                    <div class="ps-product__thumbnail">
                                        <a href="product-default.html">
                                            <img src="img/products/technology/4.jpg" alt="">
                                        </a>
                                    </div>

                                    <div class="ps-product__content">
                                        <a class="ps-product__title" href="product-default.html">Apple Macbook
                                            Retina Display 12”</a>

                                        <div class="ps-product__rating">

                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select>

                                            <span>04</span>

                                        </div>

                                        <p class="ps-product__price">$1090.00 <del>$1550.00 </del></p>

                                    </div>

                                </div><!-- End Product -->

                            </div><!-- End Product Group -->

                            <div class="ps-product-group">

                                <!--=====================================
                                Product
                                ======================================-->

                                <div class="ps-product--horizontal">

                                    <div class="ps-product__thumbnail">
                                        <a href="product-default.html"><img src="img/products/technology/3.jpg"
                                                alt=""></a>
                                    </div>

                                    <div class="ps-product__content">

                                        <a class="ps-product__title" href="product-default.html">ASUS Chromebook
                                            Flip – 10.2 Inch</a>

                                        <div class="ps-product__rating">

                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select>

                                            <span>02</span>

                                        </div>

                                        <p class="ps-product__price sale">$990.00 <del>$1250.00 </del></p>

                                    </div>

                                </div><!-- End Product -->

                                <!--=====================================
                                Product
                                ======================================-->

                                <div class="ps-product--horizontal">

                                    <div class="ps-product__thumbnail">

                                        <a href="product-default.html">
                                            <img src="img/products/technology/4.jpg" alt="">
                                        </a>

                                    </div>

                                    <div class="ps-product__content">

                                        <a class="ps-product__title" href="product-default.html">Apple Macbook
                                            Retina Display 12”</a>

                                        <div class="ps-product__rating">

                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select>

                                            <span>04</span>
                                        </div>

                                        <p class="ps-product__price">$1090.00 <del>$1550.00 </del></p>

                                    </div>

                                </div><!-- End Product -->

                                <!--=====================================
                                Product
                                ======================================-->

                                <div class="ps-product--horizontal">

                                    <div class="ps-product__thumbnail">

                                        <a href="product-default.html">
                                            <img src="img/products/technology/5.jpg" alt="">
                                        </a>

                                    </div>

                                    <div class="ps-product__content">
                                        <a class="ps-product__title" href="product-default.html">Samsung Gear VR
                                            Virtual Reality Headset</a>

                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select>
                                            <span>01</span>
                                        </div>

                                        <p class="ps-product__price">$85.00</p>

                                    </div>

                                </div><!-- End Product -->

                                <!--=====================================
                                Product
                                ======================================-->

                                <div class="ps-product--horizontal">

                                    <div class="ps-product__thumbnail">
                                        <a href="product-default.html">
                                            <img src="img/products/technology/6.jpg" alt="">
                                        </a>
                                    </div>

                                    <div class="ps-product__content">
                                        <a class="ps-product__title" href="product-default.html">Apple iPhone Retina
                                            6s Plus 64GB</a>

                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select><span>01</span>
                                        </div>

                                        <p class="ps-product__price">$950.60</p>

                                    </div>

                                </div><!-- End Product -->

                            </div><!-- End Product Group -->

                        </div>

                    </div>

                </aside><!-- End Aside -->

            </div><!-- End Columns -->

        </div>

    </div>

</div><!-- End Home Deal Hot -->