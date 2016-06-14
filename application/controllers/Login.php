<?php
use \GuzzleHttp\Client;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel');
    }

    public function tryLogin() {
        $email = $this->security->xss_clean($this->input->post('email'));
        $pass = $this->security->xss_clean($this->input->post('pass'));

        if (!isset($email) || $email == null || !isset($pass) || $pass == null) {
            $this->session->set_flashdata('login_error','Vul een gebruikersnaam en wachtwoord in.');
            redirect(base_url());
        } else {
            $res = $this->AuthModel->checkCredentials($email, $pass);
            // print_r($res); exit;
            if (!isset($res->error)) {
                // user authenticated. Do the API call
                $this->load->helper('api');
                $memberData = json_decode(getAfasMemberData($this, $res->fnv_member_id));

                if (isset($memberData->error)) {
                    $this->session->set_flashdata('login_error', 'Backoffice foutmelding: ' . $memberData->error);
                    redirect(base_url());
                }
                else {
                    // ophalen van de data geslaagd. Set een sessie cookie
                    $this->AuthModel->createSession($res->id, $res->fnv_member_id, $memberData->username);
                    
                }
            } else {
                // login failed
                $this->session->set_flashdata('login_error', $res->error);
                redirect(base_url());
            }
        }
    }


    public function destroy ($message = null) {
        $this->AuthModel->destroySession($message);
    }

}