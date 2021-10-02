<?php
    $url= CurlController::api()."subcategories?orderBy=views_subcategory&orderMode=DESC&startAt=0&endAt=6";
    $method="GET";
    $field=array();
    $header=array();

    $bestSubcategory=CurlController::request($url, $method, $field, $header)->result;
?>
<div class="ps-top-categories">

    <div class="container">

        <h3>Top subcategories of the month</h3>

        <div class="row">

            <?php foreach($bestSubcategory as $key => $value): ?>
                <div class="col-xl-2 col-lg-3 col-sm-4 col-6 ">
                    <div class="ps-block--category">
                        <a class="ps-block__overlay" href="<?php echo $path.$value->url_subcategory; ?>"></a>
                        <img src="img/subcategories/<?php echo $value->url_subcategory; ?>/<?php echo $value->image_subcategory; ?>" alt="<?php echo $path.$value->name_subcategory; ?>">
                        <p><?php echo $value->name_subcategory; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

</div><!-- End Top Categories -->