<?php 
class Model_login extends CI_Model {

	//checking if account exists
	public function login($uname, $pword)
		{
			$query = $this->db->get_where('church_user',"user_username = '{$uname}' and user_password = '{$pword}'");
			
			$n = 0;
			
			foreach($query->result() as $row)
			{
				$n++;
				$data = array(
					'user_id' => $row->user_id,
					'user_username' => $row->user_username,
					'user_title' => $row->user_title,
					'user_fname' => $row->user_fname,
					'user_mname' => $row->user_mname,
					'user_lname' => $row->user_lname,
					'user_status' => $row->user_status,
					'user_church' => $row->user_church,
					'user_district' => $row->user_district
				);
			}
			
			if($n != 0)
			{
				$user_data = array(
							'user_id' => $data['user_id'],
							'username' => $data['user_username'],
							'title' => $data['user_title'],
							'fname' => $data['user_fname'],
							'mname' => $data['user_mname'],
							'lname' => $data['user_lname'], 
							'status' => $data['user_status'],
							'user_church' => $data['user_church'],
							'user_district' => $data['user_district']
						);
				$this->session->set_userdata($user_data);
				$action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Login to the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
				return FALSE;
			}
			else
			{
				return TRUE;
			}
			
		
	}
	

}

?>