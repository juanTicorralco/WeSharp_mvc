<?php
if (!isset($_SESSION['user'])) {
    echo '<script>
    switAlert("error", "Debes logearte!", "' . $path . 'acount&logout","");
    </script>';
    return;
}else{
    $time= time();
    if($_SESSION["user"]->token_exp_user < $time){
        echo '<script>
        switAlert("error", "El token expiro vuelve a logearte", "' . $path . 'acount&logout","");
        </script>';
    return;
    }
}
?>

<!--=====================================
Breadcrumb
======================================-->  
	
    <div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="/">Home</a></li>

                <li><a href="<?php echo $path?>shopingBag">Carrito de compras</a></li>

                <li>Pagar</li>

            </ul>

        </div>

    </div>
<!--=====================================
Checkout
======================================--> 
    <div class="ps-checkout ps-section--shopping">

        <div class="container">

            <div class="ps-section__header">

                <h1>Checkout</h1>

            </div>

            <div class="ps-section__content">

                <form class="ps-form--checkout needs-validation" novalidate method="post">

                    <div class="row">

                        <div class="col-xl-7 col-lg-8 col-sm-12">

                            <div class="ps-form__billing-info">

                                <h3 class="ps-form__heading">Billing Details</h3>

                                <div class="form-group">

                                    <label>Nombre completo<sup>*</sup></label>

                                    <div class="form-group__content">

                                        <input class="form-control" type="text" value="<?php echo $_SESSION["user"]->displayname_user; ?>" readonly required>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El nombre es requerido</div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Email Address<sup>*</sup></label>

                                    <div class="form-group__content">

                                        <input class="form-control" type="email" value="<?php echo $_SESSION["user"]->email_user; ?>" readonly required>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El email es requerido</div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Country<sup>*</sup></label>

                                    <?php
                                        $data = file_get_contents("views/json/ciudades.json");
                                        $ciudades= json_decode($data, true);
                                    ?>

                                    <div class="form-group__content">

                                        <select 
                                            class="form-control select2" 
                                            onchange="changeContry(event)"
                                            required>
                                            <?php if($_SESSION["user"]->country_user != null): ?>
                                                <option value="<?php echo $_SESSION["user"]->country_user ?>_<?php echo explode("_",$_SESSION["user"]->phone_user)[0]?>"><?php echo $_SESSION["user"]->country_user ?></option>
                                            <?php else: ?>
                                                <option value>Select country</option>
                                            <?php endif; ?>
                                            <?php foreach($ciudades as $key => $value):?>
                                                <option value="<?php echo $value["name"] ?>_<?php echo $value["dial_code"] ?>"><?php echo $value["name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="valid-feedback"></div>
                                         <div class="invalid-feedback">El pais es requerido</div>

                                    </div>

                                </div>
                                
                                <div class="form-group">

                                    <label>City<sup>*</sup></label>

                                    <div class="form-group__content">

                                        <input 
                                        class="form-control" 
                                        type="text"
                                        pattern = "[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                                        onchange="validatejs(event, 'text')" 
                                        value="<?php echo $_SESSION["user"]->city_user; ?>" 
                                        required>
                                        <div class="valid-feedback"></div>
                                         <div class="invalid-feedback">La ciudad es requerida</div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Phone<sup>*</sup></label>

                                    <div class="form-group__content input-group">
                                        <?php if($_SESSION["user"]->phone_user != null): ?>

                                        <div class="input-group-append">
                                            <span class="input-group-text dialCode"><?php echo explode("_",$_SESSION["user"]->phone_user)[0]?></span>
                                        </div>

                                        <?php 
                                            $phone= explode("_", $_SESSION["user"]->phone_user)[1]; 
                                        ?>
                                        <?php else: ?>
                                            <div class="input-group-append">
                                            <span class="input-group-text dialCode">+--</span>
                                        </div>

                                        <?php $phone="" ?>
                                        <?php endif; ?>

                                        <input 
                                        class="form-control" 
                                        type="text" 
                                        pattern = "[-\\(\\)\\0-9 ]{1,}"
                                        onchange="validatejs(event, 'phone')"
                                        value="<?php echo $phone; ?>" 
                                        required>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">El telefono es requerido</div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Address<sup>*</sup></label>

                                    <div class="form-group__content">

                                        <input 
                                        class="form-control" 
                                        type="text" 
                                        pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                        onchange="validatejs(event, 'parrafo')"
                                        value="<?php echo $_SESSION["user"]->address_user; ?>" 
                                        required>
                                        <div class="valid-feedback"></div>
                                         <div class="invalid-feedback">La direccion es requerida</div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="ps-checkbox">

                                        <input class="form-control" type="checkbox" id="create-account">

                                        <label for="create-account">Save address?</label>

                                    </div>

                                </div>

                                <h3 class="mt-40"> Addition information</h3>

                                <div class="form-group">

                                    <label>Order Notes</label>

                                    <div class="form-group__content">

                                        <textarea 
                                         class="form-control" 
                                         pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                        onchange="validatejs(event, 'parrafo')"
                                         rows="7" 
                                         placeholder="Notes about your order, e.g. special notes for delivery.">
                                        </textarea>

                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Algunos caracteres no son validos</div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Notes order -->

                        <div class="col-xl-5 col-lg-4 col-sm-12">

                            <div class="ps-form__total">

                                <h3 class="ps-form__heading">Your Order</h3>

                                <div class="content">

                                    <div class="ps-block--checkout-total">

                                        <div class="ps-block__header d-flex justify-content-between">

                                            <p>Product</p>

                                            <p>Total</p>

                                        </div>

                                        <div class="ps-block__content">

                                            <table class="table ps-block__products">

                                                <tbody>

                                                    <tr>

                                                        <td>
                                                            <a href="#"> MVMTH Classical Leather Watch In Black ×1</a>
                                                            <p>Sold By:<strong>YOUNG SHOP</strong></p>
                                                        </td>

                                                        <td class="text-right">$57.99</td>

                                                    </tr>

                                                    <tr>

                                                        <td>
                                                            <a href="#"> Apple Macbook Retina Display 12” × 1</a>
                                                            <p>Sold By:<strong>ROBERT’S STORE</strong></p>
                                                        </td>

                                                        <td class="text-right">$625.50</td>

                                                    </tr>

                                                </tbody>

                                            </table>
                                            
                                            <h3 class="text-right">Total <span>$683.49</span></h3>

                                        </div>

                                    </div>

                                    <hr class="py-3">

                                    <div class="form-group">

                                        <div class="ps-radio">

                                            <input class="form-control" type="radio" id="pay-paypal" name="payment-method" value="paypal" checked>

                                            <label for="pay-paypal">Pay with paypal?  <span><img src="img/payment-method/paypal.jpg" class="w-50"></span></label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="ps-radio">

                                            <input class="form-control" type="radio" id="pay-payu" name="payment-method" value="payu">

                                            <label for="pay-payu">Pay with payu? <span><img src="img/payment-method/payu.jpg" class="w-50"></span></label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="ps-radio">

                                            <input class="form-control" type="radio" id="pay-mercadopago" name="payment-method" value="mercado-pago">

                                            <label for="pay-mercadopago">Pay with Mercado Pago? <span><img src="img/payment-method/mercado_pago.jpg" class="w-50"></span></label>

                                        </div>

                                    </div>

                                    <button type="submit" class="ps-btn ps-btn--fullwidth" href="checkout.html">Proceed to checkout</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
  