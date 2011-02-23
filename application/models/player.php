<?php
class Player extends CI_Model {
	
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
}