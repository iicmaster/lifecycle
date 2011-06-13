<?php
class Character_model extends CI_Model {
	
	function get_status($id_character)
	{
		$sql = 'SELECT * 
				FROM lifecycle.character
				WHERE character.id_character = ' . $id_character;
		$query = $this->db->query($sql);
		
		return $query->row_array();
	}
	 
	// ------------------------------------------------------------------------
	
	function job_change($id_job)
	{
		$this->session->set_user_data(array('job_id' => $id_job));
		$sql = 'UPDATE character SET id_job = ' . $id_job . ' WHERE id_character = ' . $this->session->userdata('id');
		
		return $this->db->query($sql);
	}
	 
	// ------------------------------------------------------------------------
	
	function get_item($id_character)
	{
		$sql = 'SELECT character_item.id_item, name, quantity
				FROM character_item
				LEFT JOIN language_item 
				ON character_item.id_item = language_item.id_item
				WHERE id_character = ' . $id_character . ' AND id_language = 1';
		$query = $this->db->query($sql);
		
		return $query->result_array();	
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Set character status
	  *
	  * process:
	  * 			1. update status in session
	  * 			2. update status in table: character_status_general
	  *
	  * @access	public
	  * @param 	array	$character_status	status => value
	  */
	 
	function set_character_status($character_status)
	{
		// Step 1
		foreach($character_status as $status => $value)
		{
			$this->session->set_userdata($status, $value);
		}
		
		// Step 2
		$this->db->where('id_character', $this->session->userdata('id_character'));
		$this->db->update('character', $character_status);
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Set character item
	  *
	  * process:
	  * 			1. check item in Table: character_item
	  * 			2. insert/update status in session
	  *
	  * @access	public
	  * @param 	array	$character_item	{ id_item, quantity }
	 */
	 
	function set_character_item($character_item)
	{
		//print_array($character_item);
		foreach($character_item as $item)
		{
			// Step 1
			$_where = array(	
							'id_item'		=> $item['id_item'], 
							'id_character'	=> $this->session->userdata('id_character')
						  	);
							
			$_query = $this->db->get_where('character_item', $_where);
			
			// Step 2
			if($_query->num_rows() > 0)
			{
				$_data = $_query->row_array();
				$_data_item = array('quantity' => $_data['quantity'] + $item['quantity']);
				
				$this->db->where($_where);
				$this->db->update('character_item', $_data_item);
			}
			else
			{
				$_data_item = array(
									'id_character'	=> $this->session->userdata('id_character'),
									'id_item'	=> $item['id_item'],
									'quantity'	=> $item['quantity']
								   );
				$this->db->insert('character_item', $_data_item);
			}
		}
	}
}

/* End of file character_model.php */
/* Location: ./application/models/character_model.php */