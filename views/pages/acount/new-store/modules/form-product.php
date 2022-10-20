<!-- <div class="tab-pane container fade" id="crearProduct"> -->
<div class="tab-pane container fade" id="crearStore">
     <!-- Modal header -->
     <div class="modal-header">
        <h4 class="modal-title text-center">3.- CREAR PRODUCTO</h4>
    </div>
    <div class="modal-body text-left p-5">
        <!-- name store -->
        <div class="form-group">
            <label>Product name<sup class="text-danger">*</sup></label>
            <div class="form-group__content">
                <input 
                type="text"
                class="form-control"
                name="nameProduct"
                placeholder="Nombre de tu producto..." 
                required 
                pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" 
                onchange="dataRepeat(event, 'product')">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">El nombre es requerido</div>
            </div>
        </div>
        <!-- url store -->
        <div class="form-group">
            <label>URL store<sup class="text-danger">*</sup></label>
            <div class="form-group__content">
                <input 
                type="text"
                class="form-control"
                name="urlProduct"
                placeholder="URL de tu Producto..."
                readonly 
                required >
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">El nombre es requerido</div>
            </div>
        </div>
        <!-- Categories -->
        <div class="form-group">
            <label>Product Category<sup class="text-danger">*</sup></label>
            <?php
                $url = CurlController::api()."categories?select=id_category,name_category,url_category";
                $method= "GET";
                $header= array();
                $fields= array();
                
                $Categories= CurlController::request($url, $method, $header, $fields)->result;
            ?>
            <div class="form-group__content">
                <select 
                class="form-control"
                name="categoryProduct"
                onchange="changecategory(event)"
                required>
                    <option value="">Select Category</option>
                    <?php foreach($Categories as $key => $value):?>
                        <option value="<?php echo $value->id_category."_".$value->url_category; ?>"><?php echo $value->name_category; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">El nombre es requerido</div>
            </div>
        </div>
        <!-- Subcategories -->
        <div class="form-group subcategoryProduct" style="display: none ;">
            <label>Product Subcategory<sup class="text-danger">*</sup></label>
            <div class="form-group__content">
                <select 
                    class="form-control"
                    name="subcategoryProduct"
                    required>
                    <option value="">Select Subcategory</option>
                </select>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">El nombre es requerido</div>
            </div>
        </div>
        <!-- description -->
        <div class="form-group">
            <label>Description Product<sup class="text-danger">*</sup></label>
            <div class="form-group__content">
                <textarea class="summernote" name="descriptionProduct" required></textarea>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Acompleta el campo</div>
            </div>
        </div>
        <!-- resumen -->
        <div class="form-group">
            <label>Sumary Product<sup class="text-danger">*</sup> Ex: 20 hras de portabilidad</label>
            <div class="form-group__content input-group mb-3 inputSummary">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <button type="button" class="btn btn-danger" onclick="removedInput(0,'inputSummary')">&times;</button>
                    </span>
                </div>
                <input 
                class="form-control"
                type="text"
                name="summaryProduct_0"
                required
                pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                onchange="validatejs(event, 'parrafo')">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Acompleta el campo</div>
            </div>
            <button type="button" class="btn btn-primary mb-2 btn-large" onclick="addInput(this,'inputSummary')">Agregar</button>
        </div>
        <!-- details -->
        <div class="form-group">
            <label>Details Product<sup class="text-danger">*</sup>EX: <strong>title:</strong> Bloutwe, <strong>Value:</strong> yes</label>
            <div class="row mb-3 inputDetails">
                <div class="col-12 col-lg-6 form-group__content input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <button type="button" class="btn btn-danger" onclick="removedInput(0,'inputDetails')">&times;</button>
                        </span>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            Title:
                        </span>
                    </div>
                    <input 
                    class="form-control"
                    type="text"
                    name="detailsTitleProduct_0"
                    required
                    pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                    onchange="validatejs(event, 'parrafo')">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Acompleta el campo</div>
                </div>
                <div class="col-12 col-lg-6 form-group__content input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            Value:
                        </span>
                    </div>
                    <input 
                    class="form-control"
                    type="text"
                    name="detailsValueProduct_0"
                    required
                    pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                    onchange="validatejs(event, 'parrafo')">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Acompleta el campo</div>
                </div>
            </div>
            <button type="button" class="btn btn-primary mb-2 btn-large" onclick="addInput(this,'inputDetails')">Agregar element</button>
        </div>
          <!-- Especificaciones -->
          <div class="form-group">
            <label>Especifications Product<sup class="text-danger">*</sup>EX: <strong>Type:</strong> Color, <strong>Values:</strong> black,green,yelow</label>
            <div class="row mb-3 inputEspesifications">
                <div class="col-12 col-lg-6 form-group__content input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <button type="button" class="btn btn-danger" onclick="removedInput(0,'inputEspesifications')">&times;</button>
                        </span>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            Type:
                        </span>
                    </div>
                    <input 
                    class="form-control"
                    type="text"
                    name="EspesificTypeProduct_0"
                    required
                    pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                    onchange="validatejs(event, 'parrafo')">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Acompleta el campo</div>
                </div>
                <div class="col-12 col-lg-6 form-group__content input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            Values:
                        </span>
                    </div>
                    <input 
                    class="form-control"
                    type="text"
                    name="EspesificValuesProduct_0"
                    required
                    pattern = '[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                    onchange="validatejs(event, 'parrafo')">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Acompleta el campo</div>
                </div>
            </div>
            <button type="button" class="btn btn-primary mb-2 btn-large" onclick="addInput(this,'inputEspesifications')">Agregar element</button>
        </div>
    </div>
</div>