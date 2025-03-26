<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->admin->login_check();		

	}   


	public function get_medicine_details()
	{

        $where=array(
        				"med_id"=>$this->input->post("medicine_id")
    				);
        //$this->db->order_by('med_id','DESC');
        //$this->db->join('tbl_medicine_category','tbl_medicine_category.med_cat_id=tbl_medicine.med_cat_id');
        $medicine_record = $this->admin->record_list('tbl_medicine',$where);
        
        if (isset($medicine_record[0]->med_id)) {
        
	        echo json_encode($medicine_record[0]);
	    }else{
	    	echo null;
	    }
	}
	public function agency_bill()
	{

		if (!$this->admin->check_user_access('medicine-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
    				);
        $this->db->order_by('med_id','DESC');
        $this->db->join('tbl_medicine_category','tbl_medicine_category.med_cat_id=tbl_medicine.med_cat_id');
        $this->data['medicine_record'] = $this->admin->record_list('tbl_medicine',$where);
        
		$this->data['page_title'] = "Agency Bill";

		$this->load->view('medicine/medicine-agency-billing-list',$this->data);

	}

	public function stock_list()
	{

		if (!$this->admin->check_user_access('medicine-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
    				);
        if (isset($_GET['bill_number'])) {
        	$where['stock_bill_number']=$_GET['bill_number'];
        }
        $this->db->order_by('stock_id','DESC');
        $this->db->join('tbl_medicine_category','tbl_medicine_category.med_cat_id=tbl_stock.stock_category_id');
        $this->data['medicine_record'] = $this->admin->record_list('tbl_stock',$where);
        
		$this->data['page_title'] = "Stock";

		$this->load->view('medicine/stock-list',$this->data);

	}


	public function add_agency_bill()
	{

		if (!$this->admin->check_user_access('add-medicine')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Agency Bill";

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
        $this->data['medicine_category_list'] = $this->admin->record_list('tbl_medicine',$where);

		$this->load->view('medicine/medicine-agency-billing-add',$this->data);
	}

	public function update_agency_bill()
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

		$this->load->view('medicine/medicine-agency-billing-add',$this->data);
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


	public function add_stock()
	{

		if (!$this->admin->check_user_access('add-medicine')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Stock";

		if (isset($_POST['btn_add_med_stock'])) {
			
			//$this->form_validation->set_rules('med_cat_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('stock_product_name','Name','required|xss_clean');
			
			$this->form_validation->set_rules('stock_qty','Name','required|xss_clean');
			
			$this->form_validation->set_rules('stock_mrp','MRP','required|xss_clean');
			
			$this->form_validation->set_rules('stock_rate','Rate','required|xss_clean');
			
			
        	if($this->form_validation->run()){

        		
	 			$data=array(
	        		'stock_bill_number'=>$this->input->post('stock_bill_number'),
	        		'stock_category_id'=>$this->input->post('stock_category_id'),
	        		'stock_product_name'=>strtoupper($this->input->post('stock_product_name')),
	        		'stock_unit'=>$this->input->post('stock_unit'),
	        		'stock_qty'=>$this->input->post('stock_qty'),
	        		'stock_sch'=>$this->input->post('stock_sch'),
	        		'stock_batch'=>$this->input->post('stock_batch'),
	        		'stock_mrp'=>$this->input->post('stock_mrp'),
	        		'stock_rate'=>$this->input->post('stock_rate'),
	        		'stock_gst'=>$this->input->post('stock_gst'),
		        );

		        $this->admin->record_insert('tbl_stock',$data);

				$this->session->set_flashdata('success_message',"Stock has been created successfully");

				//redirect($_SERVER['HTTP_REFERER']);
				redirect(base_url().'medicine/stock_list');
        	}

		}

        

        $where=array(
		            	//'user_employee_type'=>'2',
    				);
        $this->data['medicine_category_list'] = $this->admin->record_list('tbl_medicine_category',$where);

        $where=array(
    				);
        $this->db->order_by('stock_id','DESC');
        $this->db->join('tbl_medicine_category','tbl_medicine_category.med_cat_id=tbl_stock.stock_category_id');
        $this->data['medicine_record'] = $this->admin->record_list('tbl_stock',$where);
        
		$this->load->view('medicine/add-stock',$this->data);
	}

	public function update_stock()
	{

		if (!$this->admin->check_user_access('update-medicine')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update Stock";

		if (isset($_POST['btn_add_med_stock'])) {
			
			$this->form_validation->set_rules('stock_product_name','Name','required|xss_clean');
			
			$this->form_validation->set_rules('stock_qty','Name','required|xss_clean');
			
			$this->form_validation->set_rules('stock_mrp','MRP','required|xss_clean');
			
			$this->form_validation->set_rules('stock_rate','Rate','required|xss_clean');
			
			
        	if($this->form_validation->run()){

        		//unset($_POST['btn_add_med_cat']);
		        //$data=$_POST;
		        
	 			$where=array(
	        		'stock_id'=>$this->input->post('stock_id'),
		        );

	 			$data=array(
	        		'stock_bill_number'=>$this->input->post('stock_bill_number'),
	        		'stock_category_id'=>$this->input->post('stock_category_id'),
	        		'stock_product_name'=>strtoupper($this->input->post('stock_product_name')),
	        		'stock_unit'=>$this->input->post('stock_unit'),
	        		'stock_qty'=>$this->input->post('stock_qty'),
	        		'stock_sch'=>$this->input->post('stock_sch'),
	        		'stock_batch'=>$this->input->post('stock_batch'),
	        		'stock_mrp'=>$this->input->post('stock_mrp'),
	        		'stock_rate'=>$this->input->post('stock_rate'),
	        		'stock_gst'=>$this->input->post('stock_gst'),
		        );
		        $this->admin->records_update('tbl_stock',$data,$where);

				$this->session->set_flashdata('success_message',"Stock has been Updated successfully");

				//redirect($_SERVER['HTTP_REFERER']);

				redirect(base_url().'medicine/stock_list');
        	}

		}

        /*$where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);*/


        $where=array(
        			'stock_id'=>$this->uri->segment('3')
    				);
     	$medicine_info= $this->admin->record_list('tbl_stock',$where);
		
		$this->data['medicine_info']=$medicine_info[0];
		
		if (!$this->data['medicine_info']) {
			redirect(base_url('medicine/stock'));
		}

        $where=array(
		            	//'user_employee_type'=>'2',
    				);
        $this->data['medicine_category_list'] = $this->admin->record_list('tbl_medicine_category',$where);

		$this->load->view('medicine/add-stock',$this->data);
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

	public function agency_list()
	{

		if (!$this->admin->check_user_access('medicine-category-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			//'tbl_user.user_id !='=>'1',
        			//'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
    				);
        $this->db->order_by('agency_id','DESC');
        $this->data['medicine_record'] = $this->admin->record_list('tbl_med_agency',$where);
        
		$this->data['page_title'] = "Agency";

		$this->load->view('medicine/medicine-agency-list',$this->data);

	}


	public function add_agency()
	{

		if (!$this->admin->check_user_access('add-medicine-category')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Agency";

		if (isset($_POST['btn_add_med_cat'])) {
			
			//$this->form_validation->set_rules('med_cat_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('agency_name','Name','required|xss_clean');
			
			
        	if($this->form_validation->run()){

		        $data=array(
		            'agency_name'=>$this->input->post('agency_name'),
		            'agency_status'=>$this->input->post('agency_status'),

		        );
		        $this->admin->record_insert('tbl_med_agency',$data);

				$this->session->set_flashdata('success_message',"Agency has been created successfully");

				//redirect($_SERVER['HTTP_REFERER']);
				redirect(base_url().'medicine/agency_list');
        	}

		}

        

        $where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);

		$this->load->view('medicine/medicine-agency-update',$this->data);
	}

	public function update_agency()
	{

		if (!$this->admin->check_user_access('update-medicine-category')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update Agency";

		if (isset($_POST['btn_add_med_cat'])) {
			
			$this->form_validation->set_rules('agency_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('agency_name','Name','required|xss_clean');
			
        	if($this->form_validation->run()){

		        $data=array(
		            'agency_name'=>$this->input->post('agency_name'),
		            'agency_status'=>$this->input->post('agency_status'),
		        );
	 			$where=array(
	        		'agency_id'=>$this->input->post('agency_id'),
		        );

		        $this->admin->records_update('tbl_med_agency',$data,$where);

				$this->session->set_flashdata('success_message',"Agency has been Updated successfully");

				//redirect($_SERVER['HTTP_REFERER']);

				redirect(base_url().'medicine/agency_list');
        	}

		}

        /*$where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);*/


        $where=array(
        			'agency_id'=>$this->uri->segment('3')
    				);
     	$medicine_info= $this->admin->record_list('tbl_med_agency',$where);
		
		$this->data['medicine_info']=$medicine_info[0];
		
		if (!$this->data['medicine_info']) {
			redirect(base_url('medicine/agency_list'));
		}

		$this->load->view('medicine/medicine-agency-update',$this->data);
	}



}
