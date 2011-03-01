<?php

// @auther IIC

class Test extends CI_Controller
{	
	/*------------------------------------------------------------------------*/
	/* index */
	/*------------------------------------------------------------------------*/
	
 	function index() 
	{		
		$this->load->view('map.php');
	}
	
	/*------------------------------------------------------------------------*/
	/* Location Detail */
	/*------------------------------------------------------------------------*/
	
	function get_detail($location_type, $id_location)
	{
		$this->load->model('map_model');
		print_array($this->map_model->get_detail($location_type, $id_location));
	}
	
	/*------------------------------------------------------------------------*/
	/* Get Map Detail from id_section */
	/*------------------------------------------------------------------------*/
	
	function get_map_detail($id_section)
	{
		$this->load->model('map_model');		
		print_array($this->map_model->get_map_detail($id_section));
	}
	
	/*------------------------------------------------------------------------*/
	/* Guidepost */
	/*------------------------------------------------------------------------*/
	
	function get_guidepost($id_section)
	{
		$this->load->model('map_model');		
		print_array($this->map_model->get_guidepost($id_section));
	}
	
	/*------------------------------------------------------------------------*/
	/* NPC */
	/*------------------------------------------------------------------------*/
	
	function get_npc($id_location)
	{
		$this->load->model('map_model');		
		print_array($this->map_model->get_npc($id_location));
	}
	
	/*------------------------------------------------------------------------*/
	/* Monster */
	/*------------------------------------------------------------------------*/
	
	function get_monster($id_section)
	{
		$this->load->model('map_model');		
		print_array($this->map_model->get_monster($id_section));
	}
	
	/*------------------------------------------------------------------------*/
	/* Dialog */
	/*------------------------------------------------------------------------*/
	
	function get_npc_dialog($id_npc, $id_dialog_group = NULL)
	{
		$this->load->model('npc_model');
		print_array($this->npc_model->get_dialog($id_npc, $id_dialog_group));
	}
	
	/*------------------------------------------------------------------------*/
	/* Item */
	/*------------------------------------------------------------------------*/
	
	function get_item()
	{
		$this->load->model('item');
		print_array($this->item->get_info());
	}
	
	/*------------------------------------------------------------------------*/
	/* Battle */
	/*------------------------------------------------------------------------*/
	
	function get_battle_result($id_monster)
	{
		$this->load->model('battle_model');
		print_array($this->battle_model->get_battle_result($this->session->userdata('id_character'), $id_monster));
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */