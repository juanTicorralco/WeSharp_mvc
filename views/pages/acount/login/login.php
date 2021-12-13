<!--=====================================
Login - Register Content
======================================-->

<div class="ps-my-account">

    <div class="container">

        <form class="ps-form--account ps-tab-root needs-validation" novalidate method="post">

            <ul class="ps-tab-list">

                <li>
                    <p><a href="<?php echo $path ?>acount&login">Mi Cuenta</a></p>
                </li>

                <li class="active">
                    <p><a href="<?php echo $path ?>acount&enrollment">Registrarse</a></p>
                </li>

            </ul>

            <div class="ps-tabs">

                <!--=====================================
                Login Form
                ======================================-->

                <div class="ps-tab active" id="sign-in">

                    <div class="ps-form__content">

                        <h5>Entrar a mi cuenta</h5>

                        <div class="form-group">

                            <input class="form-control" type="email" name="logEmail" placeholder="Email..." required pattern="[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" onchange="validatejs(event, 'email')">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">El email es requerido</div>
                        </div>

                        <div class="form-group form-forgot">

                            <input class="form-control" type="password" name="logPassword" placeholder="Password..." required pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}" onchange="validatejs(event, 'pass')">
                            <a href="">Forgot?</a>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">El password es requerido</div>

                        </div>

                        <div class="form-group">

                            <div class="ps-checkbox">

                                <input class="form-control" type="checkbox" id="remember-me" name="remember-me">

                                <label for="remember-me">Reconrdar</label>

                            </div>

                        </div>

                        <div class="form-group submtit">

                            <button type="submit" class="ps-btn ps-btn--fullwidth">Entrar</button>

                        </div>

                        <?php
                            $login= new ControllerUser();
                            $login->login();
                        ?>

                    </div>

                    <div class="ps-form__footer">

                        <p>Entrar a mi cuenta con:</p>

                        <ul class="ps-list--social">

                            <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a class="google" href="#"><i class="fab fa-google"></i></a></li>

                        </ul>

                    </div>

                </div><!-- End Login Form -->

            </div>

        </form>

    </div>

</div>