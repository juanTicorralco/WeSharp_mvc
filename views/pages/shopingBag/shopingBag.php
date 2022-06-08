<?php
if(isset($_COOKIE["listSC"])){
    $shoppingBag= json_decode($_COOKIE["listSC"], true);
    $select= "url_product,url_category,name_product,image_product,price_product,offer_product,stock_product,name_store,shipping_product";
    $productsSC= array();
    $totalSC = count($shoppingBag);

    foreach($shoppingBag as $key => $value){
        $url= CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&linkTo=url_product&equalTo=".$value["product"]."&select=".$select;
        $method = "GET";
        $fields=array();
        $header= array();

        array_push($productsSC, CurlController::request($url,$method,$fields,$header)->result[0]);
    }
}else{
    $productsSC=0;
}

?>
<!--=====================================
Breadcrumb
======================================-->  

<div class="ps-breadcrumb">

    <div class="container">

        <ul class="breadcrumb">

            <li><a href="/">Home</a></li>

            <li>Shopping cart</li>

        </ul>

    </div>

</div>

<!--=====================================
Shopping Car
======================================--> 

<div class="ps-section--shopping ps-shopping-cart">

    <div class="container">

        <div class="ps-section__header">

            <h1>Carrito de compras</h1>

        </div>

        <div class="ps-section__content">

            <div class="table-responsive">

                <table class="table ps-table--shopping-cart dt-responsive pr-5">

                    <thead>

                        <tr>

                            <th>NOMBRE DEL PRODUCTO</th>
                            <th>PRECIO</th>
                            <th>ENVIO</th>
                            <th>CANTIDAD</th>
                            <th>TOTAL</th>
                            <th></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if($productsSC!=0): ?>
                            <?php foreach($productsSC as $key => $value): ?>

                                <tr>
                                    <td>

                                        <div class="ps-product--cart">

                                            <div class="ps-product__thumbnail">

                                                <a href="<?php echo $path . $value->url_product; ?>">
                                                    <img src="img/products/<?php echo $value->url_category; ?>/<?php echo $value->image_product; ?>" alt="<?php echo $value->name_product; ?>">
                                                </a>

                                            </div>

                                            <div class="ps-product__content">

                                                <a href="<?php echo $path . $value->url_product; ?>"><?php echo $value->name_product ?></a>

                                                <div class="small text-secondary listtSC" url="<?php echo $value->url_product; ?>" details='<?php echo $shoppingBag[$key]["details"]; ?>'>

                                                    <?php
                                                    if ($shoppingBag[$key]["details"] != "") {
                                                        echo  "<p class='mb-0'> <strong> Detalles por defecto:</strong></p>";
                                                        foreach (json_decode($shoppingBag[$key]["details"], true) as $key2 => $detalle) {
                                                            foreach (array_keys($detalle) as $key3 => $list) {
                                                                echo '<div class="mb-0">' . $list . ': ' . array_values($detalle)[$key3] . '</div>';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                
                                                <p>Sold By:<strong> WeSharp</strong></p>

                                            </div>

                                        </div>

                                    </td>

                                    <td class="price">$<span>
                                    <?php if ($value->offer_product != null) : ?>
                                        <?php
                                            $preceProduct= TemplateController::offerPrice($value->price_product, json_decode($value->offer_product, true)[1], json_decode($value->offer_product, true)[0]); 
                                            echo $preceProduct; ?>
                                        <?php else : ?>
                                        <?php 
                                            $preceProduct= $value->price_product;
                                            echo $preceProduct;
                                        ?>
                                    <?php endif; ?>
                                    </span>
                                    </td>

                                    <td class="text-center shopingcantidad">$<span>
                                    <?php 
                                        if($shoppingBag[$key]["quantity"] >= 3 || $totalSC >= 3 || ($shoppingBag[$key]["quantity"] >= 3 && $totalSC >= 3)){
                                            $ValorPrecioEnvio=0;
                                            echo $ValorPrecioEnvio;
                                        }else{
                                            $ValorPrecioEnvio= ($value->shipping_product * 1.5 )/ $shoppingBag[$key]["quantity"];
                                            echo $ValorPrecioEnvio;
                                        }
                                    ?>
                                    </span>
                                    </td>


                                    <td>

                                        <div class="form-group--number quantity">

                                            <button class="up"
                                            onclick="changeQualyty($('#quant<?php echo $key; ?>').val(), 'up', <?php echo $value->stock_product ?>, <?php echo $key; ?> )"
                                            >+</button>

                                            <button class="down"
                                            onclick="changeQualyty($('#quant<?php echo $key; ?>').val(), 'down', <?php echo $value->stock_product ?>, <?php echo $key; ?>)"
                                            >-</button>

                                            <input 
                                            id="quant<?php echo $key; ?>"
                                            class="form-control" type="text" placeholder="1" value="<?php echo $shoppingBag[$key]["quantity"]?>">

                                        </div>

                                    </td>

                                    <td><span class="subtotal">$0.00</span></td>                             

                                    <td>
                                        <a class="ps-product__remove text-danger btn" onclick="removeBagSC('<?php echo $value->url_product; ?>','<?php echo $_SERVER['REQUEST_URI']; ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                </table>

            </div>

            <hr>

            <div class="d-flex flex-row-reverse">
                <div class="p-2 totalPrice"><h3>Total $<span>0.00</span></h3></div>             
            </div>

            <div class="ps-section__cart-actions">

                <a class="ps-btn" href="categories.html.html">
                    <i class="icon-arrow-left"></i> Back to Shop
                </a>

                <?php if(isset($_COOKIE["listSC"]) && $_COOKIE["listSC"] != []): ?>

                <a class="ps-btn" href="<?php echo $path; ?>checkout">
                    Pagar <i class="icon-arrow-right"></i> 
                </a>

                <?php endif; ?>

            </div>

        </div> 
        
    </div>

</div>