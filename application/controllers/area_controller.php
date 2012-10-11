<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area_controller extends CI_Controller {

	public function __construct(){
			
				parent::__construct();
				
				$this->load->helper('form');
				$this->load->library("form_validation");
				$this->load->library('session');
                                $this->load->library('pagination');
				
				//determines if there is a user already logged in to the syste
				if(!$this->session->userdata('user_id'))
				{
					redirect('login_controller');
				}
				
				
	}

	public function index()
	{
		$this->home();
	}
	
	//home page
	public function home(){
                $this->load->model('action_model');
                $cnt = $this->action_model->pendingRequests();
                if($cnt == 0)
                {
                     $data['pending'] = 'You Have No Membership Transfer Requests';
                }    
                else
                {
                    $data['pending'] = '<a href="'.base_url().'area_controller/requests">You Have '.$cnt.' Number of Membership Transfer Request/s.</a>';
                }
		$data['main_content'] = 'welcome';
                
		$this->load->view('includes/template',$data);
	}
	
	//add member page
	public function records(){
                 $this->load->model("action_model");
		 $data = array(
                    'main_content' => 'addMember',
                    'records' => $this->action_model->viewStuff(),
                    'error' => ''
                 );
		 $this->load->view("includes/template" , $data);
			
		
			
	}
        
        //Members
        public function Members(){
             $this->load->model("action_model");
             $data = array(
		'records' => $this->action_model->viewStuff(),
             );
             $this->load->view('Members',$data);
        }
        
        //adding of member
        public function addMember(){
            //setting of rules for the forms
            $this->form_validation->set_rules('member_fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('member_mname', 'Middle Name', 'trim|required');
            $this->form_validation->set_rules('member_lname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('member_address', 'Address', 'trim|required');
            $this->form_validation->set_rules('member_bdate', 'Date of Birth', 'trim|required');
            $this->form_validation->set_rules('member_book', 'Book Number', 'required|trim|numeric');
            $this->form_validation->set_rules('member_page', 'Page Number', 'required|trim|numeric');
            //checking of rules are true
            if($this->input->post('submit_record') == TRUE && $this->form_validation->run() == TRUE){	
		$this->load->model("action_model");
                    $time = strtotime($this->input->post('member_bdate'));
                    $bdate = date( 'y/m/d H:i:s', $time );
                    
		$data = array(
                            'member_fname' => $this->input->post('member_fname'),
                            'member_mname' => $this->input->post('member_mname'),
                            'member_lname' => $this->input->post('member_lname'),
                            'member_address' => $this->input->post('member_address'),
                            'member_bdate' => $this->input->post('member_bdate'),
                            'member_gender' => $this->input->post('member_gender'),
                            'member_status' => $this->input->post('member_status'),
                            'member_input' => $this->session->userdata('username'),
                            'member_code' => $this->input->post('member_code'),
                            'member_date' => date("y/m/d : H:i:s", time()),
                            'member_church' => $this->session->userdata('user_church'),
                            'member_district' => $this->session->userdata('user_district')
                            
						);
		$data2 = array(
                        'action_member' => $this->input->post('member_code')                    
                );
                
                $data3 = array(
                    'reference_member' => $this->input->post('member_code'),
                    'reference_book' => $this->input->post('member_book'),
                    'reference_page' => $this->input->post('member_page')
                );
                
                $chk = $this->action_model->checkRecord($data);
                
                    if($chk == FALSE)
                    {
                        $this->action_model->insertRecord($data);
                        $this->action_model->insertAction($data2);
                        $this->action_model->insertReference($data3);
                        $action = array(
                                'action_user' => $this->session->userdata('username'),
                                'action_made' => 'Added New Record to the System',
                                'action_date' => date("y/m/d : H:i:s", time())
                        );
                        //insertion login action to the church_actions table
                        //$this->db->insert('church_actions', $action);
                        redirect('area_controller/records');
                        
                    }
                    else
                    {
                       redirect('area_controller/records/fail');
                    }
		   }else{
			   
				
				$this->records();   
			   
		   }
        }
	        
        //deleting of records
        public function deleteRecord(){
			
            $this->load->model("action_model");
            $data = $this->action_model->selectDelete();
            $this->action_model->deleteRecord($data);
            $action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Deleted a Record to the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
            redirect('area_controller/records');
			
        }
        
        //Viewing of records
        public function viewRecord(){
            $this->load->model("action_model");
	    $data["main_content"] = "Views";
            $data["results"] = $this->action_model->selectRecord();
            $data["churches"] = $this->action_model->selectChurches();
            $data["discipline"] = $this->action_model->getDiscipline();
            
            $this->load->view("includes/template" , $data);
        }
        
        //see Update Record
        public function updateRecord(){
            $this->load->model('action_model');
            $data = array(
                'main_content' => 'updateRecord',
                'result' => $this->action_model->selectRecord(),
                'action' => $this->action_model->selectAction()
                    
            );
            $this->load->view('includes/template', $data);
        }
        
        //process Updating of Records
        public function updateRecords(){
            $this->load->model('action_model');
            $this->form_validation->set_rules('member_fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('member_mname', 'Middle Name', 'trim|required');
            $this->form_validation->set_rules('member_lname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('member_address', 'Address', 'trim|required');
            $this->form_validation->set_rules('member_bdate', 'Date of Birth', 'trim|required');
            
            if($this->input->post('submit_record') == TRUE && $this->form_validation->run() == TRUE){	
		    $time = strtotime($this->input->post('member_bdate'));
                    $bdate = date( 'y/m/d H:i:s', $time );
                    $age = date("y/m/d : H:i:s", time()) - $bdate;
		$data = array(
                            'member_fname' => $this->input->post('member_fname'),
                            'member_mname' => $this->input->post('member_mname'),
                            'member_lname' => $this->input->post('member_lname'),
                            'member_address' => $this->input->post('member_address'),
                            'member_bdate' => $this->input->post('member_bdate'),
                            'member_age' => $age,
                            'member_gender' => $this->input->post('member_gender'),
                            'member_status' => $this->input->post('member_status'),
                            'member_input' => $this->session->userdata('username'),
                            'member_date' => date("y/m/d : H:i:s", time()),
                );
		$data2 = array(
                        'action_member' => $this->input->post('member_code')                    
                );
                
                $chk = $this->action_model->checkRecord($data);
                
                    if($chk == FALSE)
                    {
                        $this->action_model->updateRecord($data);
                        $this->action_model->updateAction($data2);
                        $action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Updated a Record to the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
                        redirect('area_controller/updateRecord/'.$this->input->post('member_code'));
                    }
                    else
                    {
                       redirect('area/controller/updateRecord/'.$this->input->post('member_code').'/fail');
                    }
				
		   }else{
			   
				
				redirect('area/controller/updateRecord/'.$this->input->post('member_code'));
			   
		   }
            
        }
        
        //meeting page
        public function meetings(){
            $this->load->model("action_model");
            $data = array(
                'main_content' => 'meetings',
		'records' => $this->action_model->getMeeting(),
            );
            $this->load->view("includes/template" , $data);
        }
        
        //minutes of meeting
        public function minutes($start = 0){
            $this->load->model("action_model");
            $data = array(
                'records' => $this->action_model->getMeeting(),
            );
            $this->load->view("minutes" , $data);
        }
        
        //add Meeting Interface
        public function addMeeting(){
            $data['main_content'] = 'addMeeting';
            $this->load->view('includes/template',$data);
        }
        
        public function processMeeting(){
            $Nmonth = substr(date('Y/m/d'), 5, 2);
            
            $MyDate = '';
            switch($Nmonth)
            {
                case 1:
                    $MyDate = 'January '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 2:
                    $MyDate = 'February '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 3:
                    $MyDate = 'March '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 4:
                    $MyDate = 'April '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 5:
                    $MyDate = 'May '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 6:
                    $MyDate = 'June '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 7:
                    $MyDate = 'July '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 8:
                    $MyDate = 'August '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 9:
                    $MyDate = 'September '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 10:
                    $MyDate = 'October '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 11:
                    $MyDate = 'November '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
                case 12:
                    $MyDate = 'December '.substr(date('Y/m/d'), 8, 2).', '.substr(date('Y/m/d'), 0, 4);
                    break;
            }
            echo $this->input->post('meeting').'<br>'.$MyDate;
            
            $data = array(
                'meeting_agenda' => $this->input->post('meeting'),
                'meeting_church' => $this->session->userdata('user_church'),
                'meeting_date' => $MyDate
            );
            
            $this->form_validation->set_rules('meeting', 'Meeting', 'required');
            
            if($this->form_validation->run() == TRUE)
            {
                $this->load->model('action_model');
                $this->action_model->insertMeeting($data);
                $action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Added a Meeting to the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
                redirect('area_controller/meetings');
            }
        }
        
        //Viewing of Minutes of Meeting
        public function viewMeeting(){
            $this->load->model('action_model');
            $data = array(
                'main_content' => 'viewMeeting',
                'results' => $this->action_model->viewMeeting()
            );
            $this->load->view('includes/template',$data);
        }
        
        //updating actions
        public function processUpdateAction(){
            $dismiss = $this->input->post('action_dismiss');
            $minister = $this->input->post('action_minister');
            $ddate = $this->input->post('action_dismiss_date');
            $rdate = $this->input->post('action_receive_date');
            
            if(!empty($minister) || !empty($ddate) || !empty($rdate))
            {
                if($dismiss == 'Letter')
                {
                   if($this->session->userdata('user_church') != $this->input->post('action_church'))
                    {
                        $data = array(
                            'transfer_member' => $this->input->post('action_member'),
                            'transfer_to' => $this->input->post('action_church'),
                            'transfer_from' => $this->session->userdata('user_church'),
                            'transfer_status' => 'pending'
                        );
                        $data1 = array(
                            'action_member' => $this->input->post('action_member'),
                            'action_dismiss' => 'Transfer Request of Member is still in Process'
                        );
                        $this->load->model('action_model');
                        $chk = $this->action_model->checkRequest($data);
                        if($chk == TRUE)
                        {
                           $this->action_model->insertRequest($data);
                           $this->action_model->updateAction($data1);
                           redirect('area_controller/viewRecord/'.$this->input->post('action_member'));
                        }
                        else
                        {
                            redirect('area_controller/viewRecord/'.$this->input->post('action_member').'/1');
                        }
                    }
                    else
                    {
                        redirect('area_controller/viewRecord/'.$this->input->post('action_member').'/2');
                    }
                }
                else
                {
                    $data = array(
                        'action_member' => $this->input->post('action_member'),
                        'action_receive' => $this->input->post('action_receive'),
                        'action_minister' => $this->input->post('action_minister'),
                        'action_receive_date' => $this->input->post('action_receive_date'),
                        'action_dismiss' => $this->input->post('dismiss'),
                        'action_dismiss_date' => $this->input->post('action_dismiss_date')
                    );
                    $this->load->model('action_model');
                    $this->action_model->updateAction($data);
                    redirect('area_controller/viewRecord/'.$this->input->post('action_member'));
                }
                $action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Sent a Request via the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
            }
            
            
   
        }
        
        //view requests
        public function requests($start = 0){
            $this->load->model('page_model');
            $this->load->model("action_model");
			
	    // Determine the number of results to display per page
            $results_per_page_front = $this->config->item('results_per_page_front');
	    $for_update_url = $this->config->item('for_update_url');
            $view_url = $this->config->item('view_url');
            
            // Load the model, perform the search and establish the total
            // number of results

            $results = $this->page_model->search_all($results_per_page_front);
			
            $total_results = $this->page_model->count_request();
 			
			// Call a method to setup pagination
            $this->_setup1_pagination('/area_controller/requests/' , $total_results, $results_per_page_front);
			
			$first_result = $start + 1;
            $last_result = min($start + $results_per_page_front, $total_results);
 
		
			$data = array(
				'main_content' => 'requests',
				'results' => @$results,
				'total_results' => @$total_results,
				'first_result' => $first_result,
				'last_result' => $last_result, 
                                'for_update_url' => $for_update_url,
                                'view_url' => $view_url,
                                'records' => $this->action_model->viewRequests(),
                                
	  
					);
			
			$this->load->view("includes/template" , $data);
        }
        
        //view details of member to transfer
        public function viewRequest(){
            $this->load->model('action_model');
            $data = array(
                'main_content' => 'viewMember',
                'results' => $this->action_model->selectRecord()
            );
            $this->load->view('includes/template', $data);
           
        }
        
        //approve transfer requests
        public function approve(){
            $data = array(
                'action_receive' => 'Letter',
                'action_minister' => $this->session->userdata('lname').", ".$this->session->userdata('fname')." ".$this->session->userdata('mname'),
                'action_receive_date' => date("y/m/d", time()),
                'action_dismiss' => 'Letter',
                'action_dismiss_date' => date("y/m/d", time())
            );
            $data2 = array(
                'member_church' => $this->session->userdata('user_church'),
                'member_district' => $this->session->userdata('user_district')
            );
            $this->load->model('action_model');
            $this->action_model->approve($data, $data2);
            redirect('area_controller/records');
            
            
        }
        
        //delete inputed minutes of meeting
        public function deleteMeeting(){
            $this->load->model('action_model');
            $id = $this->uri->segment(3);
            $this->action_model->deleteMeeting($id);
            $action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Deleted a Meeting to the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
            
            redirect('area_controller/meetings');
        }
        
        //cancel requests
        public function deleteRequest(){
            $this->load->model('action_model');
            $this->action_model->deleteRequest();
             $cnt = $this->action_model->pendingRequests();
                if($cnt == 0)
                {
                     redirect('area_controller');
                }    
                else
                {
                    redirect('area_controller/requests');
                }
        }
        
        //add disciplinary action
        public function addDiscipline(){
            $this->load->model('action_model');
            $id = $this->input->post('discipline_member');
            $this->form_validation->set_rules('discipline_reason', 'Reason' , 'trim}required');
            
            if($this->form_validation->run() == TRUE)
            {
                if($this->input->post('discipline_action') == 'disfellow')
                {
                    $data = array(
                        'action_dismiss' => $this->input->post('discipline_action'),
                        'action_dismiss_date' => date("y/m/d : H:i:s", time())
                    );
                    $data2 = array(
                        'discipline_member' => $id,
                        'discipline_reason' => $this->input->post('discipline_reason'),
                        'discipline_action' => $this->input->post('discipline_action'),
                        'discipline_church' => $this->session->userdata('user_church'),
                        'discipline_district' => $this->session->userdata('user_district'),
                        'discipline_date' => date("y/m/d : H:i:s", time())
                    );
                    $action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Added Disciplinary Action to the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
                    $this->action_model->disfellowUpdate($data);
                    $this->action_model->insertDiscipline($data2);
                    redirect('area_controller/viewRecord/'.$this->input->post('action_member'));
                }
                else
                {
                    $data = array(
                        'discipline_member' => $id,
                        'discipline_reason' => $this->input->post('discipline_reason'),
                        'discipline_action' => $this->input->post('discipline_action'),
                        'discipline_church' => $this->session->userdata('user_church'),
                        'discipline_district' => $this->session->userdata('user_district'),
                        'discipline_date' => date("y/m/d : H:i:s", time())
                    );
                    
                    $action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Added Disciplinary Action to the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
                    
                    $this->action_model->insertDiscipline($data);
                    redirect('area_controller/viewRecord/'.$this->input->post('discipline_member'));
                }
                
            }
            else
            {
                 redirect('area_controller/viewRecord/'.$this->input->post('discipline_member').'/3');
            }
        }
        
        //edit disciplinary action
        public function editDiscipline(){
            $this->load->model('action_model');
            $id = $this->input->post('code');
            $this->form_validation->set_rules('discipline_reason', 'Reason' , 'trim}required');
            
            if($this->form_validation->run() == TRUE)
            {
                if($this->input->post('discipline_action') == 'disfellow')
                {
                    $data = array(
                        'action_dismiss' => $this->input->post('discipline_action'),
                        'action_dismiss_date' => date("y/m/d : H:i:s", time())
                    );
                    $data2 = array(
                        'discipline_reason' => $this->input->post('discipline_reason'),
                        'discipline_action' => $this->input->post('discipline_action'),
                        'discipline_church' => $this->session->userdata('user_church'),
                        'discipline_district' => $this->session->userdata('user_district'),
                        'discipline_date' => date("y/m/d : H:i:s", time())
                    );
                    $action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Added Disciplinary Action to the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
                    $this->action_model->disfellowUpdate($data);
                    $this->action_model->updateDiscipline($id, $data2);
                    redirect('area_controller/viewRecord/'.$this->input->post('action_member'));
                }
                else
                {
                    $data = array(
                        'discipline_reason' => $this->input->post('discipline_reason'),
                        'discipline_action' => $this->input->post('discipline_action'),
                        'discipline_church' => $this->session->userdata('user_church'),
                        'discipline_district' => $this->session->userdata('user_district'),
                        'discipline_date' => date("y/m/d : H:i:s", time())
                    );
                    
                    $action = array(
					'action_user' => $this->session->userdata('username'),
					'action_made' => 'Added Disciplinary Action to the System',
					'action_date' => date("y/m/d : H:i:s", time())
				);
				//insertion login action to the church_actions table
				//$this->db->insert('church_actions', $action);
                    
                    $this->action_model->updateDiscipline($id, $data);
                    redirect('area_controller/viewRecord/'.$this->input->post('discipline_member'));
                }
                
            }
            else
            {
                 redirect('area_controller/viewRecord/'.$this->input->post('discipline_member').'/3');
            }
        }
        
        //delete input in disciplinary action
        public function deleteDiscipline(){
            $this->load->model('action_model');
            $code = $this->uri->segment(3);
            $this->action_model->deleteDiscipline($code);
            redirect('area_controller/viewRecord/'.$this->uri->segment(3));
        }
        
        //logout function
	public function logout(){
			$this->session->sess_destroy();
			$data['error'] = '';
			redirect('area_controller');
	}
        
        //pagination setup function
        public function _setup_pagination($url, $total_results, $results_per_page)
    	 {
		
                $uri_segment = count(explode('/', $url));
 
                // Initialise the pagination class, passing in some minimum parameters
                $config['base_url'] = "http://localhost/area_record".$url;
		$config['total_rows'] = $total_results;
		$config['per_page'] = $results_per_page;
		$config['full_tag_open'] = '<div id="paginations">';
		$config['full_tag_close'] = '</div>';
		
		$this->pagination->initialize($config);
		
    }
	
        public function _setup1_pagination($url, $total_results, $results_per_page_front){
		
        $uri_segment = count(explode('/', $url));
 
        // Initialise the pagination class, passing in some minimum parameters
		
		$config['base_url'] = "http://localhost/area_record".$url;
		$config['total_rows'] = $total_results;
		$config['per_page'] = $results_per_page_front;
		$config['full_tag_open'] = '<div id="paginations">';
		$config['full_tag_close'] = '</div>';

		$this->pagination->initialize($config);
		
        }
        
        
        
        
}

