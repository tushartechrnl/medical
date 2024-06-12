<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

  	public $project_location_id;
  	public $user_id;
  	public $user_employee_type;
  	public $access_module;

	public function __construct()
	{
		parent::__construct();

        $response = array();
    
		$headers=array();
		foreach (getallheaders() as $name => $value) {
		    
		    $headers[ucfirst($name)] = $value;
		}

        if (isset($headers['Usertoken']) && isset($headers['Userid']) &&  isset($headers['Projectlocationid']) &&  isset($headers['Useremployeetype'])) {

        	$this->project_location_id=$headers['Projectlocationid'];
    	
        	$this->user_id=$headers['Userid'];

        	$this->user_employee_type=$headers['Useremployeetype'];
        	
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

	public function index()
	{

        $where=array(
        			'noti_user_id'=>$this->user_id
    				);
        $this->db->order_by('noti_id','DESC');
        $this->data['noti_record'] = $this->admin->record_list('tbl_notification',$where);
        
		$response['data'] =$this->data['noti_record'];
		$response['access_module'] =$this->access_module;
        $response['message'] = 'success';
        $response['code'] = 200;
        $response['status'] = true;

        echo json_encode($response);

	}

	public function remove_notification()
	{

		$this->form_validation->set_rules('noti_id','ID','required|xss_clean|numeric');

    	if($this->form_validation->run()){
					
			$where = array(
				'noti_id'=>$this->input->post('noti_id')
				);
			$this->admin->records_delete('tbl_notification',$where);

			$response['data'] ='';
			$response['access_module'] =$this->access_module;
	        $response['message'] = 'Notification deleted successfully';
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

	public function mark_notification()
	{

		$this->form_validation->set_rules('noti_id','ID','required|xss_clean|numeric');

    	if($this->form_validation->run()){
						
			$data = array(
	    		'noti_status'=>1,
				);

			$where=array(
				'noti_id'=>$this->input->post('noti_id')
	        );

	        $this->admin->records_update('tbl_notification',$data,$where);

			$response['data'] ='';
			$response['access_module'] =$this->access_module;
	        $response['message'] = 'Notification mark readed successfully';
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
