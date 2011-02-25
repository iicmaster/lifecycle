<?php

class Support_model extends CI_Model {

	function feedback($type, $topic, $detail)
	{
		$data = array(
			'topic' => $topic,
			'detail' => $detail,
			'date_time' => date('Y-m-d H:i:s')
		);
		
		if($type == 0)
		{
			$this->db->insert('support_feedback', $data);	
		}
		else
		{
			$this->db->insert('support_bug_report', $data);	
		}
	}
	
}

?>