<?php
class NPC_model extends CI_Model {
	 
	// ------------------------------------------------------------------------

	/**
	  * Get detail of location
	  *
	  * @access	public
	  * @param 	string	$fields		name of field in table npc include name, description in table: language_npc
	  * @return	array	
	  */
	  
	function get_fields($fields = '*')
	{
		$sql_join = '';
		foreach(comma_to_array($fields) as $row)
		{
			if($row == 'name' || $row == 'description' || $row == '*')
			{
				$sql_join = ' LEFT JOIN language_npc ON npc.id_npc = language_npc.id_npc';		
				break;
			}
		}
		$sql = 'SELECT ' . $fields . ' FROM npc' . $sql_join;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Get NPC dialog
	  *
	  * @access	public
	  * @param	int		$id_npc				id of NPC 
	  * @param 	int		$id_dialog_group	id of dialog_group
	  * @return	array						ordering, dialog, , type, link
	  */
	  
	function get_dialog($id_npc, $id_dialog_group = NULL)
	{
		$sql = 	'SELECT ordering, dialog, target_type, id_target '.
				'FROM dialog_group '.
				
				'LEFT JOIN npc '.
				'ON dialog_group.id_npc = npc.id_npc '.
				
				'LEFT JOIN dialog_group_dialog '.
				'ON dialog_group.id_group = dialog_group_dialog.id_group '.
				
				'LEFT JOIN language_dialog '.
				'ON dialog_group_dialog.id_dialog = language_dialog.id_dialog ';
				
		if($id_dialog_group == NULL)
		{
			$sql .=	'WHERE dialog_group.id_npc = "' . $id_npc . '" and dialog_group.step = 0 ';
		}
		else
		{
			$sql .=	'WHERE dialog_group.id_npc = ' . $id_npc . ' and dialog_group.id_group = ' . $id_dialog_group . ' ';
		}
		
			$sql .=	'ORDER BY ordering';
				
		$query = $this->db->query($sql);
		
		return $query->result_array();
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
		$sql = 	'SELECT npc_item.id_item, name, description, price_sell, sell_rate '.
				'FROM npc_item '.
		
				'LEFT JOIN npc '. 
				'ON npc_item.id_npc = npc.id_npc '.
				
				'LEFT JOIN item '.
				'ON npc_item.id_item = item.id_item '.
				
				'LEFT JOIN language_item '.
				'ON item.id_item = language_item.id_item '.
				 
				'WHERE npc.id_npc = ' . $id_npc . ' AND language_item.id_language = 1 '.
				'ORDER BY npc_item.ordering';	
				
		$query = $this->db->query($sql);
		$result = array();
		
		foreach($query->result() as $row)
		{
			array_push($result, array(
										'id_item'		=> $row->id_item,
										'name'			=> $row->name,
										'description'	=> $row->description,
										'price'			=> $row->price_sell * ($row->sell_rate / 100)
									));	
		}
		
		return $result;
	}
}

/* End of file npc.php */
/* Location: ./application/models/npc.php */