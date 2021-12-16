<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
        } else {
            return 0;
        }
    }

    /* Controller offer */
    static public function percentOffer($price, $offer, $type)
    {
        if ($type == "Discount") {
            return $offer;
        } else if ($type == "Fixed") {
            return 100 - round(($offer * 100) / $price);
        }
    }

    /* funcion para mayuscula inicial */
    static public function capitalize($value)
    {
        $text = str_replace("_", " ", $value);
        return ucwords($text);
    }

    /* funcion para enviar correos electronicos */
    static public function sendEmail($name, $subject, $email, $message, $url, $post)
    {
        date_default_timezone_set("America/Mexico_City");
        $mail = new PHPMailer;
        $mail->Charset = "UTF-8";
        $mail->isMail();
        $mail->setFrom("roster_rtr@hotmail.com", "WeSharp Support");//esto se debe cambiar en produccion
        $mail->Subyect= "Hola ".$name." - ".$subject;
        $mail->addAddress($email);
        $mail->msgHTML('
            <div>
                Hola,' .$name. ':
                <p>'. $message .'</p>
                <a href="'.$url.'">Dale Click al link para: '.$post.'</a>
                Si no deseas verificar tu email en WeSharp, favor de ignorar este mensaje.

                Gracias

                Su grupo WeSharp

            </div>
        ');
        $send=$mail->Send();
        if(!$send){
            return $mail->ErrorInfo;
        }else{
            return "ok";
        }
    }
}
