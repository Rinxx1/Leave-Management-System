	<?php  
	function save_emp_leave_type(){
		extract($_POST);
		
		$leave_type_ids = array();
		$leave_type_credits = array();

		if(isset($leave_type_id) && count($leave_type_id) > 0){
			$leave_type_ids = $leave_type_id;
			foreach($leave_type_id as $k=> $v){
				$leave_type_credits[$v] = $leave_credit[$k];
			}
		}

		$this->conn->query("DELETE FROM `employee_meta` where (meta_field = 'leave_type_ids' or meta_field = 'leave_type_credits') and user_id = '{$user_id}' ");

		$leave_type_ids = implode(',',$leave_type_ids);
		$leave_type_credits = json_encode($leave_type_credits);
		$data = "('{$user_id}','leave_type_ids','{$leave_type_ids}')";
		$data .= ",('{$user_id}','leave_type_credits','{$leave_type_credits}')";
		$save = $this->conn->query("INSERT INTO `employee_meta` (`user_id`,`meta_field`,`meta_value`) Values {$data}");
		$this->capture_err();
		$resp['status'] = 'success';
		$this->settings->set_flashdata("success"," Leave Type Credits successfully updated.");
		return json_encode($resp);
	}
	?>