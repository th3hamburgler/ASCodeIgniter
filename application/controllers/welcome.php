<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('welcome_message');
	}
	
	function date_helper()
	{
		// load the date helper
		$this->load->helper('date');
	
		$this->load->view('test/date_helper');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */