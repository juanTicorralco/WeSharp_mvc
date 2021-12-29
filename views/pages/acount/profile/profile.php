<aside class="ps-block--store-banner">

    <div class="ps-block__user">

        <div class="ps-block__user-avatar">

            <?php if ($_SESSION["user"]->method_user == "direct") : ?>
                <?php if ($_SESSION["user"]->picture_user == "" || $_SESSION["user"]->picture_user == "NULL") : ?>
                    <img src="img/users/default/default.png" alt="<?php echo $_SESSION["user"]->name_user; ?>">
                <?php else : ?>
                    <img src="img/users/<?php echo $_SESSION["user"]->id_user; ?>/<?php echo $_SESSION["user"]->picture_user; ?>" alt="<?php echo $_SESSION["user"]->name_user; ?>">
                <?php endif; ?>
            <?php endif; ?>
            <div class="br-wrapper">

                <button class="btn btn-primary btn-lg rounded-circle"><i class="fas fa-pencil-alt"></i></button>

            </div>

            <div class="br-wrapper br-theme-fontawesome-stars mt-3">

                <select class="ps-rating" data-read-only="true" style="display: none;">
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>
                    <option value="2">5</option>
                </select>

            </div>

        </div>

        <div class="ps-block__user-content text-center text-lg-left">

            <h2 class="text-white"><?php echo $_SESSION["user"]->displayname_user; ?></h2>

            <p><i class="fas fa-user"></i> <?php echo $_SESSION["user"]->username_user; ?></p>

            <p><i class="fas fa-envelope"></i> <?php echo $_SESSION["user"]->email_user; ?></p>

            <button class="btn btn-warning btn-lg">Cambiar Password</button>

        </div>

        <div class="row ml-lg-auto pt-5">

            <div class="col-lg-3 col-6">
                <div class="text-center">
                    <a href="#">
                        <h1><i class="fas fa-shopping-cart text-white"></i></h1>
                        <h4 class="text-white">Orders <span class="badge badge-secondary rounded-circle">51</span></h4>
                    </a>
                </div>
            </div><!-- box /-->

            <div class="col-lg-3 col-6">
                <div class="text-center">
                    <a href="#">
                        <h1><i class="fas fa-shopping-bag text-white"></i></h1>
                        <h4 class="text-white">Products <span class="badge badge-secondary rounded-circle">51</span></h4>
                    </a>
                </div>
            </div><!-- box /-->

            <div class="col-lg-3 col-6">
                <div class="text-center">
                    <a href="#">
                        <h1><i class="fas fa-bell text-white"></i></h1>
                        <h4 class="text-white">Disputes <span class="badge badge-secondary rounded-circle">51</span></h4>
                    </a>
                </div>
            </div><!-- box /-->

            <div class="col-lg-3 col-6">
                <div class="text-center">
                    <a href="#">
                        <h1><i class="fas fa-comments text-white"></i></h1>
                        <h4 class="text-white">Messages <span class="badge badge-secondary rounded-circle">51</span></h4>
                    </a>
                </div>
            </div><!-- box /-->
        </div>

    </div>

</aside><!-- s -->