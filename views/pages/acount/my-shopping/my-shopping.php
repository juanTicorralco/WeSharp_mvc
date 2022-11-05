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
        // traer las ordenes
        $select="quantity_order,price_order,details_order,process_order,id_order,name_store,url_store,id_category_product,name_product,url_product,image_product,reviews_product";
        $url= CurlController::api()."relations?rel=orders,stores,products&type=order,store,product&linkTo=id_user_order&equalTo=".$_SESSION["user"]->id_user."&select=".$select."&orderBy=id_order&orderMode=DESC";
        $method= "GET";
        $header= array();
        $filds= array();
        $shoppingOrder= CurlController::request($url, $method, $header, $filds)->result;
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
                    <li class="active"><a href="<?php echo $path; ?>acount&my-shopping">My Shopping</a></li>
                    <li><a href="<?php echo $path; ?>acount&my-store">My Store</a></li>
                    <li><a href="my-account_my-sales.html">My Sales</a></li>
                </ul>

                <!--=====================================
                My Shopping
                ======================================--> 

                <div class="table-responsive">

                    <table class="table ps-table--whishlist dt-responsive dt-client" width="100%">

                        <thead>

                            <tr>      

                                <th>Product name</th>

                                <th>Proccess</th>

                                <th>Price</th>

                                <th>Quantity</th>

                                <th>Review</th>

                            </tr>

                        </thead>

                        <tbody>

                            <!-- Product -->
                            <?php if(isset($shoppingOrder) && $shoppingOrder != null && $shoppingOrder != "no found"): ?>
                                <?php foreach($shoppingOrder as $key => $value): ?>

                                    <tr>

                                        <td>

                                            <div class="ps-product--cart">

                                                <div class="ps-product__thumbnail">

                                                <?php
                                                    $url=CurlController::api()."categories?linkTo=id_category&equalTo=".$value->id_category_product."&select=url_category";
                                                    $method="GET";
                                                    $fields=array();
                                                    $headers=array();

                                                    $category= CurlController::request($url, $method, $fields, $headers)->result[0];
                                                ?>
                                                    <a href="<?php echo $path . $value->url_product; ?>">
                                                        <img src="img/products/<?php echo $category->url_category; ?>/<?php echo $value->image_product; ?>" alt="">
                                                    </a>
                                                    
                                                </div>

                                                <div class="ps-product__content">

                                                    <a href="<?php echo $path.$value->url_product?>"><?php echo $value->name_product; ?></a>
                                                    <div><a href="<?php echo $path.$value->url_store ?>"><small> <?php echo $value->name_store; ?></small></a></div>
                                                    
                                                    <small><?php echo json_decode($value->details_order)[0]; ?></small>
                                                </div>

                                            </div>

                                        </td>

                                        <td>
                                            <?php $processOrder = json_decode($value->process_order, true); ?>

                                            <ul class="timeline">

                                                <?php foreach($processOrder as $key => $item): ?>
                                                    <?php if($item["status"] == "ok"): ?>
                                                        <li class="success">                                             
                                                            <h5><?php echo $item["date"] ?></h5>
                                                            <p class="text-success"><?php echo $item["stage"]; ?> <i class="fas fa-check"></i></p>
                                                            <p>Comment: <?php echo $item["comment"] ?></p>
                                                        </li>
                                                    <?php else: ?>
                                                        <li class="process">                                             
                                                            <h5><?php echo $item["date"] ?></h5>
                                                            <p><?php echo $item["stage"]; ?></p>
                                                            <button class="btn btn-primary" disabled><span class="spinner-border spinner-border-sm"></span>In Process</button>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            
                                            </ul>  

                                            <?php if($processOrder[2]["status"] == "ok"): ?>
                                                <a class="btn btn-warning btn-lg" href="<?php echo $path.$value->url_product?>">Repurchase</a>
                                            <?php else: ?>
                                                <a class="btn btn-warning btn-lg" href="#">Open Dispute</a>

                                            <?php endif; ?>

                                        </td> 

                                        <td class="price text-center"><?php echo $value->price_order; ?></td>

                                        <td class="text-center"><?php echo $value->quantity_order; ?></td>

                                        <td>
                                        <div class="text-center  mt-2">
                                            <?php if($processOrder[2]["status"] == "ok"): ?>

                                                

                                                    <div class="br-theme-fontawesome-stars">

                                                    <?php $reviews = TemplateController::calificationStars(json_decode($value->reviews_product, true)); ?>

                                                        <select class="ps-rating" data-read-only="true" style="display: none;">
                                                        <?php
                                                                if ($reviews > 0) {
                                                                    for ($i = 0; $i < 5; $i++) {
                                                                        if ($reviews < ($i + 1)) {
                                                                            echo '<option value="1">' . $i + 1 . '</option>';
                                                                        } else {
                                                                            echo '<option value="2">' . $i + 1 . '</option>';
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo '<option value="0">0</option>';
                                                                    for ($i = 0; $i < 5; $i++) {
                                                                        echo '<option value="1">' . $i + 1 . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                        </select>

                                                    </div>

                                                    <a class="btn btn-warning btn-lg" href="#">Add comment</a>

                                                
                                            <?php else: ?>

                                                <a class="btn btn-warning btn-lg disabled" href="#">Add comment</a>

                                            <?php endif; ?>
                                        </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>
                            <?php endif; ?>
        
                        </tbody>

                    </table>

                </div><!-- End My Shopping -->

            </div>


        </div>

    </div>

</div>