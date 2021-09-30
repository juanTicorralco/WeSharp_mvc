<?php

class TemplateController
{

    /* we bring the main view of the controller */
    public function index()
    {

        include 'views/template.php';
    }

    /* Route Principal Or Domine from site */
    static public function path(){
        return "http://wesharp.com/";
    }
}
