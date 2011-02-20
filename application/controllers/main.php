<?php
class Main extends CI_Controller 
{
 	function index() 
	{
		$this->get_guidepost(267);
		//$this->get_detail('guidepost', 2);
		//$this->load->view('index.php');
	}
	
	function get_detail($location_type, $id_location)
	{
		$this->load->model('map');
		$data['arr'] = $this->map->get_detail($location_type, $id_location);
		print_array($data['arr']);
		exit();	
	}
	
	function get_guidepost($id_location)
	{
		$this->load->model('map');
		$data['arr'] = $this->map->get_guidepost($id_location);
		print_array($data['arr']);
		exit();
	}
	
	function get_monster()
	{

	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */