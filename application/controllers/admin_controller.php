<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

	public function __construct(){
			
				parent::__construct();
				
				$this->load->helper('form');
				$this->load->library("form_validation");
				$this->load->library('session');
				
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
		$data['main_content'] = "welcome_admin";
		$this->load->view('admin/templates', $data);
	}
        
        //activity page
        public function activity(){
            $data['main_content'] = 'sampleA';
            $this->load->view('admin/templates', $data);
        }
        
        //account page
        public function accounts(){
            $data['main_content'] = 'sampleA';
            $this->load->view('admin/templates', $data);
        }
	
        //logout of account
	public function logout(){
			$this->session->sess_destroy();
			$data['error'] = '';
			$this->load->view('login', $data);
	}
        
        //checking of information before backup of database
        public function check(){
           
                $data = array(
                    'user_church' => $this->input->post('user_church'),
                    'user_district' => $this->input->post('user_district')
                );
                
                $this->load->model('action_model');
                
                $chk = $this->action_model->check($data['user_church'], $data['user_district']);
                
                if($chk == TRUE)
                {
                    $this->backupDB();
                }
                else
                {
                    $this->index();
                }
                
           
        }
        
        //backup database
        public function backupDB(){
            // Load the DB utility class
            $this->load->dbutil();

            // Backup your entire database and assign it to a variable
            $prefs = array(
                'format'      => 'txt',             // gzip, zip, txt
                'filename'    => 'backup_area_records_'.date("y/m/d : H:i:s", time()).'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );
            $backup =& $this->dbutil->backup($prefs);

            // Load the file helper and write the file to your server
            $this->load->helper('file');
            write_file('/path/to/backup_area_records_'.date("y/m/d : H:i:s", time()).'.txt', $backup);

            // Load the download helper and send the file to your desktop
            $this->load->helper('download');
            force_download('backup_area_records_'.date("y/m/d : H:i:s", time()).'.txt', $backup); 
            
            redirect('admin_controller');
        }
}

