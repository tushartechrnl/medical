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


	public function billing()
	{

		if (!$this->admin->check_user_access('user-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			//'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
    				);
        $this->db->order_by('tbl_customer_bill.bill_id','DESC');
        $this->db->join('tbl_payment_option','tbl_payment_option.option_id=tbl_customer_bill.bill_payment_mode');
        $this->db->join('tbl_user','tbl_user.user_id=tbl_customer_bill.bill_customer_id');
        $this->db->select('tbl_user.*,tbl_customer_bill.*,tbl_payment_option.option_name','left');
        $this->data['billing_record'] = $this->admin->record_list('tbl_customer_bill',$where);
        
		$this->data['page_title'] = "Billing List";

		$this->load->view('medicine/billing-list',$this->data);

	}


	public function billing_customer()
	{

		if (isset($_POST['btn_add_customer'])) {
			
			$this->form_validation->set_rules('cart_user_id','ID','required|xss_clean');
			
			
        	if($this->form_validation->run()){

        		
				$this->session->set_userdata('customer_id',$this->input->post('cart_user_id'));

				redirect(base_url().'medicine/billing_counter');

        	}
        
        }

        $where=array(
        			'tbl_user.user_id !='=>'1',
        			'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
    				);
		$report_to = array('3');
		$this->db->where_in('user_employee_type', $report_to);

        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->data['patient_record'] = $this->admin->record_list('tbl_user',$where);
        
		$this->data['page_title'] = "Billing Customer";

		$this->load->view('medicine/billing-customer',$this->data);

	}


	public function billing_counter()
	{

		if (!$this->admin->check_user_access('medicine-list')) {
			redirect(base_url().'dashboard');
		}

		if (!$this->session->userdata('customer_id')) {
			redirect(base_url().'medicine/billing_customer');
		}

        $where=array(
	        			'is_stock_out'=>0,
    				);
        $this->db->order_by('stock_id','DESC');
        $this->db->join('tbl_medicine_category','tbl_medicine_category.med_cat_id=tbl_stock.stock_category_id');
        $this->data['medicine_record'] = $this->admin->record_list('tbl_stock',$where);
        
        
		if (isset($_POST['btn_add_med_stock'])) {

			foreach ($this->input->post('cart_price') as $key110 => $value110) {
				
				$minus_from_stock=0;

		        $where=array(
			        			'is_paid_cart'=>0,
	        					'cart_id'=>$key110,
		    				);
        		$this->db->join('tbl_stock','tbl_stock.stock_id=tbl_cart.cart_stock_id');
		        $check_cart = $this->admin->record_list('tbl_cart',$where);
		        	

	        	if (isset($check_cart[0]->cart_id)) {

					//echo $check_cart[0]->stock_unit.' Unit <br>';
					//echo $check_cart[0]->cart_qty.' cart_qty <br>';
					//echo $check_cart[0]->stock_total_qty_sale.' stock_total_qty_sale <br>';

	        		if ($check_cart[0]->is_cutting==1) {
	        			//echo is_int($check_cart[0]->stock_total_qty_sale);

    					$value = $check_cart[0]->stock_total_qty_sale;
						$integer = floor($value); // 3
						$decimal = $value - $integer; //0.3

						//echo $decimal.' Decimal <br>';
						
						if($decimal < $check_cart[0]->cart_qty/100){ //true
							$minus_from_stock=$check_cart[0]->stock_total_qty_sale-1;

							$minus_from_stock+=(($check_cart[0]->stock_unit)/100)-($check_cart[0]->cart_qty/100);
							//
							//echo $minus_from_stock."big  <br>";
							//echo $minus_from_stock."big  <br>";
						}else{
							//echo "small";
							//$minus_from_stock=$check_cart[0]->stock_total_qty_sale;

							$minus_from_stock=$check_cart[0]->stock_total_qty_sale-($check_cart[0]->cart_qty/100);
						}

        				//echo "float done ";
	        		}else{
						$minus_from_stock=$check_cart[0]->stock_total_qty_sale-$check_cart[0]->cart_qty;
	        		}
		        			
	        		$where156=array(
	        					'cart_id'=>$key110,
			        );
			        $data156=array(
			            'cart_price'=>$value110,
	        			'is_paid_cart'=>1,
			        );
			        $this->admin->records_update('tbl_cart',$data156,$where156);

	        		$where156=array(
	        						'stock_id'=>$check_cart[0]->stock_id,
			        );
			        $data156=array(
	            					'stock_total_qty_sale'=>$minus_from_stock,
			        );
			        $this->admin->records_update('tbl_stock',$data156,$where156);

	        	}
	        	//echo $minus_from_stock.'<br>';
	        	//exit;



			}

			/*echo "<pre>";
			print_r($_POST);
			exit;*/
			if ($this->input->post('cart_price')) {
				
	 			$data=array(
    				'bill_customer_id'=>$this->session->userdata('customer_id'),
	        		'bill_doctor_id'=>$this->input->post('doctor_id'),
	        		'bill_details'=>json_encode($this->input->post('cart_price')),
	        		'bill_total_amount'=>round($this->input->post('bill_total_amount')),
	        		'bill_total_discount'=>round($this->input->post('total_discount')),
	        		'bill_total_net'=>round($this->input->post('total_net')),
	        		'bill_payment_mode'=>$this->input->post('bill_payment_mode'),
		        );

		        $this->admin->record_insert('tbl_customer_bill',$data);

		        $insert_id=$this->db->insert_id();


				foreach ($this->input->post('cart_price') as $key110 => $value110) {

	        		$where156=array(
	        					'cart_id'=>$key110,
			        );
			        $data156=array(
			            'cart_billing_number'=>$insert_id,
			        );
			        $this->admin->records_update('tbl_cart',$data156,$where156);

				}
        		
				$this->session->set_flashdata('success_message',"Bill successfully created.");

			}

			//redirect($_SERVER['HTTP_REFERER']);
			$this->session->unset_userdata('customer_id');
			
			redirect(base_url().'medicine/billing');

		}
		
		
		if (isset($_POST['btn_submit_to_cart'])) {
			
			//$this->form_validation->set_rules('med_cat_id','ID','required|xss_clean');
					
			$this->form_validation->set_rules('cart_stock_id','Name','required|xss_clean');
			
			$this->form_validation->set_rules('cart_qty','Name','required|xss_clean|numeric');
			
			
        	if($this->form_validation->run()){

		        $where=array(
			        			'is_stock_out'=>0,
	        					'stock_id'=>$this->input->post('cart_stock_id'),
		    				);
		        $this->db->order_by('stock_id','DESC');
		        $this->db->join('tbl_medicine_category','tbl_medicine_category.med_cat_id=tbl_stock.stock_category_id');
		        $check_stock = $this->admin->record_list('tbl_stock',$where);
		        	
	        	if (isset($check_stock[0]->stock_id)) {

	        		$cart_qty=0;
	        		$cart_actual_price=0;
	        		$cart_price=0;


	        		if ($this->input->post('is_cutting')==1) {
	        			
		        		$cart_qty=$this->input->post('cart_qty');

		        		$apcalculate=$check_stock[0]->stock_rate+(($check_stock[0]->stock_rate*$check_stock[0]->stock_gst)/100);

		        		$cart_actual_price=$apcalculate/$check_stock[0]->stock_unit;

		        		$cart_actual_price*=$cart_qty;

		        		$cart_price=$check_stock[0]->stock_mrp/$check_stock[0]->stock_unit;

		        		$cart_price*=$cart_qty;

	        		}else{

		        		$cart_qty=$this->input->post('cart_qty');

		        		$cart_actual_price=$check_stock[0]->stock_rate+(($check_stock[0]->stock_rate*$check_stock[0]->stock_gst)/100);
		        		//$cart_actual_price=$check_stock[0]->stock_rate;

		        		$cart_actual_price*=$cart_qty;

		        		$cart_price=$check_stock[0]->stock_mrp;

		        		$cart_price*=$cart_qty;

	        		}

	        		
	        		
		        		
		 			$data=array(
        				'cart_user_id'=>$this->session->userdata('customer_id'),
		        		'cart_stock_id'=>$this->input->post('cart_stock_id'),
		        		'is_cutting'=>$this->input->post('is_cutting'),
		        		'cart_qty'=>$cart_qty,
		        		'cart_price_rate_gst'=>round($cart_actual_price,2),
		        		'cart_price_mrp'=>round($cart_price,2),
		        		'cart_price'=>round($cart_price,2),
			        );
	        		//unset($_POST['btn_add_med_cat']);

			        $this->admin->record_insert('tbl_cart',$data);

	        	}
        		
				$this->session->set_flashdata('success_message',"Added to cart.");

				redirect(base_url().'medicine/billing_counter');
				//redirect($_SERVER['HTTP_REFERER']);
				//redirect(base_url().'medicine');
        	}

		}

        $where=array(
	        			//'tbl_user.user_id !='=>'1',
	        			'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
        				'tbl_user.user_id'=>$this->session->userdata('customer_id'),
    				);
		$report_to = array('3');
		$this->db->where_in('user_employee_type', $report_to);

        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->data['patient_record'] = $this->admin->record_list('tbl_user',$where);
        
        $where=array(
        			'tbl_user.user_id !='=>'1',
        			'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
    				);
		$report_to = array('2');
		$this->db->where_in('user_employee_type', $report_to);

        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->data['doctor_record'] = $this->admin->record_list('tbl_user',$where);
        
        $where=array(
	        			'cart_user_id'=>$this->session->userdata('customer_id'),
        				'is_paid_cart'=>0,
    				);
        $this->db->order_by('stock_id','DESC');
        $this->db->join('tbl_stock','tbl_stock.stock_id=tbl_cart.cart_stock_id');
        $this->db->join('tbl_medicine_category','tbl_medicine_category.med_cat_id=tbl_stock.stock_category_id');
        $this->data['cart_record'] = $this->admin->record_list('tbl_cart',$where);
        
        $where=array(
        			'option_status'=>'1',
    				);
        $this->data['bill_payment_mode'] = $this->admin->record_list('tbl_payment_option',$where);
        
		$this->data['page_title'] = "Billing Counter";

		$this->load->view('medicine/billing',$this->data);

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
        
    //     foreach ($this->data['medicine_record'] as $key => $value) {

 			// $data=array(
    //     		'stock_total_qty'=>$value->stock_qty+$value->stock_sch,
    //     		'stock_total_qty_sale'=>$value->stock_qty+$value->stock_sch,
	   //      );
 			// $where=array(
    //     		'stock_id'=>$value->stock_id,
	   //      );

	   //      $this->admin->records_update('tbl_stock',$data,$where);
    	
    //     }

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
					
			$this->form_validation->set_rules('stock_agency_id','Agency','required|xss_clean');
			
			$this->form_validation->set_rules('stock_product_name','Name','required|xss_clean');
			
			$this->form_validation->set_rules('stock_qty','Name','required|xss_clean');
			
			$this->form_validation->set_rules('stock_mrp','MRP','required|xss_clean');
			
			$this->form_validation->set_rules('stock_rate','Rate','required|xss_clean');
			
			
        	if($this->form_validation->run()){

        		
	 			$data=array(
	        		'stock_agency_id'=>$this->input->post('stock_agency_id'),

	        		'stock_bill_number'=>$this->input->post('stock_bill_number'),
	        		'stock_category_id'=>$this->input->post('stock_category_id'),
	        		'stock_product_name'=>strtoupper($this->input->post('stock_product_name')),
	        		'stock_unit'=>$this->input->post('stock_unit'),
	        		'stock_uom'=>$this->input->post('stock_uom'),

	        		'stock_qty'=>$this->input->post('stock_qty'),
	        		'stock_sch'=>$this->input->post('stock_sch'),
	        		'stock_total_qty'=>$this->input->post('stock_qty')+$this->input->post('stock_sch'),
	        		'stock_total_qty_sale'=>$this->input->post('stock_qty')+$this->input->post('stock_sch'),

	        		'stock_batch'=>$this->input->post('stock_batch'),
	        		'stock_mrp'=>$this->input->post('stock_mrp'),
	        		'stock_rate'=>$this->input->post('stock_rate'),
	        		'stock_gst'=>$this->input->post('stock_gst'),
	        		
	        		'stock_expiry_date'=>$this->input->post('stock_expiry_date'),
	        		'stock_discount_percent'=>$this->input->post('stock_discount_percent'),
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
		            	'agency_status'=>'1',
    				);
        $this->data['medicine_agency_list'] = $this->admin->record_list('tbl_med_agency',$where);

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
			
			$this->form_validation->set_rules('stock_agency_id','Agency','required|xss_clean');
			
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
	        		'stock_agency_id'=>$this->input->post('stock_agency_id'),
	 				
	        		'stock_bill_number'=>$this->input->post('stock_bill_number'),
	        		'stock_category_id'=>$this->input->post('stock_category_id'),
	        		'stock_product_name'=>strtoupper($this->input->post('stock_product_name')),
	        		'stock_unit'=>$this->input->post('stock_unit'),
	        		'stock_uom'=>$this->input->post('stock_uom'),
	        		'stock_qty'=>$this->input->post('stock_qty'),
	        		'stock_sch'=>$this->input->post('stock_sch'),
	        		'stock_total_qty'=>$this->input->post('stock_qty')+$this->input->post('stock_sch'),
	        		'stock_total_qty_sale'=>$this->input->post('stock_qty')+$this->input->post('stock_sch'),
	        		'stock_batch'=>$this->input->post('stock_batch'),
	        		'stock_mrp'=>$this->input->post('stock_mrp'),
	        		'stock_rate'=>$this->input->post('stock_rate'),

	        		'stock_expiry_date'=>$this->input->post('stock_expiry_date'),
	        		'stock_discount_percent'=>$this->input->post('stock_discount_percent'),
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

        $where=array(
		            	//'agency_status'=>'2',
    				);
        $this->data['medicine_agency_list'] = $this->admin->record_list('tbl_med_agency',$where);

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
