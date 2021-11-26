<?php if ($producter->reviews_product != null) {
    $allReview = json_decode($producter->reviews_product, true);
} else {
    $allReview = 0;
}
?>

<ul class="ps-tab-list">

    <li class="active"><a href="#tab-1">Descripcion</a></li>
    <li><a href="#tab-2">Detalles</a></li>
    <li><a href="#tab-3">Vendedor</a></li>
    <li><a href="#tab-4">Reseñas (<?php
                                    if ($producter->reviews_product != null) {
                                        echo count(json_decode($producter->reviews_product, true));
                                    } else {
                                        echo "0";
                                    }
                                    ?>)</a></li>
    <li><a href="#tab-5">Preguntas y respuestas</a></li>

</ul>

<div class="ps-tabs">

    <div class="ps-tab active" id="tab-1">

        <div class="ps-document">
            <?php echo $producter->description_product; ?>
        </div>

    </div>

    <div class="ps-tab" id="tab-2">

        <div class="table-responsive">

            <table class="table table-bordered ps-table ps-table--specification">

                <tbody>
                    <?php $details = json_decode($producter->details_product, true); ?>
                    <?php foreach ($details as $key => $value) : ?>
                        <tr>
                            <td><?php echo $value["title"]; ?></td>
                            <td><?php echo $value["value"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>

    </div>

    <div class="ps-tab" id="tab-3">

        <div class="media mb-5">
            <img class="mr-5 mt-1 rounded-circle" style="width: 120px;" src="img/stores/<?php echo $producter->url_store; ?>/<?php echo $producter->logo_store; ?>" alt="<?php echo $producter->name_store; ?>">
            <div class="media-body ml-3 ">
                <h5 class="mt-0"><?php echo $producter->name_store; ?></h5>
                <p> <?php echo $producter->about_store; ?></p>
            </div>
        </div>

        <a class="mt-3" href="<?php echo $path . $producter->url_store; ?>">Mas productos de la tienda</a>

    </div>

    <!-- RESEÑAS GLOBALES -->

    <div class="ps-tab" id="tab-4">

        <div class="row">

            <div class="col-lg-5 col-12 ">

                <div class="ps-block--average-rating">

                    <div class="ps-block__header">

                        <?php $promReview = TemplateController::calificationStars(json_decode($producter->reviews_product, true)); ?>

                        <h3><?php echo $promReview; ?>.00</h3>

                        <select class="ps-rating" data-read-only="true">

                            <!-- reseñas en estrellas -->
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

                        <!-- numero de reviciones -->
                        <span>(<?php
                                if ($producter->reviews_product != null) {
                                    echo count(json_decode($producter->reviews_product, true));
                                } else {
                                    echo "0";
                                }
                                ?> reseñas)
                        </span>

                    </div>

                    <?php if ($producter->reviews_product != null) : ?>
                        <!-- bloque de las estrellas -->
                        <?php if (count($allReview) > 0) {
                            /* bloque donde se almacenaran las estrellas */
                            $blockStart = array(
                                "1" => 0,
                                "2" => 0,
                                "3" => 0,
                                "4" => 0,
                                "5" => 0
                            );
                            $repReviews = array();
                            /* separamos las estrellas repetidas */
                            foreach ($allReview as $key => $value) {
                                array_push($repReviews, $value["review"]);
                            }

                            /* se unen las estrellas */
                            foreach ($blockStart as $key => $value) {
                                if (!empty(array_count_values($repReviews)[$key])) {
                                    $blockStart[$key] = array_count_values($repReviews)[$key];
                                }
                            }
                        } ?>

                        <?php for ($i = 5; $i > 0; $i--) : ?>
                            <div class="ps-block__star">

                                <span><?php echo $i; ?> Star</span>

                                <div class="ps-progress" data-value="<?php echo round($blockStart[$i] * 100 / count($allReview)); ?>">

                                    <span></span>

                                </div>

                                <span><?php echo round($blockStart[$i] * 100 / count($allReview)); ?>%</span>

                            </div>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>

                <hr class="mt-5">

                <div class="my-5">
                    <form class="ps-form--review">

                        <h4>Submit Your Review</h4>

                        <p>Your email address will not be published. Required fields are marked<sup>*</sup></p>

                        <div class="form-group form-group__rating">

                            <label>Your rating of this product</label>

                            <select class="ps-rating" data-read-only="false">

                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <textarea class="form-control" rows="6" placeholder="Write your review here">

                        </textarea>

                        </div>

                        <div class="form-group submit">

                            <button class="ps-btn">Submit Review</button>

                        </div>

                    </form>
                </div>
            </div>

            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                <!-- tomar 4 reseñas aleatoriamente -->
                <?php if ($producter->reviews_product != null) : ?>
                    <?php
                    $rand = array_rand($allReview, 4);
                    foreach ($rand as $key => $value) : ?>

                        <div class="media border p-3 mb-3">
                            <?php if (empty($allReview[$value]["user"])) : ?>
                                <img class="mr-5 mt-1 rounded-circle" style="width: 120px;" src="img/users/default/default.png" alt="<?php echo $producter->name_user; ?>">
                            <?php endif; ?>
                            <div class="media-body ml-3 ">

                                <?php if (empty($allReview[$value]["user"])) : ?>
                                    <h4 class="mt-0"><?php echo $producter->name_store; ?></h4>
                                <?php endif; ?>
                                <select class="ps-rating" data-read-only="true">

                                    <!-- reseñas en estrellas -->
                                    <?php
                                    if ($allReview[$value]["review"] > 0) {
                                        for ($i = 0; $i < 5; $i++) {
                                            if ($allReview[$value]["review"] < ($i + 1)) {
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

                                <p> <?php echo $allReview[$value]["comment"]; ?></p>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>

    </div>

    <div class="ps-tab" id="tab-5">

        <div class="ps-block--questions-answers">

            <h3>Questions and Answers</h3>

            <div class="form-group">

                <input class="form-control" type="text" placeholder="Have a question? Search for answer?">

            </div>

        </div>

    </div>

    <div class="ps-tab active" id="tab-6">

        <p>Sorry no more offers available</p>

    </div>

</div>