<?php
class NPC extends CI_Model {

	/**
	  * Get detail of location
	  *
	  * @access	public
	  * @param 	string	$fields		name of field in table npc include name, description in table: language_npc
	  * @return	array	
	  */
	  
	function get_detail($fields = '*')
	{
	
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Get NPC dialog
	  *
	  * @access	public
	  * @param	int		$id_npc				id of NPC 
	  * @param 	int		$id_dialog_group	id of dialog_group
	  * @return	array						list of dialog in 2D array { ordering, dialog, link }
	  */
	  
	function get_dialog($id_npc, $id_dialog_group = 1)
	{
		$sql = 'SELECT ordering, dialog, link 
				FROM dialog_group 
				LEFT JOIN dialog_group_dialog ON dialog_group.id_group = dialog_group_dialog.id_group
				WHERE id_npc = ' . $id_npc;
				
		$query = $this->db->query($sql);
		$result = array();
		
		foreach($query->result() as $row)
		{
			array_push($result, comma_to_array($row->ordering . ',' . $row->dialog . ',' . $row->link)); 
		}
		
		return $result;
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Get NPC item
	  *
	  * @access	public
	  * @param	int		$id_npc				id of NPC 
	  * @return	array						id_item, name, description, price
	  */
	  
	function get_npc_item($id_npc)
	{
	
	}
	 
	
	
	
}

/* End of file npc.php */
/* Location: ./application/models/npc.php */