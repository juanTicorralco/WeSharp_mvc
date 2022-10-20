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

                            <div class="ps-section__left">

                                <div class="ps-block--vendor">

                                    <div class="ps-block__thumbnail">

                                        <img src="img/vendor/vendor-store.jpg" alt="">

                                    </div>

                                    <div class="ps-block__container">

                                        <div class="ps-block__header">

                                            <h4>Digitalworld us</h4>

                                            <div class="br-wrapper br-theme-fontawesome-stars">

                                                <select class="ps-rating" data-read-only="true" style="display: none;">

                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>

                                                </select>

                                            </div>

                                            <p><strong>85% Positive</strong> (562 rating)</p>

                                        </div><span class="ps-block__divider"></span>

                                        <div class="ps-block__content">

                                            <p><strong>Digiworld US</strong>, New York’s no.1 online retailer was established in May 2012 with the aim and vision to become the one-stop shop for retail in New York with implementation of best practices both online...</p>

                                            <span class="ps-block__divider"></span>

                                            <p><strong>Address</strong> 325 Orchard Str, New York, NY 10002</p>
                                            
                                            <figure>

                                                <figcaption>Follow us on social</figcaption>

                                                <ul class="ps-list--social-color">

                                                    <li>
                                                        <a class="facebook" href="#">
                                                            <i class="fab fa-facebook"></i></a>
                                                    </li>

                                                    <li>
                                                        <a class="twitter" href="#">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="linkedin" href="#">
                                                            <i class="fab fa-linkedin"></i>
                                                        </a>
                                                    </li>


                                                </ul>

                                            </figure>

                                        </div>

                                        <div class="ps-block__footer">

                                            <p>Call us directly<strong><small>(+053) 77-637-3300</small></strong></p>

                                            <p>or Or if you have any question <strong><small>digitalworldus@gmail.com</small></strong></p>

                                            <a class="ps-btn ps-btn--fullwidth" href="">Edit</a>

                                        </div>

                                    </div>

                                </div>

                            </div><!-- End Vendor Profile -->

                            <!--=====================================
                            Products
                            ======================================--> 

                            <div class="ps-section__right">

                                
                                <div class="d-flex justify-content-between">
                                
                                    <div>
                                        <button class="btn btn-lg btn-warning my-3">Create new product</button>
                                    </div>
                                    
                                    <div>
                                        <ul class="nav nav-tabs">  

                                            <li class="nav-item">
                                                <a class="nav-link" href="#">About</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Orders</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Disputes</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Messages</a>
                                            </li>
                                            
                                        </ul>

                                    </div>

                                </div>

                                <table class="table dt-responsive" width="100%">
                                    
                                    <thead>

                                        <tr>   
                                            
                                            <th>#</th>   

                                            <th>Feedback</th>   

                                            <th>Cover Image</th>   

                                            <th>Product name</th>

                                            <th>Category</th>

                                            <th>Subcategory</th>

                                            <th>Price</th>

                                            <th>Shipping</th>

                                            <th>Stock</th>

                                            <th>Delivery time</th>

                                            <th>Offer</th>

                                            <th>End Offer</th>  

                                            <th>Specification</th>

                                            <th>Details</th>

                                            <th>Description</th>      

                                            <th>Gallery</th>

                                            <th>Top Banner</th>

                                            <th>Default Banner</th>

                                            <th>Horizontal Slider</th>

                                            <th>Vertical Slider</th>

                                            <th>Reviews</th>

                                            <th>Actions</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                    
                                        <tr>
                                            
                                            <td>1</td>

                                            <td>
                                                <h4> <span class="badge badge-success">Approved</span></h4>
                                            </td>

                                            <td>
                                                <img src="img/products/detail/countdown/4.jpg" alt="">
                                            </td>

                                            <td>Korea Long Sofa Fabric In Blue Navy Color</td>

                                            <td>Garden & Kitchen</td>

                                            <td>Furniture</td>

                                            <td>$679.80</td>

                                            <td>$5</td>

                                            <td><span class="badge badge-success p-2">100</span></td>

                                            <td>10 days</td>

                                            <td>Disccount: 25%</td>

                                            <td>2020-12-18</td>

                                            <td>

                                                

                                                <div class="ps-product__variations">

                                                    <ul class="list-group p-3">

                                                        <li class="list-group-item p-2"> Unrestrained and portable active stereo speaker</li>
                                                        <li class="list-group-item p-2"> Free from the confines of wires and chords</li>
                                                        <li class="list-group-item p-2"> 20 hours of portable capabilities</li>
                                                        <li class="list-group-item p-2"> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                        <li class="list-group-item p-2"> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>

                                                    </ul>

                                                    <figure class="ml-3">

                                                        <figcaption>Color: <strong> Choose an option</strong></figcaption>

                                                        <div class="ps-variant ps-variant--image">

                                                            <span class="ps-variant__tooltip">Blue</span>

                                                            <img src="img/products/detail/variants/small-1.jpg" alt="">

                                                        </div>

                                                        <div class="ps-variant ps-variant--image">

                                                            <span class="ps-variant__tooltip"> Dark</span>

                                                            <img src="img/products/detail/variants/small-2.jpg" alt="">

                                                        </div>

                                                        <div class="ps-variant ps-variant--image">

                                                            <span class="ps-variant__tooltip"> pink</span>

                                                            <img src="img/products/detail/variants/small-3.jpg" alt="">

                                                        </div>

                                                    </figure>

                                                    <figure class="ml-3">

                                                        <figcaption>Size <strong> Choose an option</strong></figcaption>

                                                        <div class="ps-variant ps-variant--size"><span class="ps-variant__tooltip">S</span><span class="ps-variant__size">S</span></div>
                                                        <div class="ps-variant ps-variant--size"><span class="ps-variant__tooltip"> M</span><span class="ps-variant__size">M</span></div>
                                                        <div class="ps-variant ps-variant--size"><span class="ps-variant__tooltip"> L</span><span class="ps-variant__size">L</span></div>

                                                    </figure>

                                                </div>

                        

                                            </td>

                                                <td>

                                                <table class="table table-bordered ps-table ps-table--specification">

                                                    <tbody>

                                                        <tr>
                                                            <td>Color</td>
                                                            <td>Black, Gray</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Style</td>
                                                            <td>Ear Hook</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Wireless</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dimensions</td>
                                                            <td>5.5 x 5.5 x 9.5 inches</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Weight</td>
                                                            <td>6.61 pounds</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Battery Life</td>
                                                            <td>20 hours</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bluetooth</td>
                                                            <td>Yes</td>
                                                        </tr>

                                                    </tbody>

                                                </table>

                                            </td>

                                            <td>
                                                <h5>Embodying the Raw, Wayward Spirit of Rock 'N' Roll</h5>

                                                <p>Embodying the raw, wayward spirit of rock ‘n’ roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p>

                                                <p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p>

                                                <img class="mb-30" src="img/products/detail/content/description.jpg" alt="">

                                                <h5>What do you get</h5>

                                                <p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p>

                                                <p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p>

                                                <p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement – the S6 had it, then the Note5 didn’t, and now with the S7 the trend is clear.</p>

                                                <h5>Perfectly Done</h5>

                                                <p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus there’s no annoying flap covering the charging port</p>
                                                
                                                <ul class="pl-0">
                                                    <li>No FM radio (except for T-Mobile units in the US, so far)</li>
                                                    <li>No IR blaster</li>
                                                    <li>No stereo speakers</li>
                                                </ul>

                                                <p>If you’ve taken the phone for a plunge in the bath, you’ll need to dry the charging port before plugging in. Samsung hasn’t reinvented the wheel with the design of the Galaxy S7, but it didn’t need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p>

                                            </td>

                                            

                                            <td>
                                                <div class="row">

                                                    <figure class="col-3">
                                                        <img src="img/products/detail/countdown/1.jpg" alt="">
                                                    </figure>
                                                    <figure class="col-3">
                                                        <img src="img/products/detail/countdown/2.jpg" alt="">
                                                    </figure>
                                                    <figure class="col-3">
                                                        <img src="img/products/detail/countdown/3.jpg" alt="">
                                                    </figure>
                                                </div>
                                            </td>

                                            <td>

                                                <p><strong>H3 tag:</strong> 20%</p>
                                                <p><strong>P1 tag:</strong> Discount</p>
                                                <p><strong>H4 tag:</strong> For Books Of March</p>
                                                <p><strong>P2 tag:</strong> Enter Promotion</p>
                                                <p><strong>Span tag:</strong> Sale2019</p>
                                                <p><strong>Button tag:</strong> Shop now</p>
                                                <p><strong>IMG tag:</strong></p>
                                                <img src="img/banner/top/header-promotion.jpg" alt="" class="img-fluid">

                                            </td>

                                            <td>
                                                <img src="img/banner/default/1.jpg" alt="" class="img-fluid">
                                            </td>

                                            <td>
                                        
                                                <p><strong>H4 tag:</strong> Limit Edition</p>
                                                <p><strong>H3-1 tag:</strong> HAPPY SUMMER</p>
                                                <p><strong>H3-2 tag:</strong> COMBO SUPER COOL</p>
                                                <p><strong>H3-3 tag:</strong> UP TO</p>
                                                <p><strong>H3-4s tag:</strong> 40%</p>
                                                
                                                <p><strong>Button tag:</strong> Shop now</p>
                                                <p><strong>IMG tag:</strong></p>

                                                <img src="img/slider/horizontal/1.jpg" alt="" class="img-fluid">
                                            </td>

                                            <td>
                                                <img src="img/slider/vertical/clothing-1.jpg" alt="" class="img-fluid">
                                            </td>

                                            <td>
                                            
                                                <div class="br-wrapper br-theme-fontawesome-stars">

                                                    <select class="ps-rating" data-read-only="true" style="display: none;">

                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>

                                                    </select>

                                                    <div class="br-widget br-readonly">

                                                        <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a>

                                                        <a href="#" data-rating-value="1" data-rating-text="2" class="br-selected br-current"></a>

                                                        <a href="#" data-rating-value="1" data-rating-text="3" class="br-selected br-current"></a>

                                                        <a href="#" data-rating-value="1" data-rating-text="4" class="br-selected br-current"></a>

                                                        <a href="#" data-rating-value="2" data-rating-text="5"></a>

                                                        <div class="br-current-rating">1</div>

                                                    </div>

                                                </div>

                                            </td>

                                            <td>
                                                <div class="btn-group">
                    
                                                    <button type="button" class="btn btn-warning rounded-circle mr-2">

                                                    <i class="fas fa-pencil-alt"></i>

                                                    </button>

                                                    <button type="button" class="btn btn-danger rounded-circle">

                                                    <i class="fas fa-trash"></i>

                                                    </button>

                                                </div>

                                            </td>

                                        </tr> 


                                    </tbody>

                                </table>
                                
                                    
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>


        </div>

    </div>

</div>

   