<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{

        $response = array();
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        	
			$this->form_validation->set_rules('user_name','User name','required|xss_clean');
			
			$this->form_validation->set_rules('user_password','Password','required|xss_clean|min_length[4]');
			
        	if($this->form_validation->run()){

		        $where=array(
		        		'user_name'=>$this->input->post('user_name'),
		        		'user_password'=>md5($this->input->post('user_password')),
		        		'user_status'=>'0',
		    				);
		        $this->db->select('user_id,user_name,user_email_id,user_employee_type,user_employee_type');
		        $user_record = $this->admin->record_list('tbl_user',$where);
		        
		        if($user_record){

	                $response['message'] = 'Your account has been disabled, Please contact your system administrator';
	                $response['code'] = 202;
	                $response['status'] = false;

		        }else{

			        $where=array(
			        		'user_name'=>$this->input->post('user_name'),
			        		'user_password'=>md5($this->input->post('user_password')),
			        		'user_status'=>'1',
			    				);
			        $this->db->select('tbl_user.user_id,tbl_user.user_full_name,tbl_user.user_email_id,tbl_user.user_employee_type,tbl_user.employee_type,tbl_employee_type.emp_type_name,tbl_employee_type.emp_type_access,tbl_employee_type.emp_type_id,tbl_user.project_location_id,tbl_project_location.*');
			        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
		        	$this->db->join('tbl_project_location','tbl_project_location.location_id=tbl_user.project_location_id','Left');
			        $user_record = $this->admin->record_list('tbl_user',$where);
				 	
				 	if ($user_record) {
					        	
						if($user_record[0]->user_employee_type=="1"){


							$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
					 
					    	$user_token= substr(str_shuffle($str_result),0, 8);

				 			$where=array(
				        		'user_name'=>$this->input->post('user_name'),
				        		'user_password'=>md5($this->input->post('user_password')),
					        );
					        $data=array(
				                'user_token'=>$user_token,
					        );
					        $this->admin->records_update('tbl_user',$data,$where);


							$response['data'] =$user_record[0];

							$response['access_module'] =$user_record[0]->emp_type_access;
							$response['user_token'] =$user_token;
			                $response['message'] = 'Login Successfull';
			                $response['code'] = 200;
			                $response['status'] = true;

							//$this->session->set_userdata('user_verification','1');
							//redirect(base_url());

						}else{
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



							$response['data'] =$user_record[0];

							$response['access_module'] =$user_record[0]->emp_type_access;

			                $response['message'] = 'Please verify OTP';
			                $response['code'] = 200;
			                $response['status'] = true;

							//$this->session->set_userdata('user_verification','0');
							//redirect(base_url().'verification');
							
						}



		        	}else
		        	{
		                $response['message'] = 'Username or password incorrect';
		                $response['code'] = 202;
		                $response['status'] = false;
		        	}
		        }

			 
	        }else{
	            $response['message'] = 'Username password required';
	            $response['code'] = 201;
                $response['status'] = false;
	        }

        } else {
            $response['message'] = 'Invalid Request';
            $response['code'] = 201;
            $response['status'] = false;
        }
        echo json_encode($response);


	}

	public function verification()
	{

        $response = array();
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

	        $where=array(
	        		'user_id'=>$this->input->post('user_id'),
	        		'user_email_id'=>$this->input->post('user_email_id'),
	    				);
	        $user_record = $this->admin->record_list('tbl_user',$where);
		 	
	 		if ($user_record) {


				$this->form_validation->set_rules('user_otp','OTP','required');

	        	if($this->form_validation->run()){
	        		
	        		//$user_otp=implode("", $this->input->post('user_otp'));
	        		

			        $where=array(
			        		'user_id'=>$this->input->post('user_id'),
			        		'user_otp'=>$this->input->post('user_otp'),
			    				);
        			$this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
			        $this->db->select('user_id,user_name,user_email_id,user_employee_type,tbl_employee_type.emp_type_access');
			        $user_record = $this->admin->record_list('tbl_user',$where);
				 	
			 		if ($user_record) {
		 			
						$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				 
				    	$user_token= substr(str_shuffle($str_result),0, 8);

			 			$where=array(
			        		'user_id'=>$this->input->post('user_id'),
				        );
				        $data=array(
			                'user_token'=>$user_token,
			            	'user_otp_tried'=>'0',
				        );
				        $this->admin->records_update('tbl_user',$data,$where);


						$response['data'] =$user_record[0];

						$response['access_module'] =$user_record[0]->emp_type_access;
						$response['user_token'] =$user_token;
		                $response['message'] = 'OTP verification successfull.';
		                $response['code'] = 200;
		                $response['status'] = true;


			        }else{

				        $where=array(
				        		'user_id'=>$this->input->post('user_id'),
				    				);
				        $user_record = $this->admin->record_list('tbl_user',$where);
					 	
					 	$user_otp_tried=$user_record[0]->user_otp_tried+1;

			 			$where=array(
			        		'user_id'=>$this->input->post('user_id'),
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

			                $response['message'] = 'Your account has been disabled, Please contact your system administrator';
			                $response['code'] = 202;
			                $response['status'] = false;

						}else{

			                $response['message'] = 'OTP is invalid';
			                $response['code'] = 202;
			                $response['status'] = false;

						}

			        }

	        	}else{

		            $response['message'] = 'OTP required';
		            $response['code'] = 201;
	                $response['status'] = false;
	        	}


	 		}else{

	            $response['message'] = 'Unauthorized user.';
	            $response['code'] = 204;
	            $response['status'] = false;
	 		}


        } else {
            $response['message'] = 'Invalid Request';
            $response['code'] = 201;
            $response['status'] = false;
        }
        echo json_encode($response);

	}

	public function update_firebase_user_token()
	{

        $response = array();
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

	        $where=array(
	        		'user_id'=>$this->input->post('user_id'),
	        		'user_email_id'=>$this->input->post('user_email_id'),
	    				);
	        $user_record = $this->admin->record_list('tbl_user',$where);
		 	
	 		if ($user_record) {


				$this->form_validation->set_rules('firebase_user_token','Token','required');

	        	if($this->form_validation->run()){
	        		
	        		//$user_otp=implode("", $this->input->post('user_otp'));
	        		

			        $where=array(
			        		'user_id'=>$this->input->post('user_id'),
			    				);
			        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
			        $this->db->select('tbl_user.user_id,tbl_user.user_name,tbl_user.user_email_id,tbl_user.user_employee_type,tbl_employee_type.emp_type_access');
			        $user_record = $this->admin->record_list('tbl_user',$where);
				 	
			 		if ($user_record) {
		 			
						$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				 
				    	$user_token= substr(str_shuffle($str_result),0, 8);

			 			$where=array(
			        		'user_id'=>$this->input->post('user_id'),
				        );
				        $data=array(
			                //'user_token'=>$user_token,
			                'firebase_user_token'=>$this->input->post('firebase_user_token'),
			            	'user_otp_tried'=>'0',
				        );
				        $this->admin->records_update('tbl_user',$data,$where);


						$response['data'] ='';
						$response['access_module'] =$user_record[0]->emp_type_access;
						//$response['user_token'] =$user_token;
		                $response['message'] = 'Firebase token updated successfull.';
		                $response['code'] = 200;
		                $response['status'] = true;


			        }else{

				        $where=array(
				        		'user_id'=>$this->input->post('user_id'),
				    				);
				        $user_record = $this->admin->record_list('tbl_user',$where);
					 	
					 	$user_otp_tried=$user_record[0]->user_otp_tried+1;

			 			$where=array(
			        		'user_id'=>$this->input->post('user_id'),
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

			                $response['message'] = 'Your account has been disabled, Please contact your system administrator';
			                $response['code'] = 202;
			                $response['status'] = false;

						}else{

			                $response['message'] = 'User is invalid';
			                $response['code'] = 202;
			                $response['status'] = false;

						}

			        }

	        	}else{

		            $response['message'] = 'Firebase Token required';
		            $response['code'] = 201;
	                $response['status'] = false;
	        	}


	 		}else{

	            $response['message'] = 'Unauthorized user.';
	            $response['code'] = 204;
	            $response['status'] = false;
	 		}


        } else {
            $response['message'] = 'Invalid Request';
            $response['code'] = 201;
            $response['status'] = false;
        }
        echo json_encode($response);

	}

	public function header_info_readings()
	{

		$headers=array();
		foreach (getallheaders() as $name => $value) {
		    $headers[$name] = $value;
		}

        echo json_encode($headers['user_token']);
	}


	public function crown_job_stock_low()
	{


	    //crown job code

        $where=array(
    				);
        $project_location = $this->admin->record_list('tbl_project_location',$where);

        foreach ($project_location as $key => $value) {

	        $where=array(
			    			'tbl_user.user_status'=>'1',
			    			'tbl_user.project_location_id'=>$value->location_id,
			    			'tbl_user.user_email_id !='=>"",
	    				);
	        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
			$this->db->like('tbl_employee_type.emp_type_access', 'stock_low');
	        $emloyee_record = $this->admin->record_list('tbl_user',$where);
		
			$email_id="";

			if ($emloyee_record) {

				foreach ($emloyee_record as $key1 => $value1) {

					$email_id=$value1->user_email_id;

			        $where=array(
			    			'tbl_stock.stock_location_id'=>$value->location_id,
			    				);
			        $this->db->order_by('stock_id','DESC');
			        $this->db->join('tbl_stock_category','tbl_stock_category.stock_category_id=tbl_stock.stock_category_id');
			        $this->db->join('tbl_stock_type','tbl_stock_type.stock_type_id=tbl_stock.stock_type_id');
			        $this->db->join('tbl_stock_size','tbl_stock_size.stock_size_id=tbl_stock.stock_size_id', 'left');
			        $this->db->join('tbl_stock_make','tbl_stock_make.make_id=tbl_stock.stock_make_id', 'left');
			        $this->db->join('tbl_stock_uom','tbl_stock_uom.uom_id=tbl_stock.stock_uom_id', 'left');

					$this->db->join('tbl_requisition_assign','tbl_requisition_assign.assign_stock_id=tbl_stock.stock_id', 'left');
					$this->db->group_by('tbl_stock.stock_id');

			        $this->db->select('tbl_stock.*,tbl_stock_type.stock_type_name,tbl_stock_size.stock_size_name,tbl_stock_make.make_name,tbl_stock_uom.uom_name,tbl_stock_category.stock_category_name,sum(tbl_requisition_assign.assign_quantity) assign_quantity');
			        $this->data['stock_record'] = $this->admin->record_list('tbl_stock',$where);
			        
					$this->data['page_title'] = "Stock";


					$this->data['sub_sidebar'] = "Stock List";

					$message=$this->load->view('stock/cron_stock_list',$this->data,true);        
					
					$subject="Alert For Stock Below Safety Limit - ".$value->location_name;
					
					$send_to=$email_id;
					
					if ($send_to!="") {
					
						$this->admin->send_email_smtp($send_to,$subject,$message);
					
					}

				}
			}
	        	
        }
		

        $response['message'] = 'success';
        $response['code'] = 200;
        $response['status'] = true;

        echo json_encode($response);
	}

}
