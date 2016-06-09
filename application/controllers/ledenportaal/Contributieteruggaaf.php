<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once APPPATH.'core/BaseController.php';


class Contributieteruggaaf extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        loadView($this, 'portal/contributieteruggaaf', null);
    }
}