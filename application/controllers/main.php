<?php
class Main extends CI_Controller 
{
 	function index() 
	{
		//$this->get_detail();
		$this->load->view('index.php');
	}
	
	function get_detail()
	{
		$this->load->model('map');
		$data['arr'] = $this->map->get_detail('zone,section',46);
		print_array($data['arr']);
		exit();	
	}
	
	function get_guidepost()
	{

	}
	
	function get_monster()
	{

	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */