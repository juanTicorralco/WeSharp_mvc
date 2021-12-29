<header class="header header--mobile" data-sticky="true">

    <div class="header__top">

        <div class="header__left">

            <ul class="d-flex justify-content-center">
                <li><a href="#" target="_blank"><i class="fab fa-facebook-f mr-4"></i></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-instagram mr-4"></i></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-twitter mr-4"></i></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-youtube mr-4"></i></a></li>
            </ul>
        </div>

        <div class="header__right">

            <ul class="navigation__extra">

                <li><a href="#">Sell on MarketPlace</a></li>
                <li><a href="#">Store List</a></li>
                <li><i class="icon-telephone"></i> Hotline:<strong> 1-800-234-5678</strong></li>

                <li>

                    <div class="ps-dropdown language"><a href="#"><img src="img/template/en.png" alt="">English</a>

                        <ul class="ps-dropdown-menu">

                            <li><a href="#"><img src="img/template/es.png" alt=""> Español</a></li>

                        </ul>

                    </div>

                </li>

            </ul>

        </div>

    </div>

    <div class="navigation--mobile">

        <div class="navigation__left">

            <!--=====================================
				Menu Mobile
				======================================-->

            <div class="menu--product-categories">

                <div class="ps-shop__filter-mb mt-4" id="filter-sidebar">
                    <i class="icon-menu "></i>
                </div>

                <div class="ps-filter--sidebar">

                    <div class="ps-filter__header">
                        <h3>Categories</h3><a class="ps-btn--close ps-btn--no-boder" href="#"></a>
                    </div>

                    <div class="ps-filter__content">

                        <aside class="widget widget_shop">

                            <ul class="ps-list--categories">

                                <!-- filter the categories and subcategories -->
                                <?php foreach ($menuCategories as $key => $value) : ?>
                                    <li class="current-menu-item menu-item-has-children"><a href="<?php echo $path . $value->url_category; ?>"> <?php echo $value->name_category; ?> </a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                                        <ul class="sub-menu" style="display: none;">
                                            <?php

                                            $url = CurlController::api() . "subcategories?linkTo=id_category_subcategory&equalTo=" . rawurlencode($value->id_category) . "&select=url_subcategory,name_subcategory";
                                            $method = "GET";
                                            $field = array();
                                            $header = array();

                                            $menuSubcategories = CurlController::request($url, $method, $field, $header)->result;
                                            ?>
                                            <?php foreach ($menuSubcategories as $key => $value) : ?>

                                                <li class="current-menu-item "><a href="<?php echo $path . $value->url_subcategory; ?>"> <?php echo $value->name_subcategory; ?> </a>
                                                </li>

                                            <?php endforeach; ?>


                                        </ul>
                                    </li>

                                <?php endforeach; ?>
                            </ul>

                        </aside>

                    </div>

                </div>

            </div><!-- End menu-->

            <a class="ps-logo pl-3 pl-sm-5" href="/">
                <img src="img/template/logo_light.png" class="pt-3" alt="">
            </a>

        </div>

        <div class="navigation__right">

            <div class="header__actions">

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

                                    <a href="#"><img src="img/products/clothing/5.jpg" alt=""></a>

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
                                    <img class="rounded-circle" style="width: 40px;" src="img/users/default/default.png" alt="<?php echo $_SESSION["user"]->name_user; ?>">
                                <?php else : ?>
                                    <img class="rounded-circle" style="width: 40px;" src="img/users/<?php echo $_SESSION["user"]->id_user; ?>/<?php echo $_SESSION["user"]->picture_user; ?>" alt="<?php echo $_SESSION["user"]->name_user; ?>">
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


            </div>

        </div>

    </div>

    <!--=====================================
		Search
		======================================-->

    <div class="ps-search--mobile">

        <form class="ps-form--search-mobile" action="index.html" method="get">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>

    </div>

</header>