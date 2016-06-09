<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use \GuzzleHttp\Client;
// use \application\core\BaseController;

class Home extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['login_error'] = $this->session->flashdata('login_error');
		loadView($this, 'public/landingpage', $data);
		


		/*
		$username = "portal_srv_usr";
		$password = "RkxVSCNUZWNoNjBka2hHRA==";

		$client = new Client([ // Maak API client object
			'base_uri' => "https://$username:$password@188.202.124.134/connector/public/",
			'verify'   => false,
			'timeout'  => 10.0
		]);
		// Doe verzoek, zonder auth header
		$res = $client->request('GET', 'getmember/' . 10724);

		if($res->getStatusCode() == 200) {
			echo "<pre>";
			echo $res->getBody();
			echo "</pre>";
		}
		else {
			//$this->logout(HTTPS_ERROR);
			echo $res->getStatusCode();
		}
		*/

	}

}
