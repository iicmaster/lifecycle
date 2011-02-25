<?php
class Karma_model extends CI_Model {
	 
	// ------------------------------------------------------------------------
	
	/**
	 * Set character karma
	 *
	 * process:
	 * 			1. update good/bad krama in table: character_krama
	 * 			2. insert/update krama in table: character_karma_retribution
	 *
	 * @param 	int		$id_character	id of id_character
	 * @param 	int		$id_karma		id of karma
	 */
	 
	function set_character_karma($id_character, $id_karma)
	{
		$sql_karma = 'SELECT karma_type FROM karma WHERE id_karma = ' . $id_karma . ' LIMIT 1';
		$query_karma = $this->db->query($sql_karma);
		
		$data = $this->get_character_karma($id_character);
		
		foreach($query->result() as $row)
		{
			if($row->karma_type == 1)
			{
	
			}
			elseif($row->karma_type == 2)
			{
				
			}
		}
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	 * Get character karma
	 *
	 * @param 	int		$id_character	id of charactor
	 * @return	array					karma_good, karma_bad
	 */
	 
	function get_character_karma($id_character)
	{
		$sql = 'SELECT karma_good, karma_bad FROM character_karma
				WHRER id_character = ' . $id_character;
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	 * Get character karma retribution
	 * select id_karma_result with the highess karma_speed, karma_priority
 	 * can return more than one id if same karma_speed and karma_priority
	 *
	 * @param 	int		$id_character		id of charactor
	 * @param 	int		$karma_type			type of karma (0 = all, 1 = bad, 2 = good)
	 * @param 	int		$karma_result_type	type of karma result (0 = item, 1 = money, 2 = status, 3 = health, 4 = incarnation)
	 * @return	array						id_karma_result, karma_type
	 */
	 
	function get_character_karma_retribution($id_character)
	{
		
	}
	 
	// ------------------------------------------------------------------------
}

/* End of file karma_model.php */
/* Location: ./application/models/karma_model.php */