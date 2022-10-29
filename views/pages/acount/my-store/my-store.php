<?php
if (!isset($_SESSION['user'])) {
    echo '<script>
            window.location="' . $path . 'acount&login";
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
        // traer store
        // $select="url_product,url_category,name_product,image_product,price_product,offer_product,stock_product";
        // $products= array();
        // foreach($wishlist as $key => $value){  
        //     $url= CurlController::api()."relations?rel=products,categories&type=product,category&linkTo=url_product&equalTo=".$value."&select=".$select;
        //     $method= "GET";
        //     $header= array();
        //     $filds= array();
        //     $response= CurlController::request($url, $method, $header, $filds);
        //     array_push($products, $response->result[0]);
        // }
        // echo '<pre>'; print_r($shoppingOrder[0]); echo '</pre>';
    }
}
?>
<!--=====================================
My Account Content
======================================--> 

<div class="ps-vendor-dashboard pro">

    <div class="container">

        <div class="ps-section__header">

            <!--=====================================
            Profile
            ======================================--> 

            <?php include "views/pages/acount/profile/profile.php"; ?>

            <!--=====================================
            Nav Account
            ======================================--> 

            <div class="ps-section__content">

                <ul class="ps-section__links">
                    <li ><a href="<?php echo $path; ?>acount&wishAcount">My Wishlist</a></li>
                    <li ><a href="<?php echo $path; ?>acount&my-shopping">My Shopping</a></li>
                    <li class="active"><a href="<?php echo $path; ?>acount&my-store">My Store</a></li>
                    <li><a href="my-account_my-sales.html">My Sales</a></li>
                </ul>

                <!--=====================================
                My Store
                ======================================--> 
                <div class="ps-vendor-store">

                    <div class="container">

                        <div class="ps-section__container">

                            <!--=====================================
                            Vendor Profile
                            ======================================--> 

                            <?php include "modules/store.php"; ?>

                            <!--=====================================
                            Products
                            ======================================--> 

                           <?php include "modules/products.php"; ?>
                           
                        </div>
                    </div>
                </div>
                

            </div>


        </div>

    </div>

</div>

   