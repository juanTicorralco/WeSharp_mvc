<?php
require_once "../controllers/curlController.php";
require_once "../controllers/templateController.php";

class ControllerDataTable{
    public function dataProducts(){
        if(!empty($_POST)){
            $draw = $_POST["draw"];
            $orderByColumIndex = $_POST["order"][0]["column"];
            $orderBy = $_POST["columns"][$orderByColumIndex]["data"];
            $orderType = $_POST["order"][0]["dir"];
            $start = $_POST["start"];
            $length = $_POST["length"];
            
            $select = "id_product";
            $url = CurlController::api()."products?linkTo=id_store_product&equalTo=".$_GET["idStore"]."&select=".$select;
            $method ="GET";
            $fields = array();
            $headers = array();
            
            $totalData = CurlController::request($url, $method, $fields, $headers);

            if($totalData->status == 200){
                $totalData = $totalData->total;
            
                $select = "id_product,feedback_product,state_product,image_product,name_product,url_product,name_category,name_subcategory,price_product,shipping_product,stock_product,delivery_time_product,offer_product,summary_product,specifications_product,details_product,description_product,gallery_product,top_banner_product,default_banner_product,horizontal_slider_product,vertical_slider_product,video_product,tags_product,views_product,sales_product,reviews_product,date_create_product,approval_product,url_category,title_list_product";

                if(!empty($_POST["search"]["value"])){
                    $linkTo = ["name_product","title_list_product","tags_product","name_category","name_subcategory","price_product"];
                    $search = str_replace(" ", "_", $_POST["search"]["value"]);

                    foreach($linkTo as $key => $value){
                        $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=".$value.",id_store_product&search=".$search.",".$_GET["idStore"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select; 
                        $searchProducts = CurlController::request($url,$method,$fields,$headers)->result;
                        if($searchProducts == "no found"){
                            $totalProducts = array();
                        }else{
                            $totalProducts = $searchProducts;
                            $recordsFiltered = count($totalProducts);
                            break;
                        }
                    }
                }else{

                    $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=id_store_product&equalTo=".$_GET["idStore"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select;
                    $totalProducts = CurlController::request($url, $method, $fields, $headers);
                    $recordsFiltered = $totalData;
                    if($totalProducts->status != 200){
                        echo '{
                            "draw": 0,
                            "recordsTotal": 0, 
                            "recordsFiltered":0,
                            "data":[]}';
                        return;
                    }
                    $totalProducts = $totalProducts->result;
                }

                if(count($totalProducts) == 0){
                    echo '{"data":[]}';
                    return;
                }

                $dataJson = '{
                    "draw": '.$draw.',
                    "recordsTotal":'.$totalData.',
                    "recordsFiltered":'.$recordsFiltered.',
                    "data":[';

                foreach($totalProducts as $key => $value){
                    $actions = "<div class='btn-group'>
                                    <a href='".TemplateController::path().$value->url_product."' target='_blank' class='btn btn-info rounded-circle mr-2'>
                                        <i class='fas fa-eye'></i>
                                    </a>
                                    <a href='".TemplateController::path()."acount&my-store?product=".$value->id_product."#vendor-store' class='btn btn-warning rounded-circle mr-2'>
                                        <i class='fas fa-pencil-alt'></i>
                                    </a> 
                                    <a type='button' class='btn btn-danger rounded-circle text-white' onclick='removesProducts(".$value->id_product.")'>
                                        <i class='fas fa-trash'></i>
                                    </a>
                                </div> ";
                    $actions = TemplateController::cleanhtml($actions);
                    
                    if($value->approval_product == "approved"){
                        $feedback = "<h4> <span class='badge badge-success'>Approved</span></h4>";
                    }else{
                        $feedback = "<h4> <span data-toggle='tooltip' title='".$value->feedback_product."' class='badge badge-warning'>".$value->approval_product."</span></h4>";
                    }
                    if($value->state_product == "show"){
                        $state = "<div class='custom-control custom-switch'><input type='checkbox' class='custom-control-input' id='switch".$key."' checked onchange='stateCheck(event,".$value->id_product.",".$key.")'><label class='custom-control-label' for='switch".$key."'></label></div>";
                    }else{
                        $state = "<div class='custom-control custom-switch'><input type='checkbox' class='custom-control-input' id='switch".$key."' onchange='stateCheck(event,".$value->id_product.",".$key.")'><label class='custom-control-label' for='switch".$key."'></label></div>";
                    }
                    $image_product = "<img src='img/products/".$value->url_category."/".$value->image_product."'>";
                    $name_product = $value->name_product;
                    $name_category = $value->name_category;
                    $name_subcategory = $value->name_subcategory;
                    $price_product = $value->price_product;
                    $shipping_product = $value->shipping_product;
                    $stock_product = $value->stock_product;
                    if($value->stock_product >= 50){
                        $stock_product = "<span class='badge badge-success p-2'>".$value->stock_product."</span>";
                    }elseif($value->stock_product < 50 && $value->stock_product > 20){
                        $stock_product = "<span class='badge badge-warning p-2'>".$value->stock_product."</span>";
                    }else{
                        $stock_product = "<span class='badge badge-danger p-2'>".$value->stock_product."</span>";
                    }

                    $delivery_time_product = $value->delivery_time_product;
                    
                    if($value->offer_product != null){
                        if(json_decode($value->offer_product, true)[0] == "Discount"){
                            $offer_product = "<span>".json_decode($value->offer_product, true)[1]."% | ".json_decode($value->offer_product, true)[2]."</span>";
                        }
                        if(json_decode($value->offer_product,true)[0] == "Fixed"){
                            $offer_product = "<span>$".json_decode($value->offer_product, true)[1]." | ".json_decode($value->offer_product, true)[2]."</span>";
                        }
                    }else{
                        $offer_product = "No offer";
                    }

                    $summary_product = "<div><ul class='list-group p-3'>";
                    foreach(json_decode($value->summary_product, true) as $item){
                        $summary_product .= "<li>".$item."</li>";
                    }
                    $summary_product .= "</ul></div>";

                    if($value->specifications_product != null){
                        $specifications_product = "<div class='ps-product__variations'>";
                        foreach(json_decode($value->specifications_product, true) as $item){
                            if(!empty(array_keys($item)[0])){
                                $specifications_product .= "<figure><figcaption>".array_keys($item)[0]."</figcaption></figure>";
                            }
                            foreach($item as $i){
                                foreach($i as $v){
                                    if(array_keys($item)[0] == "Color"){
                                        $specifications_product .= "<div class='ps-variant round-circle mr-3' style='background-color:".$v."; width:30px; height:30px; cursor:pointer; border:1px solid #bbb;'><span class='ps-variant__tooltip'>".$v."</span></div>";
                                    }else{
                                        $specifications_product .= "<div class='ps-variant ps-variant--size'><span class='ps-variant__tooltip'>".$v."</span><span class='ps-variant__size'>".substr($v,0,3)."</span></div>";
                                    }
                                }
                            }
                        }
                        $specifications_product .= "</div>"; 
                    }else{
                        $specifications_product = "No spesifications";
                    }

                    $details_product = "<table class='table table-bordered ps-table ps-table--specifications'><tbody>";
                    foreach(json_decode($value->details_product, true) as $item){
                        $details_product .= "<tr><td>".$item["title"]."</td><td>".$item["value"]."</td></tr>";
                    }
                    $details_product.= "</tbody></table>";

                    $description_product = TemplateController::cleanhtml($value->description_product);
                    $description_product = preg_replace("/\"/", "'", $description_product);

                    $gallery_product = "<div class='row'>";
                    foreach(json_decode($value->gallery_product, true) as $item){
                        $gallery_product .= "<figure class='col-3'><img src='img/products/".$value->url_category."/gallery/".$item."'></figure>";
                    }
                    $gallery_product .= "</div>"; 

                    $top_banner_product = "<div class='py-3'>
                                        <p><strong>H3 tag:</strong>".json_decode($value->top_banner_product,true)['H3 tag']."</p>
                                        <p><strong>P1 tag:</strong>".json_decode($value->top_banner_product,true)['P1 tag']."</p>
                                        <p><strong>H4 tag:</strong>".json_decode($value->top_banner_product,true)['H4 tag']."</p>
                                        <p><strong>P2 tag:</strong>".json_decode($value->top_banner_product,true)['P2 tag']."</p>
                                        <p><strong>Span tag:</strong>".json_decode($value->top_banner_product,true)['Span tag']."</p>
                                        <p><strong>Button tag:</strong>".json_decode($value->top_banner_product,true)['Button tag']."</p>
                                        <p><strong>IMG tag:</strong></p>
                                        <img src='img/products/".$value->url_category."/top/".json_decode($value->top_banner_product, true)['IMG tag']."' class='img-fluid'>
                                        </div>
                                        ";
                    $top_banner_product = TemplateController::cleanhtml($top_banner_product);

                    $default_banner_product = "<div><img src='img/products/".$value->url_category."/default/".$value->default_banner_product."' class='img-fluid py-3'></div>";

                    $horizontal_slider_product = "<div class='py-3'>
                                                <p><strong>H4 tag:</strong>".json_decode($value->horizontal_slider_product,true)['H4 tag']."</p>
                                                <p><strong>H3-1 tag:</strong>".json_decode($value->horizontal_slider_product,true)['H3-1 tag']."</p>
                                                <p><strong>H3-2 tag:</strong>".json_decode($value->horizontal_slider_product,true)['H3-2 tag']."</p>
                                                <p><strong>H3-3 tag:</strong>".json_decode($value->horizontal_slider_product,true)['H3-3 tag']."</p>
                                                <p><strong>H3-4s tag:</strong>".json_decode($value->horizontal_slider_product,true)['H3-4s tag']."</p>
                                                <p><strong>Button tag:</strong>".json_decode($value->horizontal_slider_product,true)['Button tag']."</p>
                                                <p><strong>IMG tag:</strong></p>
                                                <img src='img/products/".$value->url_category."/horizontal/".json_decode($value->horizontal_slider_product, true)['IMG tag']."' class='img-fluid'>
                                                </div>
                                                ";
                    $horizontal_slider_product = TemplateController::cleanhtml($horizontal_slider_product);
                    
                    $vertical_slider_product = "<div><img src='img/products/".$value->url_category."/vertical/".$value->vertical_slider_product."' class='img-fluid py-3'></div>";

                    if($value->video_product != null){
                        if(json_decode($value->video_product, true)[0] == "youtube"){
                            $video_product = "<iframe class='mb-3' src='https://www.youtube.com/embed/".json_decode($value->video_product)[1]."?rel=0&autoplay=0' height='360' frameborder='0' allowfullscreen></iframe>";
                        }else{
                            $video_product = "<iframe class='mb-3' src='https://player.vimeo.com/video/".json_decode($value->video_product)[1]."' height='360' frameborder='0' allowfullscreen></iframe>";
                        }
                    }else{
                        $video_product = "No video";
                    }

                    $tags_product = "";
                    foreach(json_decode($value->tags_product, true) as $item){
                        $tags_product .= $item.", ";
                    }
                    $tags_product = substr($tags_product, 0, -2);

                    $views_product = $value->views_product;

                    $sales_product = $value->sales_product;

                    $reviews = TemplateController::calificationStars(json_decode($value->reviews_product, true));
                    $reviews_product = "<div class='br-wrapper br-theme-fontawesome-stars'>
                                            <select class='ps-rating' data-read-only='true' style='display:none;'>";
                                            if ($reviews > 0) {
                                                for ($i = 0; $i < 5; $i++) {
                                                    if ($reviews < ($i + 1)) {
                                                        $reviews_product .= "<option value='1'>" . ($i + 1) . "</option>";
                                                    } else {
                                                        $reviews_product .= "<option value='2'>" . ($i + 1) . "</option>";
                                                    }
                                                }
                                            } else {
                                                $reviews_product .= "<option value='0'>0</option>";
                                                for ($i = 0; $i < 5; $i++) {
                                                    $reviews_product .= "<option value='1'>" . ($i + 1) . "</option>";
                                                }
                                            }
                    $reviews_product .= "</select>
                                        <div>
                                        <div class='br-widget br-readonly'>";
                                        if ($reviews > 0) {
                                            for ($i = 0; $i < 5; $i++) {
                                                if ($reviews < ($i + 1)) {
                                                    $reviews_product .= "<a data-rating-value='1' data-rating-text='".($i +1)."'></a>";
                                                } else {
                                                    $reviews_product .= "<a data-rating-value='2' data-rating-text='".($i +1)."' class='br-selected br-current'></a>";
                                                }
                                            }
                                        } else {
                                            for ($i = 0; $i < 5; $i++) {
                                                $reviews_product .= "<a data-rating-value='1' data-rating-text='".($i +1)."'></a>";
                                            }
                                        }
                    $reviews_product .= "<div class='br-current-rating'>".$reviews."</div>
                                    </div>";
                    $reviews_product = TemplateController::cleanhtml($reviews_product);

                    $date_create_product = $value->date_create_product;

                    $dataJson .= '{
                        "id_product":"'.($start+$key+1).'",
                        "actions": "'.$actions.'",
                        "feedback": "'.$feedback.'",
                        "state": "'.$state.'",
                        "image_product": "'.$image_product.'",
                        "name_product": "'.$name_product.'",
                        "name_category": "'.$name_category.'",
                        "name_subcategory": "'.$name_subcategory.'",
                        "price_product": "$'.$price_product.'",
                        "shipping_product": "$'.$shipping_product.'",
                        "stock_product": "'.$stock_product.'",
                        "delivery_time_product": "'.$delivery_time_product.' dias",
                        "offer_product": "'.$offer_product.'",
                        "summary_product": "'.$summary_product.'",
                        "specifications_product": "'.$specifications_product.'",
                        "details_product": "'.$details_product.'",
                        "description_product": "'.$description_product.'",
                        "gallery_product": "'.$gallery_product.'",
                        "top_banner_product": "'.$top_banner_product.'",
                        "default_bamer_product": "'.$default_banner_product.'",
                        "horizontal_slider_product": "'.$horizontal_slider_product.'",
                        "vertical_slider_product": "'.$vertical_slider_product.'",
                        "video_product": "'.$video_product.'",
                        "tags_product": "'.$tags_product.'",
                        "views_product": "'.$views_product.'",
                        "sales_product": "'.$sales_product.'",
                        "reviews_product": "'.$reviews_product.'",
                        "date_create_product": "'.$date_create_product.'"
                    },';
                }

                $dataJson = substr($dataJson, 0, -1);
                $dataJson .= ']}';
                echo $dataJson;
            }else{
                echo '{"
                    "draw": 0,
                    "recordsTotal": 0, 
                    "recordsFiltered":0,
                    data":[]}';
                return;
            }
            
        }
    }
}

$data = new ControllerDataTable();
$data -> dataProducts();
?>