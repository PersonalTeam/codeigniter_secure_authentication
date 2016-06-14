<?php
use Hashids\Hashids;
include_once APPPATH.'core/BaseController.php';

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Contributieteruggaaf extends BaseController {

    protected $hashids;

    public function __construct()
    {
        parent::__construct();
        $this->hashids = new Hashids(parent::getAfasMemberId() . $this->security->get_csrf_hash(), 12);
    }

    public function index()
    {
        $data['downloadId'] = $this->hashids->encode(parent::getAfasMemberId());
        loadView($this, 'portal/contributieteruggaaf', $data);
    }

    public function downloadSecureFile($encodedId) {
        $decodedId = $this->hashids->decode($encodedId)[0];

        $this->load->helper('api');
        $file = json_decode(getContributionFile($this, $decodedId));

        header("Content-Type: application/pdf");
        echo base64_decode($file->bitstream) . $file->extension;
    }
}