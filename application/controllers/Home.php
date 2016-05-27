<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \GuzzleHttp\Client;
// use \application\core\BaseController;

class Home extends CI_Controller {


	public function __construct()
	{
		parent::construct();
	}

	public function index()
	{
		$this->load->view('home');
		echo "<br /><br /><br /><br />";
		
		
		$expected = crypt('pass_1234!', '$6$rounds=8000$randomizedsalt16$');
		$correct = crypt('pass_1234!', '$6$rounds=8000$randomizedsalt16$');
		$wrong = crypt('pass_4321?', '$6$rounds=8000$randomizedsalt16$');
		echo "correct SHA-512:    " . $correct;
		
		echo "<br /><br /> comparing expected with correct hash";
		var_dump(hash_equals($expected, $correct)); //true
		
		echo "<br /><br /> comparing expected with wrong hash";
		var_dump(hash_equals($expected, $wrong)); //false
		
	}

}
