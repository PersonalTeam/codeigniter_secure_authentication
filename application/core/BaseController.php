<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BaseController extends CI_Controller
{
    public $userId;
    public $afasMemberId;
    public $username;
    public $sessionToken;

    public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel');

        // TODO: check if user is still authenticated
        if ($this->session->userId && $this->session->afasMemberId && $this->session->username && $this->session->sessionToken) {

            // Session variables available
            if ($this->AuthModel->checkTokenValid($this->session->userId)) {

                // The current session token is valid, refresh the session token
                $this->AuthModel->setSessionToken($this->session->userId);

                // Set all class properties
                $this->userId = $this->session->userId;
                $this->afasMemberId = $this->session->afasMemberId;
                $this->username = $this->session->username;
                $this->sessionToken = $this->session->sessionToken;

            }
            else {
                $this->session->set_flashdata('login_error', 'Uw inlogsessie is niet meer geldig. Log alstublieft opnieuw in');
                $this->AuthModel->destroySession();
            }

        }
        else {
            $this->session->set_flashdata('login_error', 'U bent niet ingelogd');
            $this->AuthModel->destroySession();
        }
    }
}