<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->admin->login_check();
		//print_r($this->session->userdata());
		//exit;
	}   


	public function index()
	{
		
		/*$where1= array(		
						"user_token !="=>""
						);		
		$this->db->order_by('tbl_user.user_id','desc');
		$this->db->select('tbl_user.user_token');	
		$users_list=$this->admin->record_list('tbl_user',$where1);


		  $users=array();

		  if ($users_list) {
			  foreach ($users_list as $key => $value) {
			  	
			     $users[]=$value->user_token;

			  }
		  }

		  $quiz_message="Testing Phils push notification";

		$response=$this->admin->send_onesignal_message($users,$quiz_message);*/
		// echo "<pre>";
		// print_r($response);
		// exit;

		//complete old requisition
		
        /*$where=array(
        			'req_status'=>'0'
    				);

        $this->db->order_by('req_id','DESC');
        $this->db->join('tbl_stock_category','tbl_stock_category.stock_category_id=tbl_requisition.req_category_id');
        $this->db->join('tbl_stock_type','tbl_stock_type.stock_type_id=tbl_requisition.req_type_id');
        $this->db->join('tbl_stock_size','tbl_stock_size.stock_size_id=tbl_requisition.req_size_id', 'left');
        $this->db->join('tbl_job','tbl_job.job_id=tbl_requisition.req_job_id', 'left');
        $this->db->join('tbl_user','tbl_user.user_id=tbl_requisition.req_by_user_id', 'left');
        // $this->db->join('tbl_stock_uom','tbl_stock_uom.uom_id=tbl_stock.stock_uom_id', 'left');

		$this->db->join('tbl_requisition_assign','tbl_requisition_assign.assign_req_id=tbl_requisition.req_id', 'left');

		$this->db->group_by('tbl_requisition.req_id');
        $this->db->select('tbl_requisition.*,tbl_stock_type.stock_type_name,tbl_stock_size.stock_size_name,tbl_stock_category.stock_category_name,tbl_job.job_number,tbl_user.user_full_name,sum(tbl_requisition_assign.assign_quantity) assign_quantity');//
        $stock_record = $this->admin->record_list('tbl_requisition',$where);

        if($stock_record){
        	foreach ($stock_record as $key => $value) {
		        	
				$date1 = $value->req_created_on;
				$date2 = date('m/d/Y h:i:s a', time());;
				$timestamp1 = strtotime($date1);
				$timestamp2 = strtotime($date2);
				$hour_completed = round(abs($timestamp2 - $timestamp1)/(60*60));

				if($hour_completed>=36){

			        $data=array(
			            'req_status'=>'1',
			        );

					$where=array(
			            'req_id'=>$value->req_id,
			        );

			        $this->admin->records_update('tbl_requisition',$data,$where);
			
				}

	        }
        }
	    
	    $this->check_notification();


        $where=array(
					'tbl_job.job_location_id'=>$this->session->userdata('location_id'),
					'tbl_job.job_status'=>'1',
    				);
        $this->data['on_going_jobs'] = $this->admin->record_count('tbl_job',$where);
        
        $where=array(
					'tbl_job.job_location_id'=>$this->session->userdata('location_id'),
					'tbl_job.job_status'=>'2',
    				);
        $this->data['completed_jobs'] = $this->admin->record_count('tbl_job',$where);
        
        $where=array(
					'project_location_id'=>$this->session->userdata('location_id'),
					'employee_type'=>'1',
					'user_id !='=>'1',
    				);
        $this->data['permanant_workers'] = $this->admin->record_count('tbl_user',$where);
        
        $where=array(
					'project_location_id'=>$this->session->userdata('location_id'),
					'employee_type'=>'0',
					'user_id !='=>'1',
    				);
        $this->data['temp_workers'] = $this->admin->record_count('tbl_user',$where);
        
        $where=array(
					'req_location_id'=>$this->session->userdata('location_id'),
					'req_status'=>'0',
    				);
        $this->data['on_going_req'] = $this->admin->record_count('tbl_requisition',$where);
        
        $where=array(
					'req_location_id'=>$this->session->userdata('location_id'),
					'req_status'=>'1',
    				);
        $this->data['completed_req'] = $this->admin->record_count('tbl_requisition',$where);*/
        

		$this->data['page_title']="Dashboard";
		$this->load->view('dashboard',$this->data);
	}

	public function check_notification()
	{

        //delete notifications

        $where=array(
        			//'noti_user_id'=>$this->session->userdata('user_id')
    				);
        //$this->db->order_by('noti_id','DESC');
        //$this->db->limit(10000);
        $noti_record = $this->admin->record_list('tbl_notification',$where);
        

        if($noti_record){
        	foreach ($noti_record as $key => $value) {
		        	
				$date1 = $value->noti_created_on;
				$date2 = date('m/d/Y h:i:s a', time());;
				$timestamp1 = strtotime($date1);
				$timestamp2 = strtotime($date2);
				$hour_completed = round(abs($timestamp2 - $timestamp1)/(60*60));

				if($hour_completed>=48){
					//echo $value->noti_id .'<br>';
					$where=array(
			            'noti_id '=>$value->noti_id ,
			        );
			        $this->admin->records_delete('tbl_notification',$where);
			
				}

	        }
        }
	    
	}

	public function set_location()
	{
		if ($this->session->userdata('emp_type_id')!='1') {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Set Location";

		if (isset($_POST['btn_update_location'])) {
			
			$this->form_validation->set_rules('project_location_id','Location','required|xss_clean');
			
        	if($this->form_validation->run()){

		        $data=array(
		            'project_location_id'=>$this->input->post('project_location_id'),
		        );

	 			$where=array(
	        		'user_id'=>$this->input->post('user_id'),
		        );

		        $this->admin->records_update('tbl_user',$data,$where);


		        $where=array(
		        		'user_id'=>$this->session->userdata('user_id'),
		    				);
		        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name,tbl_employee_type.emp_type_id,tbl_employee_type.emp_type_access,tbl_project_location.location_name');
		        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
		        $this->db->join('tbl_project_location','tbl_project_location.location_id=tbl_user.project_location_id','Left');
		        $user_record = $this->admin->record_list('tbl_user',$where);
			 	
				$this->session->set_userdata('location_name',$user_record[0]->location_name);

				$this->session->set_flashdata('success_message',"Location saved successfully");

				redirect(base_url().'dashboard');
        	}

		}

        $where=array(
        				'user_id'=>$this->session->userdata('user_id')
    				);

        $this->data['user_info'] = $this->admin->record_list('tbl_user',$where);

        $where=array(
    				);
        $this->data['project_location'] = $this->admin->record_list('tbl_project_location',$where);

		$this->load->view('set_location/location',$this->data);
	}


    public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}

}
