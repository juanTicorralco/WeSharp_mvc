<?php
if (!isset($_SESSION['user'])) {
    echo '<script>
            window.location="' . $path . '";
    </script>';
    return;
}else{
    $time= time();
    if($_SESSION["user"]->token_exp_user < $time){
        echo '<script>
        switAlert("error", "Para proteger tus datos, si no hay actividad en tu cuenta, se cierra automaticamente. Vuelve a logearte!", "' . $path . 'acount&logout","");
            
    </script>';
    return;
    }
}
?>
<!--=====================================
My Account Content
======================================-->

<div class="ps-vendor-dashboard pro">

    <div class="container">

        <div class="ps-section__header mt-0">

            <!--=====================================
            Profile
            ======================================-->

            <?php include "views/pages/acount/profile/profile.php"; ?>

            <!--=====================================
                Nav Account
                ======================================-->

            <div class="ps-section__content">

                <ul class="ps-section__links">
                    <li class="active"><a href=my-account_wishlist.html>My Wishlist</a></li>
                    <li><a href="my-account_my-shopping.html">My Shopping</a></li>
                    <li><a href="my-account_new-store.html">My Store</a></li>
                    <li><a href="my-account_my-sales.html">My Sales</a></li>
                </ul>

                <!--=====================================
                    Wishlist
                    ======================================-->

                <div class="table-responsive">

                    <table class="table ps-table--whishlist dt-responsive">

                        <thead>

                            <tr>

                                <th>Product name</th>

                                <th>Unit Price</th>

                                <th>Stock Status</th>

                                <th></th>

                                <th></th>

                            </tr>

                        </thead>

                        <tbody>

                            <!-- Product -->

                            <tr>

                                <td>
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/electronic/1.jpg" alt=""></a></div>
                                        <div class="ps-product__content"><a href="product-default.html">Marshall Kilburn Wireless Bluetooth Speaker, Black (A4819189)</a></div>
                                    </div>
                                </td>

                                <td class="price">$205.00</td>

                                <td><span class="ps-tag ps-tag--in-stock">In-stock</span></td>

                                <td><a class="ps-btn" href="#">Add to cart</a></td>

                                <td><a href="#"><i class="icon-cross"></i></a></td>

                            </tr>

                            <!-- Product -->

                            <tr>

                                <td>
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/clothing/2.jpg" alt=""></a></div>
                                        <div class="ps-product__content"><a href="product-default.html">Unero Military Classical Backpack</a></div>
                                    </div>
                                </td>

                                <td class="price">$108.00</td>

                                <td><span class="ps-tag ps-tag--in-stock">In-stock</span></td>

                                <td><a class="ps-btn" href="#">Add to cart</a></td>

                                <td><a href="#"><i class="icon-cross"></i></a></td>

                            </tr>

                            <!-- Product -->

                            <tr>

                                <td>
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/electronic/15.jpg" alt=""></a></div>
                                        <div class="ps-product__content"><a href="product-default.html">XtremepowerUS Stainless Steel Tumble Cloths Dryer</a></div>
                                    </div>
                                </td>

                                <td class="price">$508.00</td>

                                <td><span class="ps-tag ps-tag--out-stock">Out-stock</span></td>

                                <td></td>

                                <td><a href="#"><i class="icon-cross"></i></a></td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


        </div>

    </div>

</div>