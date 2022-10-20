<aside class="ps-block--store-banner">

    <div class="ps-block__user">

        <div class="ps-block__user-avatar">

            <?php if ($_SESSION["user"]->method_user == "direct") : ?>
                <?php if ($_SESSION["user"]->picture_user == "" || $_SESSION["user"]->picture_user == "NULL") : ?>
                    <img src="img/users/default/default.png" alt="<?php echo $_SESSION["user"]->username_user; ?>">
                <?php else : ?>
                    <img src="img/users/<?php echo $_SESSION["user"]->id_user; ?>/<?php echo $_SESSION["user"]->picture_user; ?>" alt="<?php echo $_SESSION["user"]->username_user; ?>">
                <?php endif; ?>
            <?php endif; ?>
            <div class="br-wrapper">

                <button class="btn btn-primary btn-lg rounded-circle" data-toggle="modal" data-target="#changePhoto"><i class="fas fa-pencil-alt"></i></button>

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

            <?php if ($_SESSION["user"]->method_user == "direct") : ?>
                <button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#changePassword">Cambiar Password</button>
            <?php endif; ?>

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

<!-- ventana modal -->
<!-- The Modal -->
<div class="modal" id="changePassword">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nueva Contraseña</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="ps-form--account ps-tab-root needs-validation" novalidate method="post">
                    <div class="form-group form-forgot">

                        <input class="form-control" type="password" name="newPassword" placeholder="Nuevo Password..." required pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}" onchange="validatejs(event, 'pass')">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">El nuevo password es requerido</div>
                    </div>

                    <div class="form-group submtit">

                        <?php
                        $newPass = new ControllerUser();
                        $newPass->actualiarContraseña();
                        ?>

                        <button type="submit" class="ps-btn ps-btn--fullwidth">Actualizar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Photo-->
<div class="modal" id="changePhoto">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nueva Foto</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="ps-form--account ps-tab-root needs-validation" novalidate method="post" enctype="multipart/form-data">
                    <small class="helsmall-block small">Dimensiones: 200px x 200px | Tamaño: 2MB | Formato: JPG o PNG</small>
                  
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile"  accept="image/*" maxSize="2000000" name="changePhoto" onchange="validateImageJs(event, 'changePhoto')" required>
                        <label for="customFile" class="custom-file-label">Buscar archivo</label>
                    </div>
                    <figure class="text-center py-3">
                        <img src="" class="img-fluid rounded-circle changePhoto" style="max-width: 150px;">
                    </figure>

                    <div class="form-group submtit">

                        <?php
                        $newphoto= new ControllerUser();
                        $newphoto->CambiarPhoto();
                        ?>

                        <button type="submit" class="ps-btn ps-btn--fullwidth">Actualizar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>