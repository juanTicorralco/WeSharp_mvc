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
                    <li><a href="my-account_new-store.html">My Store</a></li>
                    <li><a href="my-account_my-sales.html">My Sales</a></li>
                </ul>

                <!--=====================================
                My Shopping
                ======================================--> 

                <div class="table-responsive">

                    <table class="table ps-table--whishlist dt-responsive" width="100%">

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

                            <tr>

                                <td>

                                    <div class="ps-product--cart">

                                        <div class="ps-product__thumbnail">

                                            <a href="product-default.html">
                                                <img src="img/products/electronic/1.jpg" alt="">
                                            </a>
                                            
                                        </div>

                                        <div class="ps-product__content">

                                            <a href="product-default.html">Marshall Kilburn Wireless Bluetooth Speaker, Black (A4819189)</a>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <ul class="timeline">
                                        <li class="success">                                             
                                            <h5>15 March, 2020</h5>
                                            <p class="text-success">Reviewed <i class="fas fa-check"></i></p>

                                            <div class="media border p-3">
                                            <div class="media-body">
                                                <h4><small><i>Dispute on march 17, 2020</i></small></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                            </div>
                                            <img src="img/vendor/store/user/5.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                            </div>

                                            <div class="media border p-3">

                                            <img src="img/vendor/vendor-store.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                            <div class="media-body text-right">
                                                <h4><small><i>Answer on march 17, 2020</i></small></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                            </div>
                                            
                                            </div>

                                        </li>
                                        <li  class="success">
                                            <h5>18 March, 2020</h5>         
                                            <p class="text-success">Sent <i class="fas fa-check"></i></p>
                                            <p>Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae <br><a href="#" target="_blank">ID TRACK A24S36343DWS4</a></p>
                                        </li>
                                        <li  class="success">
                                            <h5>23 March, 2020</h5>  
                                            <p class="text-success">Delivered <i class="fas fa-check"></i></p>
                                            <p>Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae necessitatibus nesciunt</p>
                                        </li>
                                    </ul>  

                                    <a class="btn btn-warning btn-lg" href="#">Repurchase</a>

                                </td> 

                                <td class="price text-center">$108.00</td>

                                <td class="text-center">2</td>

                                <td>

                                    <div class="text-center  mt-2">

                                        <div class="br-theme-fontawesome-stars">

                                            <select class="ps-rating" data-read-only="true" style="display: none;">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                            </select>

                                        </div>

                                        <a class="btn btn-warning btn-lg" href="#">Add comment</a>

                                    </div>

                                </td>

                            </tr>

                            <!-- Product -->

                            <tr>        

                                <td>

                                    <div class="ps-product--cart">

                                        <div class="ps-product__thumbnail">

                                            <a href="product-default.html">

                                                <img src="img/products/clothing/2.jpg" alt="">

                                            </a>
                                        </div>

                                        <div class="ps-product__content">

                                            <a href="product-default.html">Unero Military Classical Backpack</a>

                                        </div>

                                    </div>
                            
                                </td>

                                <td>

                                    <ul class="timeline">
                                        <li class="success">                                             
                                            <h5>15 March, 2020</h5>
                                            <p class="text-success">Reviewed <i class="fas fa-check"></i></p>
                                            <p>Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae necessitatibus nesciunt</p>
                                        </li>
                                        <li  class="success">
                                            <h5>18 March, 2020</h5>         
                                            <p class="text-success">Sent <i class="fas fa-check"></i></p>
                                            <p>Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae <br><a href="#" target="_blank">ID TRACK A24S36343DWS4</a></p>
                                        </li>
                                        <li  class="process">
                                            <h5>23 March, 2020</h5>  
                                            <p>Delivered</p>
                                            <button class="btn btn-primary" disabled>
                                            <span class="spinner-border spinner-border-sm"></span>
                                            In process
                                            </button>
                                        </li>
                                    </ul>

                                    <a class="btn btn-danger btn-lg" href="#">Open Dispute</a>

                                </td>


                                <td class="price text-center">$205.00</td>

                                <td class="text-center">1</td>

                                <td>

                                    <div class=" text-center mt-2">

                                        <div class="br-theme-fontawesome-stars">

                                            <select class="ps-rating" data-read-only="true" style="display: none;">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="1">5</option>
                                            </select>

                                        </div>

                                        <a class="btn btn-warning btn-lg disabled" href="#">Add comment</a>

                                    </div>

                                </td>

                            </tr>

                            <!-- Product -->

                            <tr>        

                                <td>

                                    <div class="ps-product--cart">

                                        <div class="ps-product__thumbnail">

                                            <a href="product-default.html">

                                                <img src="img/products/electronic/15.jpg" alt="">

                                            </a>
                                        </div>

                                        <div class="ps-product__content">

                                            <a href="product-default.html">XtremepowerUS Stainless Steel Tumble Cloths Dryer</a>

                                        </div>

                                    </div>
                            
                                </td>

                                <td>

                                    <ul class="timeline">
                                        <li class="process">                                             
                                            <h5>15 March, 2020</h5>
                                            <p class="text-danger">Reviewed <i class="fas fa-times"></i></p>

                                            <div class="media border p-3">
                                            <div class="media-body">
                                                <h4><small><i>Dispute on march 17, 2020</i></small></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                            </div>
                                            <img src="img/vendor/store/user/5.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                            </div>

                                            <div class="media border p-3">

                                            <img src="img/vendor/vendor-store.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                            <div class="media-body text-right">
                                                <h4><small><i>Answer on march 17, 2020</i></small></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                            </div>
                                            
                                            </div>

                                        </li>
                                        <li  class="process">
                                            <h5>18 March, 2020</h5>         
                                            <p class="text-danger">Sent <i class="fas fa-times"></i></p>
                                            <p>Comment: Order canceled</p>
                                        
                                        </li>
                                        <li  class="process">
                                            <h5>23 March, 2020</h5>  
                                            <p class="text-danger">Delivered <i class="fas fa-times"></i></p>
                                            <p>Comment: Order canceled</p>
                                            
                                        </li>
                                    </ul>

                                    <a class="btn btn-danger btn-lg" href="#">Open Dispute</a>

                                </td>


                                <td class="price text-center">$205.00</td>

                                <td class="text-center">1</td>

                                <td>

                                    <div class=" text-center mt-2">

                                        <div class="br-theme-fontawesome-stars">

                                            <select class="ps-rating" data-read-only="true" style="display: none;">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="1">5</option>
                                            </select>

                                        </div>

                                        <a class="btn btn-warning btn-lg disabled" href="#">Add comment</a>

                                    </div>

                                </td>

                            </tr>
        
                        </tbody>

                    </table>

                </div><!-- End My Shopping -->

            </div>


        </div>

    </div>

</div>