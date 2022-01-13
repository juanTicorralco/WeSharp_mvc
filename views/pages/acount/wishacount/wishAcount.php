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
    }else{
        // traer la lista de deseos
        $select="url_product,url_category,name_product,image_product,price_product,offer_product,stock_product";
        $products= array();
        foreach($wishlist as $key => $value){  
            $url= CurlController::api()."relations?rel=products,categories&type=product,category&linkTo=url_product&equalTo=".$value."&select=".$select;
            $method= "GET";
            $header= array();
            $filds= array();
            $response= CurlController::request($url, $method, $header, $filds);
            array_push($products, $response->result[0]);
        }
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

                            <?php
                           foreach ($products as $key => $value):
                            ?>

                            <tr>

                                <td>
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/electronic/1.jpg" alt=""></a></div>
                                        <div class="ps-product__content"><a href="product-default.html"><?php echo $value->name_product; ?></a></div>
                                    </div>
                                </td>

                                <td class="price">$205.00</td>

                                <td><span class="ps-tag ps-tag--in-stock">In-stock</span></td>

                                <td><a class="ps-btn" href="#">Add to cart</a></td>

                                <td><a href="#"><i class="icon-cross"></i></a></td>

                            </tr>

                            <?php endforeach; ?>
                            
                        </tbody>

                    </table>

                </div>

            </div>


        </div>

    </div>

</div>