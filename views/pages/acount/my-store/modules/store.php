<?php
    $select = "id_store,name_store,url_store,logo_store,cover_store,about_store,abstract_store,email_store,country_store,city_store,address_store,phone_store,socialnetwork_store,map_store,reviews_product";
    $url = CurlController::api()."relations?rel=products,stores&type=product,store&linkTo=id_user_store&equalTo=".$_SESSION["user"]->id_user."&select=".$select;
    $method = "GET";
    $fields = array();
    $headers = array();
    $storeResult = CurlController::request($url,$method,$fields,$headers)->result;
    $reviews = 0;
    $totalreviews = 0;
?>
<div class="ps-section__left">

    <div class="ps-block--vendor">

        <div class="ps-block__thumbnail">

            <img src="img/stores/<?php echo $storeResult[0]->url_store; ?>/<?php echo $storeResult[0]->logo_store; ?>" alt="<?php echo $storeResult[0]->name_store; ?>">

        </div>

        <div class="ps-block__container">

            <div class="ps-block__header">

                <h4><?php echo $storeResult[0]->name_store; ?></h4>

                <div class="br-wrapper br-theme-fontawesome-stars">
                    
                    <?php
                        foreach($storeResult as $item){
                            if($item->reviews_product != null){
                                foreach(json_decode($item->reviews_product, true) as $key => $value){
                                    $reviews += $value["review"];
                                    $totalreviews++;
                                }
                            }
                        }
                        if($reviews>0 && $totalreviews>0){
                            $reviews = round($reviews/$totalreviews);
                        }
                    ?>


                    <select class="ps-rating" data-read-only="true" style="display: none;">

                       <?php
                        if($reviews > 0){
                            for($i = 0; $i < 5; $i++){
                                if($reviews < ($i + 1)){
                                    echo '<option value="1">'.($i+1).'</option>';
                                }else{
                                    echo '<option value="2">'.($i+1).'</option>';
                                }
                            }
                        }else{
                            echo '<option value="0">0</option>';
                            for($i = 0; $i < 5; $i++){
                                echo '<option value="1">'.($i+1).'</option>';
                            }
                        }
                       ?>

                    </select>

                </div>

                <p><strong><?php echo ($reviews*100)/5; ?>% Positive</strong> (<?php echo $totalreviews; ?> rating)</p>

            </div><span class="ps-block__divider"></span>

            <div class="ps-block__content">

                <p><strong><?php echo $storeResult[0]->name_store; ?></strong> <?php echo $storeResult[0]->abstract_store; ?></p>

                <span class="ps-block__divider"></span>

                <p><strong>Address</strong> <?php echo $storeResult[0]->country_store . ", " . $storeResult[0]->city_store . ", " . $storeResult[0]->address_store; ?></p>

                <!-- mandar el map -->
                <?php if(isset( $storeResult[0]->map_store) && $storeResult[0]->map_store != null):?>
                <p><strong>Mapa</strong></p>

                <div id="myMap" class="mb-5" style="height: 400px"></div>
                <div id="mappp" class="mappp mb-5"  style="display: none" <?php 
                    if(isset( $storeResult[0]->map_store) && $storeResult[0]->map_store != null){
                        echo  'data-value =' . $storeResult[0]->map_store;
                    }
                    ?>>
                </div>
                <?php endif;?>
                   
                <?php if($storeResult[0]->socialnetwork_store != null): ?>
                <figure>

                    <figcaption>Follow us on social</figcaption>

                    <ul class="ps-list--social-color">

                        <?php foreach(json_decode( $storeResult[0]->socialnetwork_store, true) as $key => $value): ?>
                            <li>
                                <a target="_blank" class="<?php  echo array_keys($value)[0]; ?>" href="<?php  echo $value[array_keys($value)[0]]; ?>">
                                    <i class="fab fa-<?php  echo array_keys($value)[0]; ?>"></i></a>
                            </li>
                        <?php endforeach;?>

                    </ul>

                </figure>
                <?php endif; ?>

            </div>

            <div class="ps-block__footer">

                <p>Call us directly<strong><small><?php echo "(".explode("_", $storeResult[0]->phone_store)[0].")"." ".explode("_", $storeResult[0]->phone_store)[1]; ?></small></strong></p>

                <p>or Or if you have any question <strong><small><?php echo $storeResult[0]->email_store; ?></small></strong></p>

                <a class="ps-btn ps-btn--fullwidth" href="">Edit</a>

            </div>

        </div>

    </div>

</div><!-- End Vendor Profile -->