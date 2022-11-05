<div class="ps-breadcrumb">

    <div class="container">

        <ul class="breadcrumb">

            <li><a href="/">Home</a></li>

            <li><?php 
            if(!empty($productRelation[0]->name_category)){
                echo $productRelation[0]->name_category;
            }else if(!empty($productRelation[0]->name_subcategory)){
                echo $productRelation[0]->name_subcategory;
            }
            else{
                echo $urlParams[0];
            }
            ?></li>

        </ul>

    </div>

</div>