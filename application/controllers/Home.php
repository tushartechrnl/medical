<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}   

	public function index()
	{
		
		$this->data['page_title']="Pet Home";
		$this->load->view('error-404.html',$this->data);
	}

	public function error_page()
	{
		$this->data['page_title']="Pet Home";
		$this->load->view('error-404.html',$this->data);
	}


}
