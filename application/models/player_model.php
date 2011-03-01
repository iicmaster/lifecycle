<?php
class Player_model extends CI_Model {
	
	function check_register($id_facebook)
	{
		$this->db->where('id_player', $id_facebook);
		$this->db->from('player');
		
		if($this->db->count_all_results() == 0)
		{
			$data = array(
				'id_player'   => $id_facebook,
				'date_register' => date('Y-m-d H:i:s')
			);
			$this->db->insert('player', $data);
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function get_id_language($abbreviation)
	{
		$sql = 'SELECT id_language FROM language WHERE abbreviation = "' . $abbreviation . '"';
		$query = $this->db->query($sql);
		$result = $query->result_array();
		
		return $result[0]['id_language'];
	}
}