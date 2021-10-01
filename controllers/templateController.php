<?php

class TemplateController
{

    /* we bring the main view of the controller */
    public function index()
    {

        include 'views/template.php';
    }

    /* Route Principal Or Domine from site */
    static public function path()
    {
        return "http://wesharp.com/";
    }

    /* Controller save */
    static public function SavePrice($price, $offer, $type)
    {
        if ($type == "Discount") {
            $save = ($price * $offer) / 100;
            return  number_format($save, 2);
        } else if ($type == "Fixed") {
            $save = $price - $offer;
            return number_format($save, 2);
        }
    }

    /* Controller offer */
    static public function offerPrice($price, $offer, $type)
    {
        if ($type == "Discount") {
            $offerPrice = $price - ($price * $offer) / 100;
            return  number_format($offerPrice, 2);
        } else if ($type == "Fixed") {
            return number_format($offer, 2);
        }
    }

    /* Controller calificatio */
    static public function calificationStars($reviews)
    {

        if ($reviews != null) {
            $suma = 0;
            foreach ($reviews as $key => $value) {
                $suma += $value["review"];
            }
            $count = count($reviews);
            return round($suma / $count);
        }else{
            return 0;
        }
    }
}
