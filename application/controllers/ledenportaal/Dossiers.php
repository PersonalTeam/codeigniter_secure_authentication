<?php
use \GuzzleHttp\Client;
include_once APPPATH.'core/BaseController.php';

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dossiers extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('api');
        $data['dossiers'] = json_decode(getDossiesOverviewData(parent::getAfasMemberId()));

        loadView($this, 'portal/dossieroverzicht', $data);
    }
}