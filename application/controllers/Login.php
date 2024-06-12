<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		if ($this->session->userdata('user_id') && $this->session->userdata('emp_type_id')) {
			redirect(base_url().'dashboard');
		}

		//$this->data;

		if (isset($_POST['btn_submit_login'])) {
				
			$this->form_validation->set_rules('user_phone_number','Mobile Number','required|xss_clean|min_length[10]|max_length[10]|numeric');
			
			$this->form_validation->set_rules('user_password','Password','required|xss_clean|min_length[4]');
			
        	if($this->form_validation->run()){

		        $where=array(
		        		'user_phone_number'=>$this->input->post('user_phone_number'),
		        		'user_password'=>md5($this->input->post('user_password')),
		        		'user_status'=>'0',
		    				);
		        $user_record = $this->admin->record_list('tbl_user',$where);
		        
		        if($user_record){

					$this->session->set_flashdata('failed_message',"Your account has been disabled, Please contact your system administrator");
					//exit;
					redirect(base_url());
		        }

			 
		        $where=array(
		        		'user_phone_number'=>$this->input->post('user_phone_number'),
		        		'user_password'=>md5($this->input->post('user_password')),
		        		'user_status'=>'1',
		    				);
		        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name,tbl_employee_type.emp_type_id,tbl_employee_type.emp_type_access,tbl_project_location.*');
		        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
		        $this->db->join('tbl_project_location','tbl_project_location.location_id=tbl_user.project_location_id','Left');
		        $user_record = $this->admin->record_list('tbl_user',$where);
			 	
			 	if ($user_record) {
				        	//exit;
					$this->session->set_userdata('user_id',$user_record[0]->user_id);
					//$this->session->set_userdata('user_name',$user_record[0]->user_name);
					$this->session->set_userdata('user_full_name',$user_record[0]->user_full_name);
					$this->session->set_userdata('emp_type_id',$user_record[0]->emp_type_id);
					$this->session->set_userdata('emp_type_access',$user_record[0]->emp_type_access);
					
					$this->session->set_userdata('emp_type_name',$user_record[0]->emp_type_name);
					//$this->session->set_userdata('user_employee_id',$user_record[0]->user_employee_id);
					$this->session->set_userdata('user_phone_number',$user_record[0]->user_phone_number);
					$this->session->set_userdata('location_id',$user_record[0]->location_id);
					$this->session->set_userdata('location_name',$user_record[0]->location_name);

					//if($user_record[0]->user_employee_type=="1"){

					$this->session->set_userdata('user_verification','1');

					redirect(base_url());
					
						/*echo "<pre>";
						print_r($this->session->userdata());
						exit;*/
						//redirect(base_url().'dashboard/set_location');

						
					/*}else{
						//user_otp

				        $user_otp=rand ( 1000 , 9999 );

			 			$where=array(

			        		'user_name'=>$this->input->post('user_name'),
			        		'user_password'=>md5($this->input->post('user_password')),
			        		'user_status'=>'1',

				        );

				        $data=array(

			                'user_otp'=>$user_otp,

				        );

				        $this->admin->records_update('tbl_user',$data,$where);

						$this->session->set_userdata('user_verification','0');
						redirect(base_url().'verification');
						
					}*/



	        	}else
	        	{
	        		$this->data['failed_message']="Username or password incorrect";
	        	}
	        }

		}

		$this->data['page_title']="";
		$this->load->view('sign-in');
	}

	public function verification()
	{

		if(!$this->session->userdata('user_id') || !$this->session->userdata('user_employee_id')){

			$this->session->sess_destroy();
			redirect(base_url());

		}else{
			
			$this->form_validation->set_rules('user_otp[]','OTP','required');

        	if($this->form_validation->run()){
        		
        		$user_otp=implode("", $this->input->post('user_otp'));
        		

		        $where=array(
		        		'user_id'=>$this->session->userdata('user_id'),
		        		'user_otp'=>$user_otp,
		    				);
		        $user_record = $this->admin->record_list('tbl_user',$where);
			 	
		 		if ($user_record) {
		 			//exit;
		 			$where=array(
		        		'user_id'=>$this->session->userdata('user_id'),
			        );
			        $data=array(
		            	'user_otp_tried'=>'0',
			        );
			        $this->admin->records_update('tbl_user',$data,$where);


					$this->session->set_userdata('user_verification','1');
					redirect(base_url());

		        }else{

			        $where=array(
			        		'user_id'=>$this->session->userdata('user_id'),
			    				);
			        $user_record = $this->admin->record_list('tbl_user',$where);
				 	
				 	$user_otp_tried=$user_record[0]->user_otp_tried+1;

		 			$where=array(
		        		'user_id'=>$this->session->userdata('user_id'),
			        );
			        $data=array(
		            	'user_otp_tried'=>$user_otp_tried,
			        );
					if ($user_otp_tried>=3) {
		            	$data['user_otp_tried']='0';
		            	$data['user_status']='0';
					}
			        $this->admin->records_update('tbl_user',$data,$where);


					if ($user_otp_tried>=3) {

						$this->session->unset_userdata('user_id');

						$this->session->unset_userdata('user_employee_id');

						$this->session->set_flashdata('failed_message',"Your account has been disabled, Please contact your system administrator");

						redirect(base_url());
					}

					$this->session->set_flashdata('failed_message',"OTP is invalid");
					
					redirect(base_url().'verification');

		        }

        	}

		}

		$this->load->view('two-steps');
	}

	public function user_list()
	{
		$this->load->view('users/list');
	}
	
	public function user_view()
	{
		$this->load->view('users/view');
	}

}
