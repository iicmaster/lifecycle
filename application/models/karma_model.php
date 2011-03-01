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
		// Step 1
		$sql_karma = 'SELECT * FROM karma 
					  LEFT JOIN karma_retribution ON karma.id_karma = karma_retribution.id_karma
					  WHERE id_karma = ' . $id_karma;
		$query_karma = $this->db->query($sql_karma);
		$karma = $query_karma->result_array();
		
		$character_karma = $this->get_character_karma($id_character);
		
		if($karma[0]['karma_type'] == 1)
		{
			$data = array('karma_good' => $character_karma[0]['karma_good'] + 1);
			$this->db->where('id_character', $id_character);
			$this->db->update('character_karma', $data);
		}
		elseif($karma[0]['karma_type'] == 2)
		{
			$data = array('karma_bad' => $character_karma[0]['karma_bad'] + 1);
			$this->db->where('id_character', $id_character);
			$this->db->update('character_karma', $data);
		}
		// Step 2
		$data = array(
			'id_character' => $id_character,
			'id_karma_result' => $karma[0]['id_krama_result'],
			'krama_type' => $karma[0]['karma_type'],
			'karma_result_type' => $karma[0]['karma_result_type'], 
			'krama_speed' => $karma[0]['speed'],
			'karma_piority' => $karma[0]['piority'],
			'quantity' => $karma[0]['quantity'],
		);
		$this->db->insert('character_karma_retribution', $data);
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
	 
	function get_character_karma_retribution($id_character, $karma_type, $karma_result_typee)
	{
		$sql = 'SELECT id_karma_result, karma_type 
				FROM character_karma_retribution
				ORDER BY karma_speed, karma_priority';
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	 
	// ------------------------------------------------------------------------
}

/* End of file karma_model.php */
/* Location: ./application/models/karma_model.php */