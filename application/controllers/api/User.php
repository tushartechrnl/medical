<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  	public $project_location_id;

  	public $user_id;

  	public $access_module;

	public function __construct()
	{
		parent::__construct();

        $response = array();
    
		$headers=array();
		foreach (getallheaders() as $name => $value) {
		    
		    $headers[ucfirst($name)] = $value;
		}

        if (isset($headers['Usertoken']) && isset($headers['Userid']) &&  isset($headers['Projectlocationid'])) {

        	$this->project_location_id=$headers['Projectlocationid'];
    	
        	$this->user_id=$headers['Userid'];

	        $where=array(
	        				'user_id'=>$headers['Userid'],
	        				'user_token'=>$headers['Usertoken'],
	    				);
	        $user_record = $this->admin->record_list('tbl_user',$where);

        	if(isset($user_record[0])){

		        if ($_SERVER["REQUEST_METHOD"] == "POST") {

		        } else {
		            $response['message'] = 'Invalid Request';
		            $response['code'] = 201;
		            $response['status'] = false;
		        	echo json_encode($response);
		        	exit;
		        }	

        	}else{

	            $response['message'] = 'Invalid user request';
	            $response['code'] = 202;
	            $response['status'] = false;
	        	echo json_encode($response);
	        	exit;
        	}

        }else{

            $response['message'] = 'Invalid headers';
            $response['code'] = 201;
            $response['status'] = false;
        	echo json_encode($response);
        	exit;
        }


        $where=array(
        		'user_id'=>$this->user_id,
        		'user_status'=>'1',
    				);
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->db->select('tbl_employee_type.emp_type_access');
        $user_record = $this->admin->record_list('tbl_user',$where);
	 	
 		if ($user_record) {

			$this->access_module =$user_record[0]->emp_type_access;

		}else{
			
            $response['message'] = 'Your account has been disabled, Please contact your system administrator';
            $response['code'] = 201;
            $response['status'] = false;
        	echo json_encode($response);
        	exit;
		}

	}   

	public function user_list()
	{

        $where=array(
        			'tbl_user.user_id !='=>'1',
        			'tbl_user.project_location_id'=>$this->project_location_id,
    				);
        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $user_record = $this->admin->record_list('tbl_user',$where);
        
		$response['data'] =$user_record;
		$response['access_module'] =$this->access_module;
        $response['message'] = 'success';
        $response['code'] = 200;
        $response['status'] = true;

        echo json_encode($response);
	}


	public function reporting_manager_list()
	{

        $where=array(
        			'user_status'=>'1',
        			'tbl_user.user_id !='=>$this->user_id,
        			'tbl_user.project_location_id'=>$this->project_location_id,
    				);

		$report_to = array('4', '5');
		$this->db->where_not_in('user_employee_type', $report_to);

        $project_reporting_manager = $this->admin->record_list('tbl_user',$where);

		$response['data'] =$project_reporting_manager;
		$response['access_module'] =$this->access_module;
        $response['message'] = 'success';
        $response['code'] = 200;
        $response['status'] = true;

        echo json_encode($response);
	}

	public function profile()
	{

        $where=array(
        		'user_id'=>$this->user_id,
    				);
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $user_info= $this->admin->record_list('tbl_user',$where);
		$this->data['user_info'] =$user_info[0];
	 	
		$response['data'] =$this->data['user_info'];
		$response['access_module'] =$this->access_module;
        $response['message'] = 'success';
        $response['code'] = 200;
        $response['status'] = true;

        echo json_encode($response);
	}


	public function changepassword()
	{
		$response=array();

		$this->form_validation->set_rules('current_password','Password','required|min_length[4]');

		$this->form_validation->set_rules('new_password','Password','required|min_length[4]|matches[confirm_password]');

		$this->form_validation->set_rules('confirm_password','Password','required');

    	if($this->form_validation->run()){

 			$where=array(
	            'user_id'=>$this->user_id,
	            'user_password'=>md5($this->input->post('current_password')),
	        );
 			$user_record=$this->admin->record_list('tbl_user',$where);

 			if ($user_record) {

	 			$where=array(
	            	'user_id'=>$this->user_id,
		        );
		        $data=array(
	            	
	            	'user_password'=>md5($this->input->post('new_password')),
	            	
		        );
		        $this->admin->records_update('tbl_user',$data,$where);

				$response['data'] ='';
				$response['access_module'] =$this->access_module;
		        $response['message'] = 'User password changed successfully';
		        $response['code'] = 200;
		        $response['status'] = true;

 			}else{

				$response['data'] ='';
		        $response['message'] = 'please enter valid password';
		        $response['code'] = 201;
		        $response['status'] = false;

 			}

    	}else{

			$response['data'] ='';
	        $response['message'] = 'Invalid request';
	        $response['code'] = 201;
	        $response['status'] = false;

    	}

        echo json_encode($response);
	}


	public function user_employee_type_list()
	{

        $where=array(
        			'emp_type_status'=>'1',
    				);
        $project_role = $this->admin->record_list('tbl_employee_type',$where);

		$response['data'] =$project_role;
		$response['access_module'] =$this->access_module;
        $response['message'] = 'success';
        $response['code'] = 200;
        $response['status'] = true;

        echo json_encode($response);
	}



	public function add_user()
	{
		$response=array();

		$this->form_validation->set_rules('user_full_name','User full name','required|xss_clean');

		if ($this->input->post('employee_type')=='1') {
				
			$this->form_validation->set_rules('user_email_id','Email ID','valid_email');

			$this->form_validation->set_rules('user_name','user name','required|alpha_numeric|is_unique[tbl_user.user_name]');

			$this->form_validation->set_rules('user_password','password','required|xss_clean|min_length[4]');
		
		}else{
			$_POST['user_email_id']="";
			$_POST['user_name']="";
			$_POST['user_password']="";
		}
		
		$this->form_validation->set_rules('user_mobile_number','contact number','required|numeric|min_length[10]|max_length[10]');

		$this->form_validation->set_rules('user_employee_id','employee id','required');
		
		$this->form_validation->set_rules('user_employee_type','employee post','required|numeric');
		$this->form_validation->set_rules('reporting_manager','reporting manager','required|numeric');

		$this->form_validation->set_rules('user_status','status','required|numeric');
		
    	if($this->form_validation->run()){

	        $data=array(
	            'user_full_name'=>$this->input->post('user_full_name'),
	            'user_password'=>md5($this->input->post('user_password')),
	            'user_name'=>$this->input->post('user_name'),
	            'employee_type'=>$this->input->post('employee_type'),
	            'gender'=>$this->input->post('gender'),
	            'user_employee_id'=>$this->input->post('user_employee_id'),
	            'user_phone_number'=>$this->input->post('user_mobile_number'),
	            'user_email_id'=>$this->input->post('user_email_id'),
	            'user_employee_type'=>$this->input->post('user_employee_type'),
	            'reporting_manager'=>$this->input->post('reporting_manager'),
	            'project_location_id'=>$this->project_location_id,
	            'user_status'=>$this->input->post('user_status'),
	        );
	        $this->admin->record_insert('tbl_user',$data);


			$response['data'] ='';
			$response['access_module'] =$this->access_module;
	        $response['message'] = 'User created successfully';
	        $response['code'] = 200;
	        $response['status'] = true;

    	}else{

			$response['data'] ='';
	        $response['message'] = 'Invalid request';
	        $response['code'] = 201;
	        $response['status'] = false;

    	}

        echo json_encode($response);
	}

	public function update_user()
	{
		$response=array();

		$this->form_validation->set_rules('user_full_name','User full name','required|xss_clean');
		
		$this->form_validation->set_rules('user_phone_number','contact number','required|numeric|min_length[10]|max_length[10]');

		$this->form_validation->set_rules('user_employee_id','employee id','required');
		
		$this->form_validation->set_rules('user_employee_type','employee post','required|numeric');
		$this->form_validation->set_rules('reporting_manager','reporting manager','required|numeric');

		if ($this->input->post('employee_type')=='1') {
					
			$this->form_validation->set_rules('user_email_id','Email ID','valid_email');
			
	        if($this->input->post('user_password')!=""){
	            $this->form_validation->set_rules('user_password','password','required|xss_clean|min_length[4]');
	        }
        
		}
		
		$this->form_validation->set_rules('user_status','status','required|numeric');
		
		$this->form_validation->set_rules('user_id','ID','required|numeric');
		
    	if($this->form_validation->run()){

	        $data=array(
	            'user_full_name'=>$this->input->post('user_full_name'),
	            'employee_type'=>$this->input->post('employee_type'),
	            'gender'=>$this->input->post('gender'),
	            'user_employee_id'=>$this->input->post('user_employee_id'),
	            'user_phone_number'=>$this->input->post('user_phone_number'),
	            'user_email_id'=>$this->input->post('user_email_id'),
	            'user_employee_type'=>$this->input->post('user_employee_type'),
	            'reporting_manager'=>$this->input->post('reporting_manager'),
	            'user_status'=>$this->input->post('user_status'),
	            'project_location_id'=>$this->project_location_id,
	        );

	        if($this->input->post('user_password')!=""){
	            $data['user_password']=md5($this->input->post('user_password'));
	        }

 			$where=array(
        		'user_id'=>$this->input->post('user_id'),
	        );

	        $this->admin->records_update('tbl_user',$data,$where);


			$response['data'] ='';
			$response['access_module'] =$this->access_module;
	        $response['message'] = 'User update successfully';
	        $response['code'] = 200;
	        $response['status'] = true;

    	}else{

			$response['data'] ='';
	        $response['message'] = 'Invalid request';
	        $response['code'] = 201;
	        $response['status'] = false;

    	}

        echo json_encode($response);
	}



	public function user_vehicle()
	{
		$response=array();

		$this->form_validation->set_rules('vehical_user_id','ID','required');
		
    	if($this->form_validation->run()){

		    $where=array(
		    		'vehical_user_id'=>$this->input->post('vehical_user_id'),
						);
		    $this->data['vehical_record'] = $this->admin->record_list('tbl_user_vehical',$where);

			$response['data'] =$this->data['vehical_record'];
			$response['access_module'] =$this->access_module;
	        $response['message'] = 'success';
	        $response['code'] = 200;
	        $response['status'] = true;

    	}else{

			$response['data'] ='';
	        $response['message'] = 'Invalid request';
	        $response['code'] = 201;
	        $response['status'] = false;

    	}

        echo json_encode($response);

	}



	public function add_user_vehicle()
	{

		$response=array();

		$this->form_validation->set_rules('vehical_type','Type','required|xss_clean');

		$this->form_validation->set_rules('vehical_number','Number','required');
		
    	if($this->form_validation->run()){

	        $data=array(
	            'vehical_user_id'=>$this->input->post('vehical_user_id'),
	            'vehical_type'=>$this->input->post('vehical_type'),
	            'vehical_number'=>$this->input->post('vehical_number'),
	        );
	        $this->admin->record_insert('tbl_user_vehical',$data);

			//$this->session->set_flashdata('success_message',"Vehical created successfully");

			//redirect(base_url().'user/user_vehicle/'.$this->input->post('vehical_user_id'));


			$response['data'] ='';
			$response['access_module'] =$this->access_module;
	        $response['message'] = 'success';
	        $response['code'] = 200;
	        $response['status'] = true;

    	}else{

			$response['data'] ='';
	        $response['message'] = 'Invalid request';
	        $response['code'] = 201;
	        $response['status'] = false;

    	}

        echo json_encode($response);



	}

	public function update_user_vehicle()
	{

		$response=array();

		$this->form_validation->set_rules('vehical_user_id','ID','required|xss_clean');

		$this->form_validation->set_rules('vehical_type','Type','required|xss_clean');

		$this->form_validation->set_rules('vehical_number','Number','required');
		
    	if($this->form_validation->run()){

	        $data=array(
	            'vehical_user_id'=>$this->input->post('vehical_user_id'),
	            'vehical_type'=>$this->input->post('vehical_type'),
	            'vehical_number'=>$this->input->post('vehical_number'),
	        );

 			$where=array(
	            'vehical_id'=>$this->uri->segment('4'),
	            'vehical_user_id'=>$this->input->post('vehical_user_id'),
	        );
	        $this->admin->records_update('tbl_user_vehical',$data,$where);

			//$this->session->set_flashdata('success_message',"Vehical Updated successfully");

			//redirect(base_url().'user/user_vehicle/'.$this->input->post('vehical_user_id'));


			$response['data'] ='';
			$response['access_module'] =$this->access_module;
	        $response['message'] = 'success';
	        $response['code'] = 200;
	        $response['status'] = true;

    	}else{

			$response['data'] ='';
	        $response['message'] = 'Invalid request';
	        $response['code'] = 201;
	        $response['status'] = false;

    	}

        echo json_encode($response);



	}


}
