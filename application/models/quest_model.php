<?php
class Quest_model extends CI_Model {
	 
	// ------------------------------------------------------------------------
	
	/**
	 * get quest description
	 *
	 * @param 	int		$id_quest		id of quest
	 * @return	array					name, description
	 */
	 
	function get_desctiption($id_quest)
	{
		$sql = 'SELECT name, description 
				FROM language_quest
				WHERE id_quest = ' . $id_quest;
				
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	 * get quest full structure
	 *
	 * @param 	int		$id_quest		id of quest
	 * @return	array					name, id_npc (owner), npc_name, objective { objective_no, name, description, status }, reward
	 */
	 
	function get_full_desctiption($id_quest)
	{
		$sql = 'SELECT name, id_npc, ';
	}
	 
	// ------------------------------------------------------------------------
}

/* End of file quest_model.php */
/* Location: ./application/models/quest_model.php */