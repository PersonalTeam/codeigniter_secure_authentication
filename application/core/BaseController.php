<?php
namespace application\core;

defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        // TODO: check if user is still authenticated
    }
}