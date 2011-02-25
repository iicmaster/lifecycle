<?php

//require_once(APPPATH . 'libraries/facebook.php');

class Test extends CI_Controller
{
	private $facebook;
	
	// ------------------------------------------------------------------------
	
	/**
	  * Page for test code
	  *
	  * @access	public
	  */
	
 	function index() 
	{		
		/*$data = $this->facebook_connect();

		if($this->check_register($data['id_facebook']))
		{
			$data['isFirst'] = TRUE;
			$this->load->view('test.php', $data);
		}
		else
		{
			$data['isFirst'] = FALSE;
			$this->load->view('test.php', $data);
<<<<<<< HEAD
		}
		$this->load->model('quest_model');
		print_array($this->quest_model->get_full_description(13));
		
=======
		}*/
		/*$this->load->model('quest_model');
		print_array($this->quest_model->get_full_description(13));
		$this->session->set_userdata();
>>>>>>> 37f97add13a4565f33e354e90ddae5a48b45fec2*/

		$this->load->view('map.php');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Generate map's icon in world map
	  *
	  * @access	public
	  * @return	string	$_html
	  */
	  
	function gen_map_icon($status = 'enable', $type = 'all')
	{
		$this->load->model('map_model');
		$_rows = $this->map_model->get_map($status, $type);
		$_html = '';
		
		foreach($_rows as $_row)
		{
			$_class = ($_row->type == 0) ? 'map_icon_map' : 'map_icon_city';
			
			$_html .= '<div id="map_icon_'.$_row->id_map.'" class="'.$_class.'" rel="'.$_row->id_map.'" title="'.$_row->name.'"></div>';
		}
		
		return $_html;
	}
	
	// ------------------------------------------------------------------------
	
	function get_item()
	{
		$this->load->model('item');
		$data['arr'] = $this->item->get_info();
		echo $data['arr'];	
	}
	
	function get_npc($id_location)
	{
		$this->load->model('map_model');
		$data['arr'] = $this->map_model->get_npc($id_location);
		
		echo $data['arr'];
	}
	
	function get_npc_dialog($id_npc)
	{
		$this->load->model('npc_model');
		$data['arr'] = $this->npc_model->get_dialog($id_npc, 141);
		echo $data['arr'];
	}
	
	function get_detail($location_type, $id_location)
	{
		$this->load->model('map_model');
		$data['arr'] = $this->map_model->get_detail($location_type, $id_location);
		echo $data['arr'];
	}
	
	function get_guidepost($id_section)
	{
		$this->load->model('map_model');
		
		$data['arr'] = $this->map_model->get_guidepost($id_section);
		
		print_array($data['arr']);
		//echo $data['arr'];
	}
	
	function get_monster($id_section)
	{
		$this->load->model('map_model');
		$data['arr'] = $this->map_model->get_monster($id_section);
		echo $data['arr'];
	}
	
	
	function get_map_detail($id_section)
	{
		$this->load->model('map_model');		
		echo json_encode($this->map_model->get_map_detail($id_section));
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */