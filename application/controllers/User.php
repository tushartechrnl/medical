<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->admin->login_check();		

	}   


	public function index()
	{

		if (!$this->admin->check_user_access('user-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			'tbl_user.user_id !='=>'1',
        			'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
    				);
		$report_to = array('3');
		$this->db->where_not_in('user_employee_type', $report_to);

        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->data['user_record'] = $this->admin->record_list('tbl_user',$where);
        
		$this->data['page_title'] = "User";

		$this->load->view('user-list',$this->data);

	}


	public function export_user_list(){

		error_reporting(0);

        $this->load->library('excel');


		$objPHPExcel    =   new PHPExcel();

		 
		$objPHPExcel->setActiveSheetIndex(0);
	 	
								

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SR.NO.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Employee Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Post');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'User Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Phone Number');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Worker');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Status');
		//$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Safety');
		//$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Quantity');
		//$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Price');
		 
		$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);
		 
	 
        $where=array(
        			'tbl_user.user_id !='=>'1',
        			'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
    				);
        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $user_record = $this->admin->record_list('tbl_user',$where);
        

		$rowCount   =   2;
		$i=0;
		$total_cost=0;
		
		if ($user_record) {
			foreach ($user_record as $key => $value) {
				$i++;
			    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, mb_strtoupper($i,'UTF-8'));
			    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, mb_strtoupper($value->user_full_name,'UTF-8'));

			    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, mb_strtoupper($value->emp_type_name,'UTF-8'));
			    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, mb_strtoupper($value->user_name,'UTF-8'));

			    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, mb_strtoupper($value->user_phone_number,'UTF-8'));

				$employee_type_se=array(
					'0'=>'Temporary',
					'1'=>'Permanent',
				);
			    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, mb_strtoupper($employee_type_se[$value->employee_type],'UTF-8'));

				if($value->user_status==1){
								
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, mb_strtoupper('Enabled','UTF-8'));
				}else{
					
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, mb_strtoupper('Disabled','UTF-8'));
				}
										
			    //$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, mb_strtoupper($value->safety_stock,'UTF-8'));
			    //$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, mb_strtoupper($value->stock_quantity-$value->assign_quantity,'UTF-8'));
			    //$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, mb_strtoupper($value->stock_price,'UTF-8'));

			    //$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, mb_strtoupper(date("d-M-Y", strtotime($value->assign_created_on)),'UTF-8'));

				//$total_cost+= $value->assign_quantity*$value->stock_price;
			    $rowCount++;
			}
		}

	    $rowCount++;
	    $rowCount++;
	    
	    /*if ($total_cost!=0) {
	    	
			    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, mb_strtoupper('Total Cost','UTF-8'));

			    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, mb_strtoupper($total_cost,'UTF-8'));

	    }*/
		//$objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);
				 
		$objPHPExcel->createSheet();

		// Add some data to the second sheet, resembling some different data types
		/*$objPHPExcel->setActiveSheetIndex(1);


		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Breed Name');
		$objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getFont()->setBold(true);
		 

		$rowCount   =   2;

        $where=array(
        			'sub_category_status'=>1,
    				);
     	$pet_info= $this->admin->record_list('tbl_pet_sub_category',$where);
		
		foreach ($pet_info as $key => $value) {
		    
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, mb_strtoupper($value->sub_cat_id,'UTF-8'));
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, mb_strtoupper($value->sub_category_name,'UTF-8'));
		    $rowCount++;

		}

		// Rename 2nd sheet
		$objPHPExcel->getActiveSheet()->setTitle('Breed Name');*/

		 
		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="User-list-'.date("Y-m-d H:i:s").'.xlsx"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
		$objWriter->save('php://output');

		exit;
	}


	public function user_vehicle()
	{

		if (!$this->admin->check_user_access('add-user-vehical')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        		'user_id'=>$this->uri->segment('3'),
    				);
        $this->data['user_record'] = $this->admin->record_list('tbl_user',$where);


        $where=array(
        		'vehical_user_id'=>$this->uri->segment('3'),
    				);
        $this->data['vehical_record'] = $this->admin->record_list('tbl_user_vehical',$where);


        
		$this->data['page_title'] = "User Vehicle";

		$this->load->view('user_vehical/vehical-list',$this->data);

	}



	public function add_user_vehicle()
	{

		if (!$this->admin->check_user_access('add-user-vehical')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add User Vehicle";

		if (isset($_POST['btn_add_user_vehical'])) {
			
			$this->form_validation->set_rules('vehical_type','Type','required|xss_clean');

			$this->form_validation->set_rules('vehical_number','Number','required');
			
        	if($this->form_validation->run()){

		        $data=array(
		            'vehical_user_id'=>$this->input->post('vehical_user_id'),
		            'vehical_type'=>$this->input->post('vehical_type'),
		            'vehical_number'=>$this->input->post('vehical_number'),
		        );
		        $this->admin->record_insert('tbl_user_vehical',$data);

				$this->session->set_flashdata('success_message',"Vehical created successfully");

				redirect(base_url().'user/user_vehicle/'.$this->input->post('vehical_user_id'));
        	}

		}

		$this->load->view('user_vehical/vehical-add',$this->data);
	}

	public function update_user_vehicle()
	{

		if (!$this->admin->check_user_access('add-user-vehical')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add User Vehicle";

		if (isset($_POST['btn_add_user_vehical'])) {
			
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

				$this->session->set_flashdata('success_message',"Vehical Updated successfully");

				redirect(base_url().'user/user_vehicle/'.$this->input->post('vehical_user_id'));
        	}

		}

        $where=array(
        				'vehical_id'=>$this->uri->segment('4'),
    				);
        $this->data['vehical_info'] = $this->admin->record_list('tbl_user_vehical',$where);

		$this->data['vehical_info'] = $this->data['vehical_info'][0];


		if (!$this->data['vehical_info']) {
			redirect(base_url('user'));
		}

		$this->load->view('user_vehical/vehical-add',$this->data);
	}

	public function add_user()
	{

		if (!$this->admin->check_user_access('add-user')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add User";

		if (isset($_POST['btn_add_user'])) {
			// echo "<pre>";
			// print_r($_POST);
			// exit;

			
			$this->form_validation->set_rules('user_first_name','First name','required|xss_clean');
			
			$this->form_validation->set_rules('user_phone_number','contact number','required|numeric|min_length[10]|max_length[12]');

			$this->form_validation->set_rules('user_employee_type','employee post','required');
					
			$this->form_validation->set_rules('user_email_id','Email ID','valid_email');
			
            $this->form_validation->set_rules('user_password','password','xss_clean|min_length[4]');
			
        	if($this->form_validation->run()){

		        $data=array(
		            'user_first_name'=>ucwords($this->input->post('user_first_name')),
		            'user_last_name'=>$this->input->post('user_last_name'),
		            'gender'=>$this->input->post('gender'),
		            'user_password'=>md5($this->input->post('user_password')),
		            'user_phone_number'=>$this->input->post('user_phone_number'),
		            'user_email_id'=>$this->input->post('user_email_id'),
		            'user_employee_type'=>$this->input->post('user_employee_type'),
		            'project_location_id'=>$this->session->userdata('location_id'),

		            'user_address'=>$this->input->post('user_address'),
		            'user_profile'=>$this->input->post('user_profile'),
		            
		            'user_status'=>$this->input->post('user_status'),

		        );
		        $this->admin->record_insert('tbl_user',$data);

				$this->session->set_flashdata('success_message',"Your account has been created successfully");

				redirect(base_url().'user');
        	}

		}

        $where=array(
        			'user_status'=>'1',
        			'tbl_user.user_id !='=>$this->uri->segment('3'),
    				);

		$report_to = array('3');
		$this->db->where_not_in('user_employee_type', $report_to);

        $this->data['project_reporting_manager'] = $this->admin->record_list('tbl_user',$where);

        $where=array(
        			//'emp_type_id !='=>'1',
    				);
		$report_to = array('3');
		$this->db->where_not_in('emp_type_id', $report_to);

        $this->data['project_role'] = $this->admin->record_list('tbl_employee_type',$where);

        $where=array(
    				);
        $this->data['project_location'] = $this->admin->record_list('tbl_project_location',$where);

		$this->load->view('user-update',$this->data);
	}

	public function update_user()
	{
		if (!$this->admin->check_user_access('update-user')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update User";

		if (isset($_POST['btn_add_user'])) {
			
			//$this->form_validation->set_rules('user_name','User name','required|xss_clean');
			
			$this->form_validation->set_rules('user_first_name','First name','required|xss_clean');
			
			$this->form_validation->set_rules('user_phone_number','contact number','required|numeric|min_length[10]|max_length[12]');

			$this->form_validation->set_rules('user_employee_type','employee post','required');
					
			$this->form_validation->set_rules('user_email_id','Email ID','valid_email');
			
	        if($this->input->post('user_password')!=""){
	            $this->form_validation->set_rules('user_password','password','xss_clean|min_length[4]');
	        }
			
			
        	if($this->form_validation->run()){

		        $data=array(
		            'user_first_name'=>ucwords($this->input->post('user_first_name')),
		            'user_last_name'=>$this->input->post('user_last_name'),
		            'gender'=>$this->input->post('gender'),
		            'user_phone_number'=>$this->input->post('user_phone_number'),
		            'user_email_id'=>$this->input->post('user_email_id'),
		            'user_employee_type'=>$this->input->post('user_employee_type'),
		            'project_location_id'=>$this->session->userdata('location_id'),

		            'user_address'=>$this->input->post('user_address'),
		            'user_profile'=>$this->input->post('user_profile'),

		            'user_status'=>$this->input->post('user_status'),
		        );

		        if($this->input->post('user_password')!=""){
		            $data['user_password']=md5($this->input->post('user_password'));
		        }

	 			$where=array(
	        		'user_id'=>$this->input->post('user_id'),
		        );

		        $this->admin->records_update('tbl_user',$data,$where);

				$this->session->set_flashdata('success_message',"Employee information has been Updated successfully");

				redirect(base_url().'user');
        	}

		}
/*
        $where=array(
        			'user_status'=>'1',
        			'tbl_user.user_id !='=>$this->uri->segment('3')
    				);

		$report_to = array('4', '5');
		$this->db->where_not_in('user_employee_type', $report_to);

        $this->data['project_reporting_manager'] = $this->admin->record_list('tbl_user',$where);*/

        $where=array(
        			//'emp_type_id !='=>'1',
    				);
		$report_to = array('3');
		$this->db->where_not_in('emp_type_id', $report_to);

        $this->data['project_role'] = $this->admin->record_list('tbl_employee_type',$where);

        $where=array(
    				);
        $this->data['project_location'] = $this->admin->record_list('tbl_project_location',$where);

        $where=array(
        			'user_id'=>$this->uri->segment('3')
    				);
     	$user_info= $this->admin->record_list('tbl_user',$where);
		
		$this->data['user_info']=$user_info[0];
		
		if (!$this->data['user_info']) {
			redirect(base_url('user'));
		}

		$this->load->view('user-update',$this->data);
	}

	public function profile()
	{

        $where=array(
        		'user_id'=>$this->session->userdata('user_id'),
    				);
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $user_info= $this->admin->record_list('tbl_user',$where);
		$this->data['user_info'] =$user_info[0];
	 	
		$this->data['page_title']="Profile";
		$this->load->view('user-profile',$this->data);
	}

	public function changepassword()
	{

		if (isset($_POST['btn_change_password'])) {

			$this->form_validation->set_rules('current_password','Password','required|min_length[4]');

			$this->form_validation->set_rules('new_password','Password','required|min_length[4]|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password','Password','required');

        	if($this->form_validation->run()){

	 			$where=array(
		            'user_id'=>$this->session->userdata('user_id'),
		            'user_password'=>md5($this->input->post('current_password')),
		        );
	 			$user_record=$this->admin->record_list('tbl_user',$where);

	 			if ($user_record) {

		 			$where=array(
		            	'user_id'=>$this->session->userdata('user_id'),
			        );
			        $data=array(
		            	
		            	'user_password'=>md5($this->input->post('new_password')),
		            	
			        );
			        $this->admin->records_update('tbl_user',$data,$where);

					$this->session->set_flashdata('success_message',"Password changed");

			        redirect(base_url().'user/changepassword');

	 			}else{

					$this->session->set_flashdata('failed_message',"Old password incorrect");

			        redirect(base_url().'user/changepassword');
	 			}

			}

		}

		$this->data['page_title']="Change Password";
		$this->load->view('change-password',$this->data);
	}

}
