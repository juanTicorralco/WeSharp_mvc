<!--=====================================
    Login - Register Content
    ======================================-->

<div class="ps-my-account">

    <div class="container">

        <form class="ps-form--account ps-tab-root needs-validation" novalidate method="post">

            <ul class="ps-tab-list">

                <li class="active">
                    <p><a href="<?php echo $path ?>acount&login">My Cuenta</a></p>
                </li>

                <li>
                    <p><a href="<?php echo $path ?>acount&enrollment">Registrarse</a></p>
                </li>

            </ul>

            <div class="ps-tabs">

            <input type="hidden" value="<?php echo CurlController::api(); ?>" id="urlApi">

                <!--=====================================
                    Register Form
                    ======================================-->

                <div class="ps-tab active" id="register">

                    <div class="ps-form__content">

                        <h5>Crear una cuenta</h5>

                        <div class="form-group">

                            <input class="form-control" type="text" name="createNombre" placeholder="Nombre..." required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validatejs(event, 'text')" >
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">El nombre es requerido</div>

                        </div>

                        <div class="form-group">

                            <input class="form-control" type="text" name="createApellido" placeholder="Apellido..." required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validatejs(event, 'text')" >
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">El apellido es requerido</div>

                        </div>

                        <div class="form-group">

                            <input class="form-control" type="email" name="createEmail" placeholder="Email..." required pattern="[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" onchange="emailRepeat(event)">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">El email es requerido</div>

                        </div>

                        <div class="form-group">

                            <input class="form-control" type="password" name="createPassword" placeholder="Password..." required pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}" onchange="validatejs(event, 'pass')">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">El password es requerido</div>

                        </div>

                        <div class="form-group submtit">

                            <button type="submit" class="ps-btn ps-btn--fullwidth">Registrarme</button>

                        </div>
                        <?php
                            $register= new ControllerUser();
                            $register->register();
                        ?>

                    </div>

                    <div class="ps-form__footer">

                        <p>Registrarme con:</p>

                        <ul class="ps-list--social">

                            <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a class="google" href="#"><i class="fab fa-google"></i></a></li>

                        </ul>

                    </div>

                </div><!-- End Register Form -->

            </div>

        </form>

    </div>

</div>