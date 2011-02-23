<?php
class Quest_model extends CI_Model {
	 
	// ------------------------------------------------------------------------
	
	/**
	 * get quest description
	 *
	 * @param 	int		$id_quest		id of quest
	 * @return	array					name, description
	 */
	 
	function get_description($id_quest)
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
	 
	function get_full_description($id_quest)
	{
		$sql = 'SELECT * FROM quest
				LEFT JOIN quest_objective ON quest.id_quest = quest_objective.id_quest
				LEFT JOIN quest_reward ON quest.id_quest = quest_reward.id_quest
				WHERE id_quest = ' . $id_quest;
				
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	 
	// ------------------------------------------------------------------------
}

/* End of file quest_model.php */
/* Location: ./application/models/quest_model.php */