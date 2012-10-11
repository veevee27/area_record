<?php
class Page_model extends CI_Model
{
   //records
   public function search($terms, $results_per_page = 0)
    {
		// Determine whether we need to limit the results
        if ($results_per_page > 0)
        {
            $limit = "$results_per_page";
        }
        else
        {
            $limit = '';
        }
		
       // Execute our SQL statement and return the result
	    $owner = $this->session->userdata('user_church');
		$this->db->order_by('member_id', 'desc');
		$this->db->like('member_fname',$terms);			
                $query = $this->db->get_where('church_member', 'member_church = "'.$owner.'"' , $limit , $this->uri->segment(3));
        return $query->result();
    }
	
	
	public function count_search_results($terms)
    {
		$owner = $this->session->userdata('user_church');
		 // Run SQL to count the total number of search results
        $sql = "SELECT COUNT(*) AS count
                    FROM church_member
                    WHERE member_fname LIKE '%$terms%' AND member_church = ".$owner;
        $query = $this->db->query($sql, array($terms));
        return $query->row()->count;
    }
	
	public function search_all($results_per_page_front = 0)
    {
        // Determine whether we need to limit the results
        if ($results_per_page_front > 0)
        {
            $limit = "$results_per_page_front";
        }
        else
        {
            $limit = '';
        }
		 $owner = $this->session->userdata('user_church');
		 $this->db->order_by('member_id', 'desc');
                 $query = $this->db->get('church_member' , 5 , $this->uri->segment(3));
		 return $query->result();
    }
	
	
	public function count_data(){
		$owner = $this->session->userdata('user_church');
		$sql ="SELECT COUNT(*) AS count FROM church_member WHERE member_church = '{$owner}'";
		$query = $this->db->query($sql);
		return $query->row()->count	;
		
	}
        
    //meetings
        public function count_meeting(){
		$owner = $this->session->userdata('user_church');
		$sql ="SELECT COUNT(*) AS count FROM church_meeting WHERE meeting_church = '{$owner}'";
		$query = $this->db->query($sql);
		return $query->row()->count;
		
	}
        
        //request
        public function count_request(){
		$owner = $this->session->userdata('user_church');
		$sql ="SELECT COUNT(*) AS count FROM church_transfer WHERE transfer_to = '{$owner}'";
		$query = $this->db->query($sql);
		return $query->row()->count;
		
	}
        
        //users
        public function count_users(){
		$sql ="SELECT COUNT(*) AS count FROM church_user";
		$query = $this->db->query($sql);
		return $query->row()->count;
		
	}
        
        //audit logs
        public function count_actions(){
		$sql ="SELECT COUNT(*) AS count FROM church_actions";
		$query = $this->db->query($sql);
		return $query->row()->count;
		
	}
}

?>