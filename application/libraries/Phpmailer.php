<?php

defined('BASEPATH') OR exit('No estan permitidos los scripts directos');


class Phpmailer
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        $objMail = new PHPMailer\PHPMailer\PHPMailer();
        return $objMail;
    }
}
