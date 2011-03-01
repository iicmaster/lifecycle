<?php

class Support_model extends CI_Model {

	function feedback($type, $topic, $detail)
	{		
		if($type == 0)
		{
			$sql = 'INSERT INTO support_feedback SET	id_player = "' . $this->session->userdata('id') . '",
														topic = "' . $topic . '",
														detail = "' . $detail . '",
														date_time = NOW()';			
			return $this->db->query($sql);
		}
		else
		{
			$sql = 'INSERT INTO support_bug_report SET	id_player = "' . $this->session->userdata('id') . '",
														topic = "' . $topic . '",
														detail = "' . $detail . '",
														date_time = NOW()';			
			return $this->db->query($sql);
		}
	}
	
}

?>