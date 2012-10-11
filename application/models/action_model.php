<?php
class Action_model extends CI_Model{

    //selecting records according to churches
    public function viewStuff(){
       $owner = $this->session->userdata('user_church');
       $this->db->where('member_church', $owner);
       $this->db->order_by('member_id', 'desc');
       $query = $this->db->get("church_member");
       return $query->result();
    }
    
    //selecting requests according to churches
    public function viewRequests(){
       $owner = $this->session->userdata('user_church');
       $this->db->where('transfer_to', $owner);
       $this->db->order_by('transfer_id', 'desc');
       $this->db->join('church_member', 'church_transfer.transfer_member = church_member.member_code');
       $query = $this->db->get("church_transfer", 5, $this->uri->segment(3));
       return $query->result();
    }
    
    //inserting information of members
    public function insertRecord($data){
        $this->db->insert('church_member', $data);
       
    }
   
    //insert of action for the inserted member
    public function insertAction($data){
        $this->db->insert('church_member_action', $data);
    }
    
    //inserting References
    public function insertReference($data){
        $this->db->insert('church_reference', $data);
    }
    
    //deleting record
    public function deleteRecord($data){

        foreach($data as $row)
        {
            $code = $row->member_code;
        }
        $this->db->where('member_code',$code);
        $this->db->delete('church_member');
        $this->db->where('action_member',$code);
        $this->db->delete('church_member_action');
        
        $action = array(
                'action_user' => $this->session->userdata('username'),
                'action_made' => 'Deleted a Record from the System',
                'action_date' => date("y/m/d : H:i:s", time())
        );
        //insertion login action to the church_actions table
        //$this->db->insert('church_actions', $action);
    }
    
    //selecting of records
    public function selectRecord(){
        $code = $this->uri->segment(3);
        $this->db->select('church_reference.*, church_member_action.*, church_member.*');
        $this->db->from('church_member');
        $this->db->where("member_code",$code);
        $this->db->join('church_reference', 'church_member.member_code = church_reference.reference_member');
        $this->db->join('church_member_action', 'church_member.member_code = church_member_action.action_member');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
   
    //select member code for deletion of records
    public function selectDelete(){
        $code = $this->uri->segment(3);
        $this->db->select('member_code');
        $this->db->where('member_code', $code);
        $query = $this->db->get('church_member');
        
        return $query->result();
    }
    
    //selecting of actions
    public function selectAction(){
        $code = $this->uri->segment(3);
        $this->db->where('action_member', $code);
        $query = $this->db->get('church_member_action');
        
        return $query->result();
    }
    
      
   //update Records
    public function updateRecord($data){
        $code = $this->uri->segment(3);
        $this->db->where('member_code', $code);
        $this->db->update('church_member', $data);
        
        $action = array(
                'action_user' => $this->session->userdata('username'),
                'action_made' => 'Updated a Record the System',
                'action_date' => date("y/m/d : H:i:s", time())
        );
        //insertion login action to the church_actions table
        //$this->db->insert('church_actions', $action);
    }
    
    //update Actions
    public function updateAction($data){
        $this->db->where('action_member', $data['action_member']);
        $this->db->update('church_member_action', $data);
    }
    
    //checking information of the admin if correct for backup purposes
    public function check($user_church, $user_district){
       $this->db->where('user_church', $user_church);
       $this->db->where('user_district', $user_district);
       $query = $this->db->get('church_user');
       $n = 0;
			
			foreach($query->result() as $row)
			{
				$n++;
				
			}
			
			if($n != 0)
			{
				
				return TRUE;
			}
			else
			{
				return FALSE;
			}
        
    }
    
    //check of the record already exists
    public function checkRecord($data){
        
        $this->db->where('member_fname', $data['member_fname']);
        $this->db->where('member_mname', $data['member_mname']);
        $this->db->where('member_lname', $data['member_lname']);
        $this->db->where('member_address', $data['member_address']);
        $this->db->where('member_gender', $data['member_gender']);
        $this->db->where('member_bdate', $data['member_bdate']);
        $this->db->where('member_church', $data['member_church']);
        $this->db->where('member_district', $data['member_district']);
        $query = $this->db->get('church_member',$data);
        
        $n = 0;
        
        foreach($query->result() as $row)
        {
            $n++;
        }
        
        if($n != 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    //get all minutes of meeting
    public function getMeeting(){
        $this->db->where('meeting_church', $this->session->userdata('user_church'));
        $this->db->order_by('meeting_id', 'desc');
        $query = $this->db->get('church_meeting');
        
        return $query->result();
    }
    
    //insert minutes of meeting
    public function insertMeeting($data){
        $this->db->insert('church_meeting', $data);
        $action = array(
                'action_user' => $this->session->userdata('username'),
                'action_made' => 'Added Minutes of Meeting to the System',
                'action_date' => date("y/m/d : H:i:s", time())
        );
        //insertion login action to the church_actions table
        //$this->db->insert('church_actions', $action);
    }
    
    //select churches
    public function selectChurches(){
        $query = $this->db->get('church_lists');
        
        return $query->result();
    }
    
    //get pending transfer requests
    public function pendingRequests(){
        $owner = $this->session->userdata('user_church');
	$sql ="SELECT COUNT(*) AS count FROM church_transfer WHERE transfer_to = '{$owner}' AND transfer_status = 'pending'";
	$query = $this->db->query($sql);
	return $query->row()->count;
    }
    
    //insert pending requests
    public function insertRequest($data){
        $this->db->insert('church_transfer', $data);
    }
    
    //check if request already exists
    public function checkRequest($data){
        $this->db->where('transfer_member', $data['transfer_member']);
        $this->db->where('transfer_to', $data['transfer_to']);
        $this->db->where('transfer_from', $data['transfer_from']);
        $this->db->where('transfer_status', $data['transfer_status']);
        $query = $this->db->get('church_transfer');
        
        $n = 0;
        
        foreach($query->result() as $row)
        {
            $n++;
        }
        
        if($n == 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    //view meeting contents
    public function viewMeeting(){
        $id = $this->uri->segment(3);
        $this->db->where('meeting_id', $id);
        $query = $this->db->get('church_meeting');
        
        return $query->result();
    }
    
    //get action to update
    public function getTransfer(){
        $id = $this->uri->segment(3);
        $this->db->where('action_member', $id);
        $query = $this->db->get('church_member_action');
        
        return $query->result();
    }
    
    //update transfer of membership
    public function acceptTransfer($code, $data){
        $this->db->where('action_member', $code);
        $this->db->update('church_member_action', $data);
    }
    
    //get district of church to transfer
    public function getDistrict($church){
        $this->db->where('church_name', $church);
        $query = $this->db->get('church_lists');
        
        return $query->result();
    }
    
    //change membership
    public function changeMembership($data, $code){
        $this->db->where('member_code', $code);
        $this->db->update('church_member', $data);
    }
    
    //cancel transfer
    public function cancelTransfer($code, $data){
        $this->db->where('action_member', $code);
        $this->db->update('church_member_action', $data);
    }
    
    //delete meetings
    public function deleteMeeting($id){
        $this->db->where('meeting_id', $id);
        $this->db->delete('church_meeting');
    }
    
    //add disciplinary action
    public function insertDiscipline($data){
        $this->db->insert('church_discipline', $data);
    }
    
    //update disciplinary action
    public function updateDiscipline($code, $data){
        $this->db->where('discipline_member', $code);
        $this->db->update('church_discipline', $data);
    }
    
    //delete disciplinary action
    public function deleteDiscipline($code){
        $this->db->where('discipline_member', $code);
        $this->db->delete('church_discipline');
    }
    
    //get disciplinary actions
    public function getDiscipline(){
        $code = $this->uri->segment(3);
        $this->db->where('discipline_member', $code);
        $query = $this->db->get('church_discipline');
        
        return $query->result();
    }
    
    //admin create account
    public function createAccount($data){
        $this->db->insert('church_user');
    }
    
    //user update account
    public function updateAccount($id, $data){
        $this->db->where('user_id', $id);
        $this->db->update('church_user', $data);
    }
    
    //admin delete account
    public function deleteAccount($id){
        $this->db->where('user_id', $id);
        $this->db->delete('church_user');
    }
    
    //view users
    public function getAccount(){
       $this->db->order_by('user_id', 'desc');
       $query = $this->db->get("church_member", 10, $this->uri->segment(3));
       
       return $query->result();
    }
    
    //view audit trail
    public function getAudit(){
       $this->db->order_by('action_id', 'desc');
       $query = $this->db->get("church_actions", 10, $this->uri->segment(3));
       
       return $query->result();
    }
    
    public function approve($data1, $data2){
        $id = $this->uri->segment(3);
        $this->db->where('action_member', $id);
        $this->db->update('church_member_action', $data1);
        $this->db->where('member_code', $id);
        $this->db->update('church_member', $data2);
        $this->db->where('transfer_member', $id);
        $this->db->delete('church_transfer');
    }
    
    public function disfellowUpdate($data){
        $id = $this->uri->segment(3);
        $this->db->where('action_member', $id);
        $this->db->update('church_member_action', $data);
    }
    
    
    
  
}
?>
