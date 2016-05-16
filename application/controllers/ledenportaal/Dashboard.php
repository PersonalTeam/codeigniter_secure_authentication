<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'core/AuthController.php';


class Dashboard extends AuthController {

    public function index()
    {
        echo "ledenportaal";
    }
}