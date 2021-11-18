<div class="ps-shopping__header">

    <p>Total Procuctos: <strong><?php echo $totalProducts; ?></strong></p>

    <div class="ps-shopping__actions">

        <select class="ps-select" data-placeholder="Sort Items" onchange="sortProduct(event)">

            <?php if (isset($urlParams[2])) : ?>

                <?php if ($urlParams[2] == "new") : ?>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
                <?php endif; ?>
                <?php if ($urlParams[2] == "latets") : ?>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
                <?php endif; ?>
                <?php if ($urlParams[2] == "low") : ?>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
                <?php endif; ?>
                <?php if ($urlParams[2] == "higt") : ?>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                    <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>

                <?php endif; ?>

            <?php else : ?>
                <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+new">Ordenar por: Mas nuevo</option>
                <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+latets">Ordenar por: Mas viejo</option>
                <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+low">Ordenar por: Precio bajo a Precio alto</option>
                <option value="<?php echo $_SERVER["REQUEST_URI"]; ?>+higt">Ordenar por: Precio alto a Precio bajo</option>
            <?php endif; ?>
        </select>

        <div class="ps-shopping__view">

            <p>VER</p>

            <ul class="ps-tab-list">

                <!-- checkar si hay una cookie -->
                <?php if(isset($_COOKIE["tab"])): ?>
                <?php if($_COOKIE["tab"]=="grid"): ?>
                    <li class="active" type="grid">
                <?php else: ?>
                    <li class="" type="grid">
                <?php endif; ?>
                <?php else: ?>
                    <li class="active" type="grid">  
                <?php endif; ?>

                    <a href="#tab-1">
                        <i class="icon-grid"></i>
                    </a>
                </li>

                <!-- checkar si hay una cookie -->
                <?php if(isset($_COOKIE["tab"])): ?>
                <?php if($_COOKIE["tab"]=="list"): ?>
                    <li class="active" type="list">
                <?php else: ?>
                    <li class="" type="list">
                <?php endif; ?>
                <?php else: ?>
                    <li class="" type="list">  
                <?php endif; ?>
                    <a href="#tab-2">
                        <i class="icon-list4"></i>
                    </a>
                </li>

            </ul>

        </div>

    </div>

</div>