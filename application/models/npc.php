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
	  
	function get_dailog($id_npc, $id_dialog_group = 1)
	{
	
	}
	
}

/* End of file npc.php */
/* Location: ./application/models/npc.php */