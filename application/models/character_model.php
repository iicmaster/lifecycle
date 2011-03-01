<?php
class Character_model extends CI_Model {
	
	function get_status($id_character)
	{
		$sql = 'SELECT * FROM lifecycle.character
				LEFT JOIN character_status_general ON character.id_character = character_status_general.id_character
				LEFT JOIN character_status_main ON character.id_character = character_status_main.id_character
				WHERE character.id_character = ' . $id_character;
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	
	function job_change($id_job)
	{
		$this->session->set_user_data(array('job_id' => $id_job));
		$sql = 'UPDATE character SET id_job = ' . $id_job . ' WHERE id_character = ' . $this->session->userdata('id');
		
		return $this->db->query($sql);
	}
	
	function get_item()
	{
		$sql = 'SELECT character_item.id_item, name, quantity
				FROM character_item
				LEFT JOIN language_item ON character_item.id_item = language_item.id_item
				WHERE id_character = ' . $this->session->userdata('id') . ' AND id_language = 1';
		$query = $this->db->query($sql);
		
		return $query->result_array();	
	}
}