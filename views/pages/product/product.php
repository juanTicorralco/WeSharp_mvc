<!-- traer toda la informacion del producto -->
<?php 
$url9= CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_product&equalTo=".$urlParams[0];
$method9= "GET";
$field9=array();
$header9= array();

$producter= CurlController::request($url9,$method9,$field9,$header9)->result[0];
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

                        <?php include "modules/infoProduct.php";?>

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

                    <p><i class="icon-network"></i> Shipping worldwide</p>

                    <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>

                    <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>

                    <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>

                </aside>

                <aside class="widget widget_sell-on-site">

                    <p><i class="icon-store"></i> Sell on MarketPlace?<a href="#"> Register Now !</a></p>

                </aside>

                <aside class="widget widget_same-brand">

                    <h3>Same Brand</h3>

                    <div class="widget__content">

                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                                <a href="product-default.html">
                                    <img src="img/products/shop/5.jpg" alt="">
                                </a>

                                <div class="ps-product__badge">-37%</div>

                                <ul class="ps-product__actions">

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
                                            <i class="icon-bag2"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
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

                                <a class="ps-product__vendor" href="#">Robert's Store</a>

                                <div class="ps-product__content">

                                    <a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>

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

                                    <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>

                                </div>

                                <div class="ps-product__content hover">

                                    <a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>

                                    <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>

                                </div>

                            </div>

                        </div>

                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                                <a href="product-default.html"><img src="img/products/shop/6.jpg" alt=""></a>

                                <div class="ps-product__badge">-5%</div>

                                <ul class="ps-product__actions">

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
                                            <i class="icon-bag2"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist">
                                            <i class="icon-heart"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare">
                                            <i class="icon-chart-bars"></i>
                                        </a>
                                    </li>

                                </ul>

                            </div>

                            <div class="ps-product__container">

                                <a class="ps-product__vendor" href="#">Youngshop</a>

                                <div class="ps-product__content">

                                    <a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>

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

                                    <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>

                                </div>

                                <div class="ps-product__content hover">

                                    <a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>

                                    <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>

                                </div>

                            </div>

                        </div>

                    </div>

                </aside>

            </div><!-- End Right Column -->

        </div><!--  End Product Container -->

        <!--=====================================
        Customers who bought
        ======================================--> 

        <div class="ps-section--default ps-customer-bought">

            <div class="ps-section__header">

                <h3>Customers who bought this item also bought</h3>

            </div>

            <div class="ps-section__content">

                <div class="row">

                    <div class="col-lg-2 col-md-4 col-6 ">

                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                                <a href="product-default.html">
                                    <img src="img/products/shop/4.jpg" alt="">
                                </a>

                                <div class="ps-product__badge hot">hot</div>

                                <ul class="ps-product__actions">

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
                                            <i class="icon-bag2"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
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

                                <a class="ps-product__vendor" href="#">Global Office</a>

                                <div class="ps-product__content">

                                    <a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>

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

                                    <p class="ps-product__price">$55.99</p>

                                </div>

                                <div class="ps-product__content hover">

                                    <a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>

                                    <p class="ps-product__price">$55.99</p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-2 col-md-4 col-6 ">

                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                                <a href="product-default.html">
                                    <img src="img/products/shop/5.jpg" alt="">
                                </a>

                                <div class="ps-product__badge">-37%</div>

                                <ul class="ps-product__actions">

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
                                            <i class="icon-bag2"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist">
                                            <i class="icon-heart"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare">
                                            <i class="icon-chart-bars"></i>
                                        </a>
                                    </li>

                                </ul>

                            </div>

                            <div class="ps-product__container">

                                <a class="ps-product__vendor" href="#">Robert's Store</a>

                                <div class="ps-product__content">

                                    <a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>

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

                                    <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>

                                </div>

                                <div class="ps-product__content hover">

                                    <a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>

                                    <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-2 col-md-4 col-6 ">

                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                                <a href="product-default.html"><img src="img/products/shop/6.jpg" alt=""></a>

                                <div class="ps-product__badge">-5%</div>

                                <ul class="ps-product__actions">

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist">
                                            <i class="icon-heart"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare">
                                            <i class="icon-chart-bars"></i>
                                        </a>
                                    </li>

                                </ul>

                            </div>

                            <div class="ps-product__container">

                                <a class="ps-product__vendor" href="#">Youngshop</a>

                                <div class="ps-product__content">

                                    <a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>

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

                                    <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>

                                </div>

                                <div class="ps-product__content hover">

                                    <a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>

                                    <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-2 col-md-4 col-6 ">

                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                                <a href="product-default.html">
                                    <img src="img/products/shop/7.jpg" alt="">
                                </a>

                                <div class="ps-product__badge">-16%</div>

                                <ul class="ps-product__actions">

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
                                            <i class="icon-bag2"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
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

                                <a class="ps-product__vendor" href="#">Youngshop</a>

                                <div class="ps-product__content">

                                    <a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>

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

                                    <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>

                                </div>

                                <div class="ps-product__content hover">

                                    <a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>

                                    <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-2 col-md-4 col-6 ">

                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                                <a href="product-default.html">
                                    <img src="img/products/shop/8.jpg" alt="">
                                </a>

                                <div class="ps-product__badge">-16%</div>

                                <ul class="ps-product__actions">

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
                                            <i class="icon-bag2"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
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

                                <a class="ps-product__vendor" href="#">Young shop</a>

                                <div class="ps-product__content">

                                    <a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>

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

                                    <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>

                                </div>

                                <div class="ps-product__content hover">

                                    <a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>

                                    <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-2 col-md-4 col-6">

                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                                <a href="product-default.html">
                                    <img src="img/products/shop/9.jpg" alt="">
                                </a>

                                <ul class="ps-product__actions">

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
                                            <i class="icon-bag2"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
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

                                <a class="ps-product__vendor" href="#">Young shop</a>

                                <div class="ps-product__content">

                                    <a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>

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

                                    <p class="ps-product__price">$35.89</p>

                                </div>

                                <div class="ps-product__content hover">

                                    <a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>

                                    <p class="ps-product__price">$35.89</p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div><!--  End Customers who bought -->

        <!--=====================================
        Related products
        ======================================--> 

        <div class="ps-section--default">

            <div class="ps-section__header">

                <h3>Related products</h3>

            </div>

            <div class="ps-section__content">

                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    <div class="ps-product">

                        <div class="ps-product__thumbnail">

                            <a href="product-default.html">
                                <img src="img/products/shop/11.jpg" alt="">
                            </a>

                            <ul class="ps-product__actions">

                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
                                        <i class="icon-bag2"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
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

                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Men’s Sports Runnning Swim Board Shorts</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price">$13.43</p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Men’s Sports Runnning Swim Board Shorts</a>
                                <p class="ps-product__price">$13.43</p>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/12.jpg" alt=""></a>
                            <ul class="ps-product__actions">
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Paul’s Smith Sneaker InWhite Color</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price">$75.44</p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Paul’s Smith Sneaker InWhite Color</a>
                                <p class="ps-product__price">$75.44</p>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/13.jpg" alt=""></a>
                            <div class="ps-product__badge">-7%</div>
                            <ul class="ps-product__actions">
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/14.jpg" alt=""></a>
                            <div class="ps-product__badge">-7%</div>
                            <ul class="ps-product__actions">
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Beat Spill 2.0 Wireless Speaker – White</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Beat Spill 2.0 Wireless Speaker – White</a>
                                <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/15.jpg" alt=""></a>
                            <ul class="ps-product__actions">
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">ASUS Chromebook Flip – 10.2 Inch</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price sale">$332.38</p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">ASUS Chromebook Flip – 10.2 Inch</a>
                                <p class="ps-product__price sale">$332.38</p>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/16.jpg" alt=""></a>
                            <div class="ps-product__badge">-7%</div>
                            <ul class="ps-product__actions">
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Apple Macbook Retina Display 12&quot;</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price sale">$1200.00 <del>$1362.99 </del></p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Apple Macbook Retina Display 12&quot;</a>
                                <p class="ps-product__price sale">$1200.00 <del>$1362.99 </del></p>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/17.jpg" alt=""></a>
                            <ul class="ps-product__actions">
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price">$599.00</p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                <p class="ps-product__price">$599.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/18.jpg" alt=""></a>
                            <ul class="ps-product__actions">
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price">$233.28</p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                <p class="ps-product__price">$233.28</p>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product">
                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/19.jpg" alt=""></a>
                            <ul class="ps-product__actions">
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                <div class="ps-product__rating">
                                    <select class="ps-rating" data-read-only="true">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="2">5</option>
                                    </select><span>01</span>
                                </div>
                                <p class="ps-product__price">$233.28</p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                <p class="ps-product__price">$233.28</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Related products -->

    </div>

</div><!-- End Product Content -->