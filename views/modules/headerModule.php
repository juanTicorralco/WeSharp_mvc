<?php
$url = CurlController::api() . "categories?select=url_category,name_category,icon_category,title_list_category,id_category";
$method = "GET";
$field = array();
$header = array();

$menuCategories = CurlController::request($url, $method, $field, $header)->result;
/* echo '<pre>'; print_r($menuCategories); echo '</pre>'; */
?>

<header class="header header--standard header--market-place-4" data-sticky="true">

    <!--=====================================
Header TOP
======================================-->

    <div class="header__top">

        <div class="container">

            <!--=====================================
        Social 
        ======================================-->

            <div class="header__left">
                <ul class="d-flex justify-content-center">
                    <li><a href="#" target="_blank"><i class="fab fa-facebook-f mr-4"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-instagram mr-4"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-twitter mr-4"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-youtube mr-4"></i></a></li>
                </ul>
            </div>

            <!--=====================================
        Contact & lenguage 
        ======================================-->

            <div class="header__right">
                <ul class="header__top-links">
                    <li><a href="#">Sell on MarketPlace</a></li>
                    <li><a href="#">Store List</a></li>
                    <li><i class="icon-telephone"></i> Hotline:<strong> 1-800-234-5678</strong></li>
                    <li>
                        <div class="ps-dropdown language"><a href="#"><img src="img/template/en.png" alt="">English</a>
                            <ul class="ps-dropdown-menu">
                                <li><a href="#"><img src="img/template/es.png" alt=""> Spanish</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

        </div><!-- End Container -->

    </div><!-- Header Top -->

    <!--=====================================
Header Content
======================================-->

    <div class="header__content">

        <div class="container">

            <div class="header__content-left">

                <!--=====================================
            Logo
            ======================================-->

                <a class="ps-logo" href="/">
                    <img src="img/template/logo_light.png" alt="">
                </a>

                <!--=====================================
            Menú
            ======================================-->

                <div class="menu--product-categories">

                    <div class="menu__toggle">
                        <i class="icon-menu"></i>
                        <span> Shop by Department</span>
                    </div>

                    <div class="menu__content">
                        <ul class="menu--dropdown">

                            <?php foreach ($menuCategories as $key => $value) : ?>
                                <li class="menu-item-has-children has-mega-menu">
                                    <a href="<?php echo $path . $value->url_category; ?> "><i class="<?php echo $value->icon_category; ?> "></i>
                                        <?php echo $value->name_category; ?> </a>
                                    <div class="mega-menu">

                                        <?php $title_list = json_decode($value->title_list_category); ?>
                                        <?php foreach ($title_list as $key => $value) : ?>
                                            <div class="mega-menu__column">
                                                <h4><?php echo $value; ?> <span class="sub-toggle"></span></h4>
                                                <ul class="mega-menu__list">

                                                    <?php
                                                    $url = CurlController::api() . "subcategories?linkTo=title_list_subcategory&equalTo=" . rawurlencode($value) . "&select=url_subcategory,name_subcategory";
                                                    $method = "GET";
                                                    $field = array();
                                                    $header = array();

                                                    $menuSubcategories = CurlController::request($url, $method, $field, $header)->result;
                                                    //echo '<pre>'; print_r($menuSubcategories); echo '</pre>';
                                                    ?>

                                                    <?php foreach ($menuSubcategories as $key => $value) : ?>
                                                        <li><a href="<?php echo $path . $value->url_subcategory; ?>">
                                                                <?php echo $value->name_subcategory; ?> </a>
                                                        </li>
                                                    <?php endforeach; ?>

                                                </ul>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>

                </div><!-- End menu-->

            </div><!-- End Header Content Left-->

            <!--=====================================
        Search
        ======================================-->

            <div class="header__content-center">
                <form class="ps-form--quick-search">
                    <!--  <div class="form-group--icon">
                        <i class="icon-chevron-down"></i>
                        <select class="form-control">
                            <option value="1">All</option>
                            <option value="1">Smartphone</option>
                            <option value="1">Sounds</option>
                            <option value="1">Technology toys</option>
                        </select>
                    </div> -->
                    <input class="form-control inputSearch" type="text" placeholder="Buscar por...">
                    <button type="button" class="btnSearch" path="<?php echo $path; ?>">Buscar</button>
                </form>
            </div>

            <div class="header__content-right">

                <div class="header__actions">

                    <!--=====================================
                Wishlist
                ======================================-->

                    <a class="header__extra" href="#">
                        <i class="icon-heart"></i><span><i>0</i></span>
                    </a>

                    <!--=====================================
                Cart
                ======================================-->

                    <div class="ps-cart--mini">

                        <a class="header__extra" href="#">
                            <i class="icon-bag2"></i><span><i>0</i></span>
                        </a>

                        <div class="ps-cart__content">

                            <div class="ps-cart__items">

                                <div class="ps-product--cart-mobile">

                                    <div class="ps-product__thumbnail">
                                        <a href="#">
                                            <img src="img/products/clothing/7.jpg" alt="">
                                        </a>
                                    </div>

                                    <div class="ps-product__content">
                                        <a class="ps-product__remove" href="#">
                                            <i class="icon-cross"></i>
                                        </a>
                                        <a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                        <p><strong>Sold by:</strong> YOUNG SHOP</p>
                                        <small>1 x $59.99</small>
                                    </div>

                                </div>

                                <div class="ps-product--cart-mobile">

                                    <div class="ps-product__thumbnail">
                                        <a href="#">
                                            <img src="img/products/clothing/5.jpg" alt="">
                                        </a>
                                    </div>

                                    <div class="ps-product__content">
                                        <a class="ps-product__remove" href="#">
                                            <i class="icon-cross"></i>
                                        </a>
                                        <a href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                        <p><strong>Sold by:</strong> YOUNG SHOP</p>
                                        <small>1 x $59.99</small>
                                    </div>

                                </div>

                            </div>

                            <div class="ps-cart__footer">

                                <h3>Sub Total:<strong>$59.99</strong></h3>
                                <figure>
                                    <a class="ps-btn" href="shopping-cart.html">View Cart</a>
                                    <a class="ps-btn" href="checkout.html">Checkout</a>
                                </figure>

                            </div>

                        </div>

                    </div>

                    <?php if (isset($_SESSION["user"])) : ?>
                        <!--=====================================
                Login and Register dentro
                ======================================-->

                        <div class="ps-block--user-header">
                            <div class="ps-block__left">
                                <?php if ($_SESSION["user"]->method_user == "direct") : ?>
                                    <?php if ($_SESSION["user"]->picture_user == "" || $_SESSION["user"]->picture_user == "NULL") : ?>
                                        <img class="rounded-circle" style="width: 50px;" src="img/users/default/default.png" alt="<?php echo $_SESSION["user"]->name_user; ?>">
                                    <?php else : ?>
                                        <img class="rounded-circle" style="width: 50px;" src="img/users/<?php echo $_SESSION["user"]->id_user; ?>/<?php echo $_SESSION["user"]->picture_user; ?>" alt="<?php echo $_SESSION["user"]->username_user; ?>">
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="ps-block__right">
                                <a href="<?php echo $path ?>acount&wishAcount"><?php echo $_SESSION["user"]->displayname_user; ?></a>
                                <a href="<?php echo $path ?>acount&logout">Salir</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <!--=====================================
                Login and Register fuera
                ======================================-->

                        <div class="ps-block--user-header">
                            <div class="ps-block__left">
                            <a href="<?php echo $path ?>acount&login"><i class="icon-user"></i></a>
                            </div>
                            <div class="ps-block__right">
                                <a href="<?php echo $path ?>acount&login">Mi cuenta</a>
                                <a href="<?php echo $path ?>acount&enrollment">Registrarse</a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div><!-- End Header Actions-->

            </div><!-- End Header Content Right-->

        </div><!-- End Container-->

    </div><!-- End Header Content-->

</header>