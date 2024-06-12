<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->admin->login_check();		

	}   


	public function index()
	{

		if (!$this->admin->check_user_access('medicine-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
    				);
        $this->db->order_by('med_id','DESC');
        $this->db->join('tbl_medicine_category','tbl_medicine_category.med_cat_id=tbl_medicine.med_cat_id');
        $this->data['medicine_record'] = $this->admin->record_list('tbl_medicine',$where);
        
		$this->data['page_title'] = "Medicine";

		$this->load->view('medicine/medicine-list',$this->data);

	}


	public function add_medicine()
	{

		if (!$this->admin->check_user_access('add-medicine')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Medicine";

		if (isset($_POST['btn_add_med_cat'])) {
			
			//$this->form_validation->set_rules('med_cat_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('med_name','Name','required|xss_clean');
			
			
        	if($this->form_validation->run()){

        		
        		unset($_POST['btn_add_med_cat']);
				/*echo "<pre>";
        		print_r($_POST);
        		exit;*/
		        $data=$_POST;
		        $this->admin->record_insert('tbl_medicine',$data);

				$this->session->set_flashdata('success_message',"Medicine has been created successfully");

				//redirect($_SERVER['HTTP_REFERER']);
				redirect(base_url().'medicine');
        	}

		}

        

        $where=array(
		            	//'user_employee_type'=>'2',
    				);
        $this->data['medicine_category_list'] = $this->admin->record_list('tbl_medicine_category',$where);

		$this->load->view('medicine/medicine-update',$this->data);
	}

	public function update_medicine()
	{

		if (!$this->admin->check_user_access('update-medicine')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update Medicine";

		if (isset($_POST['btn_add_med_cat'])) {
			
			$this->form_validation->set_rules('med_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('med_name','Name','required|xss_clean');
			
        	if($this->form_validation->run()){

        		unset($_POST['btn_add_med_cat']);
		        $data=$_POST;
		        
	 			$where=array(
	        		'med_id'=>$this->input->post('med_id'),
		        );

		        $this->admin->records_update('tbl_medicine',$data,$where);

				$this->session->set_flashdata('success_message',"Medicine has been Updated successfully");

				//redirect($_SERVER['HTTP_REFERER']);

				redirect(base_url().'medicine');
        	}

		}

        /*$where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);*/


        $where=array(
        			'med_id'=>$this->uri->segment('3')
    				);
     	$medicine_info= $this->admin->record_list('tbl_medicine',$where);
		
		$this->data['medicine_info']=$medicine_info[0];
		
		if (!$this->data['medicine_info']) {
			redirect(base_url('medicine'));
		}

        $where=array(
		            	//'user_employee_type'=>'2',
    				);
        $this->data['medicine_category_list'] = $this->admin->record_list('tbl_medicine_category',$where);

		$this->load->view('medicine/medicine-update',$this->data);
	}


	public function category()
	{

		if (!$this->admin->check_user_access('medicine-category-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			//'tbl_user.user_id !='=>'1',
        			//'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
    				);
        $this->db->order_by('med_cat_id','DESC');
        $this->data['medicine_record'] = $this->admin->record_list('tbl_medicine_category',$where);
        
		$this->data['page_title'] = "Medicine Category";

		$this->load->view('medicine/medicine-category-list',$this->data);

	}


	public function add_category()
	{

		if (!$this->admin->check_user_access('add-medicine-category')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Medicine Category";

		if (isset($_POST['btn_add_med_cat'])) {
			
			//$this->form_validation->set_rules('med_cat_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('med_cat_name','Name','required|xss_clean');
			
			
        	if($this->form_validation->run()){

		        $data=array(
		            'med_cat_created_id'=>$this->session->userdata('user_id'),
		            'med_cat_name'=>$this->input->post('med_cat_name'),

		        );
		        $this->admin->record_insert('tbl_medicine_category',$data);

				$this->session->set_flashdata('success_message',"Medicine category has been created successfully");

				//redirect($_SERVER['HTTP_REFERER']);
				redirect(base_url().'medicine/category');
        	}

		}

        

        $where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);

		$this->load->view('medicine/medicine-category-update',$this->data);
	}

	public function update_category()
	{

		if (!$this->admin->check_user_access('update-medicine-category')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update Medicine Category";

		if (isset($_POST['btn_add_med_cat'])) {
			
			$this->form_validation->set_rules('med_cat_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('med_cat_name','Name','required|xss_clean');
			
        	if($this->form_validation->run()){

		        $data=array(
		            //'med_cat_created_id'=>$this->session->userdata('user_id'),
		            'med_cat_name'=>$this->input->post('med_cat_name'),
		        );
	 			$where=array(
	        		'med_cat_id'=>$this->input->post('med_cat_id'),
		        );

		        $this->admin->records_update('tbl_medicine_category',$data,$where);

				$this->session->set_flashdata('success_message',"Category has been Updated successfully");

				//redirect($_SERVER['HTTP_REFERER']);

				redirect(base_url().'medicine/category');
        	}

		}

        /*$where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);*/


        $where=array(
        			'med_cat_id'=>$this->uri->segment('3')
    				);
     	$medicine_info= $this->admin->record_list('tbl_medicine_category',$where);
		
		$this->data['medicine_info']=$medicine_info[0];
		
		if (!$this->data['medicine_info']) {
			redirect(base_url('medicine/category'));
		}

		$this->load->view('medicine/medicine-category-update',$this->data);
	}


	public function lab_test_list()
	{

		if (!$this->admin->check_user_access('lab-test-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			//'tbl_user.user_id !='=>'1',
        			//'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
    				);
        $this->db->order_by('lab_test_id','DESC');
        $this->data['lab_test_record'] = $this->admin->record_list('tbl_lab_test',$where);
        
		$this->data['page_title'] = "Lab Test";

		$this->load->view('medicine/lab-test-list',$this->data);

	}


	public function add_lab_test()
	{

		if (!$this->admin->check_user_access('add-lab-test')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Lab Test";

		if (isset($_POST['btn_add_med_cat'])) {
			
			//$this->form_validation->set_rules('med_cat_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('lab_test_name','Name','required|xss_clean');
			
			
        	if($this->form_validation->run()){

		        $data=array(
		            'lab_test_created_id'=>$this->session->userdata('user_id'),
		            'lab_test_name'=>ucwords($this->input->post('lab_test_name')),

		        );
		        $this->admin->record_insert('tbl_lab_test',$data);

				$this->session->set_flashdata('success_message',"Lab test has been created successfully");

				//redirect($_SERVER['HTTP_REFERER']);
				redirect(base_url().'medicine/lab_test_list');
        	}

		}

        

        /*$where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);*/

		$this->load->view('medicine/lab-test-update',$this->data);
	}

	public function update_lab_test()
	{

		if (!$this->admin->check_user_access('update-lab-test')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update Lab Test";

		if (isset($_POST['btn_add_med_cat'])) {
			
			$this->form_validation->set_rules('lab_test_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('lab_test_name','Name','required|xss_clean');
			
        	if($this->form_validation->run()){

		        $data=array(
		            //'med_cat_created_id'=>$this->session->userdata('user_id'),
		            'lab_test_name'=>ucwords($this->input->post('lab_test_name')),
		        );
	 			$where=array(
	        		'lab_test_id'=>$this->input->post('lab_test_id'),
		        );

		        $this->admin->records_update('tbl_lab_test',$data,$where);

				$this->session->set_flashdata('success_message',"Lab test has been Updated successfully");

				//redirect($_SERVER['HTTP_REFERER']);

				redirect(base_url().'medicine/lab_test_list');
        	}

		}

        /*$where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);*/


        $where=array(
        			'lab_test_id'=>$this->uri->segment('3')
    				);
     	$medicine_info= $this->admin->record_list('tbl_lab_test',$where);
		
		$this->data['medicine_info']=$medicine_info[0];
		
		if (!$this->data['medicine_info']) {
			redirect(base_url('medicine/lab-test-list'));
		}

		$this->load->view('medicine/lab-test-update',$this->data);
	}

}
