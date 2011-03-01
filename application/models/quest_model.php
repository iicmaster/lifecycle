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
	 * @return	array					name, id_npc, npc_name, objective { objective_no, name, description, status }, reward { name, amount }
	 */
	 
	function get_full_description($id_quest)
	{
		// SELECT name, id_npc, npc_name
		
		$result = array();
		$sql = 'SELECT language_quest.name, quest.id_npc, language_npc.name as npc_name
				FROM quest
				LEFT JOIN language_quest ON quest.id_quest = language_quest.id_quest
				LEFT JOIN npc ON quest.id_npc = npc.id_npc
				LEFT JOIN language_npc ON npc.id_npc = language_npc.id_npc
				WHERE quest.id_quest = ' . $id_quest . ' AND language_quest.id_language = 1 AND language_npc.id_language = 1';
		$query = $this->db->query($sql);
		$quest = $query->result_array();
		array_push($result, $quest[0]['name'], $quest[0]['id_npc'], $quest[0]['npc_name']);
		
		// SELECT objective { objective_no, name, description, status }
		
		$sql = 'SELECT objective_no, name, description, status
				FROM quest_objective
				LEFT JOIN language_quest_objective ON quest_objective.id_quest = language_quest_objective.id_quest
				WHERE quest_objective.id_quest = ' . $id_quest . ' AND id_language = 1';
		$query = $this->db->query($sql);
		$objective = $query->result_array();
		array_push($result, $objective);
		
		// SELECT reward { name, amount }
		
		$reward = array();
		$sql = 'SELECT reward_type, id_reward, amount
				FROM quest_reward
				WHERE id_quest = ' . $id_quest;
		$query = $this->db->query($sql);
		foreach($query->result() as $row)
		{
			if($row->reward_type == 1)
			{
				$sql_item = 'SELECT name FROM language_item 
							 WHERE id_item = ' . $row->id_reward . ' AND id_language = 1';	
				$query_item = $this->db->query($sql_item);
				$item = $query_item->result_array();
				array_push($reward, array($item[0]['name'], $row->amount));
			}
			else
			{
				array_push($reward, array($row->reward_type, $row->amount));	
			}
		}
		array_push($result, $reward);
		
		return $result;
	}
	 
	// ------------------------------------------------------------------------
}

/* End of file quest_model.php */
/* Location: ./application/models/quest_model.php */