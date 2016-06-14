<?php
use Hashids\Hashids;
include_once APPPATH.'core/BaseController.php';

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dossiers extends BaseController {

    protected $hashids;

    public function __construct()
    {
        parent::__construct();
        $this->hashids = new Hashids(parent::getAfasMemberId() . $this->security->get_csrf_hash(), 12);
    }

    public function index()
    {
        $this->load->helper('api');
        $data['dossiers'] = json_decode(getDossiesOverviewData($this, parent::getAfasMemberId()));


        foreach ($data['dossiers']->lopend as $dossier) {
            $dossier->link = $this->hashids->encode($dossier->dossiernr);
        }
        foreach ($data['dossiers']->afgerond as $dossier) {
            $dossier->link = $this->hashids->encode($dossier->dossiernr);
        }


        loadView($this, 'portal/dossieroverzicht', $data);
    }

    public function get ($id = null) {
        ($id == null) ? redirect(base_url('ledenportaal/dossiers/')) : null;

        $id = $this->hashids->decode($id)[0];

        $this->load->helper('api');
        $data['dossier'] = json_decode(getDossierFiles($this, $id));

        foreach ($data['dossier']->handelingen as $handeling) {
            if ($handeling->documentid != null) {
                $handeling->documentid = $this->hashids->encode($handeling->documentid);
            }
        }

        loadView($this, 'portal/dossierbestanden', $data);
    }

    public function downloadSecureFile ($fileId) {
        ($fileId == null) ? redirect(base_url('ledenportaal/dossiers/')) : null;

        $fileId = $this->hashids->decode($fileId)[0];

        $this->load->helper('api');
        $file = json_decode(getHandelingFile($this, $fileId));

        header("Content-Type: application/pdf");
        header("title: Hoihoi");
        echo base64_decode($file->bitstream) . $file->extension;
    }
}