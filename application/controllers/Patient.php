<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->admin->login_check();		

	}   


	public function index()
	{

		if (!$this->admin->check_user_access('patient-list')) {
			redirect(base_url().'dashboard');
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
        $this->data['user_record'] = $this->admin->record_list('tbl_user',$where);
        
		$this->data['page_title'] = "Patient";

		$this->load->view('patient/user-list',$this->data);

	}

	public function get_treatment_adviced()
	{
		$result_return="<option data-kt-flag='flags/indonesia.svg' value=''>Not advice</option>";

        $where=array(
        			'ttm_user_id'=>$this->input->post('appointment_patient_id'),
    				);
        $treatment_record = $this->admin->record_list('tbl_treatment',$where);

				//$result_return.=$this->db->last_query();
        $where=array(
    				);
        $detal_treat_record = $this->admin->record_list('tbl_detal_numbering',$where);
        
		if ($treatment_record) {

			foreach ($treatment_record as $key => $value) {
				
				$ttm_deails=json_decode($value->ttm_treatment_details);

					$result_return.= "<option value='".$value->ttm_id."' >Dent Number : ";
				foreach ($ttm_deails as $key22 => $value22) {

					foreach ($detal_treat_record as $key21 => $value21) {
					
					
						if ($value21->dental_id==$value22) {
							$result_return.= $value21->dental_number_id.",";
						}

					}

				}
					
					$result_return.= '</option>';

			}

		}

        echo $result_return;
	}


	public function treatment()
	{


		if (!$this->admin->check_user_access('treatment-list')) {
			redirect(base_url().'dashboard');
		}

		$this->session->unset_userdata('manual_order');

		if (!$this->uri->segment('3')) {
			redirect(base_url('patient'));
		}

        $where=array(
        			//'tbl_user.user_id !='=>'1',
        			'ttm_user_id'=>$this->uri->segment('3'),
    				);
        $this->db->group_by('tbl_treatment.ttm_id');
        $this->db->join('tbl_treatment_payment','tbl_treatment_payment.payment_ttm_id=tbl_treatment.ttm_id','left');
        $this->db->select('tbl_treatment.*,SUM(tbl_treatment_payment.payment_fees) as total_payment');
        $this->data['user_record'] = $this->admin->record_list('tbl_treatment',$where);
        
        $where=array(
    				);
        $this->data['detal_adv_record'] = $this->admin->record_list('tbl_treatment_adviced',$where);
        
		$this->data['page_title'] = "Treatment ";

		$this->load->view('patient/treatment-list',$this->data);

	}

	public function add_treatment()
	{

		if (!$this->admin->check_user_access('add-treatment')) {
			redirect(base_url().'dashboard');
		}

		if (!$this->uri->segment('3')) {
			redirect(base_url('patient'));
		}

		$this->data['page_title'] = "Add Treatment";

        if (isset($_POST['btn_add_to_cart'])) {

            $this->form_validation->set_rules('teeth_treatment[]','Teeth','required|xss_clean');
            
            $this->form_validation->set_rules('ttm_treatment','Treatment','required|xss_clean');
            
            if($this->form_validation->run()){
		
		        $where=array(
				            	'ttmad_id'=>$this->input->post("ttm_treatment"),
		    				);
		        $treatment_advice = $this->admin->record_list('tbl_treatment_adviced',$where);
		        	
		        	//echo $value;
		        	/*echo "<pre>";
		        	print_r($treatment_advice[0]->ttmad_fees);
		        	exit;*/

                $manual_order=array();
                
                $ttmad_total_fees=count($this->input->post("teeth_treatment"))*$treatment_advice[0]->ttmad_fees;
                
                $manual_order[]=array(
                        "teeth_treatment"=>json_encode($this->input->post("teeth_treatment")),
                        "ttm_treatment"=>$this->input->post("ttm_treatment"),
                        "ttmad_name"=>$treatment_advice[0]->ttmad_name,
                        "ttmad_fees"=>$treatment_advice[0]->ttmad_fees,
                        "ttmad_total_fees"=>$ttmad_total_fees,
                    );


                if ($this->session->userdata("manual_order")) {
                    $manual_order=array_merge($this->session->userdata("manual_order"),$manual_order);
                }


                $this->session->set_userdata('manual_order',json_decode(json_encode($manual_order)));

            }

        }

		if (isset($_POST['btn_add_tretment'])) {
			/*echo "<pre>";
			print_r($_POST);
			exit;*/

			
			//$this->form_validation->set_rules('ttm_treatment_details[]','Treatment Details','required|xss_clean');
			
			$this->form_validation->set_rules('ttm_status','Status','required|xss_clean');

			$this->form_validation->set_rules('net_amount','Amount','required|xss_clean|numeric');

			
        	if($this->form_validation->run()){
        		
        		/*echo "<pre>";
        		print_r($_POST);
        		exit;*/

		        $data=array(
		            'ttm_user_id'=>$this->uri->segment("3"),
		            'ttm_treatment_details'=>json_encode($this->session->userdata('manual_order')),
		            'ttm_payment_details'=>json_encode($this->input->post()),
		            'ttm_fees'=>$this->input->post('net_amount'),
		            'ttm_status'=>$this->input->post('ttm_status'),
		        );
		        $this->admin->record_insert('tbl_treatment',$data);

				$this->session->unset_userdata('manual_order');
				$this->session->set_flashdata('success_message',"Treatment created successfully");

				redirect(base_url().'patient/treatment/'.$this->uri->segment("3"));
        	}

		}

        $where=array(
    				);
        $this->data['detal_treat_record'] = $this->admin->record_list('tbl_detal_numbering',$where);
        
        $where=array(
		            	'ttmad_status'=>'1',
    				);
        $this->data['treatment_record'] = $this->admin->record_list('tbl_treatment_adviced',$where);
        
		$this->load->view('patient/treatment-update',$this->data);
	}

	public function remove_treatment()
	{
		//echo "<pre>";
		$manual_order=(array) $this->session->userdata("manual_order");
		//print_r($manual_order[$this->uri->segment("4")]);
		unset($manual_order[$this->uri->segment("4")]);
		//exit;
		$manual_order=json_encode($manual_order);
        $this->session->set_userdata('manual_order',json_decode($manual_order));
        
        redirect($_SERVER['HTTP_REFERER']);
	}

	public function update_treatment()
	{

		if (!$this->admin->check_user_access('update-treatment')) {
			redirect(base_url().'dashboard');
		}

		if (!$this->uri->segment('3') || !$this->uri->segment('4')) {
			redirect(base_url('patient'));
		}
		
		$this->data['page_title'] = "Update Treatment";

        if (isset($_POST['btn_add_to_cart'])) {

            $this->form_validation->set_rules('teeth_treatment[]','Teeth','required|xss_clean');
            
            $this->form_validation->set_rules('ttm_treatment','Treatment','required|xss_clean');
            
            if($this->form_validation->run()){
		
		        $where=array(
				            	'ttmad_id'=>$this->input->post("ttm_treatment"),
		    				);
		        $treatment_advice = $this->admin->record_list('tbl_treatment_adviced',$where);
		        	
		        	//echo $value;
		        	/*echo "<pre>";
		        	print_r($treatment_advice[0]->ttmad_fees);
		        	exit;*/

                $manual_order=array();
                
                $ttmad_total_fees=count($this->input->post("teeth_treatment"))*$treatment_advice[0]->ttmad_fees;
                
                $manual_order[]=array(
                        "teeth_treatment"=>json_encode($this->input->post("teeth_treatment")),
                        "ttm_treatment"=>$this->input->post("ttm_treatment"),
                        "ttmad_name"=>$treatment_advice[0]->ttmad_name,
                        "ttmad_fees"=>$treatment_advice[0]->ttmad_fees,
                        "ttmad_total_fees"=>$ttmad_total_fees,
                    );


                if ($this->session->userdata("manual_order")) {
                    $manual_order=array_merge($this->session->userdata("manual_order"),$manual_order);
                }


                $this->session->set_userdata('manual_order',json_decode(json_encode($manual_order)));

            }

        }

		if (isset($_POST['btn_add_tretment'])) {
			

			
			//$this->form_validation->set_rules('ttm_treatment_details[]','Treatment Details','required|xss_clean');
			
			$this->form_validation->set_rules('ttm_status','Status','required|xss_clean');

			$this->form_validation->set_rules('net_amount','Amount','required|xss_clean|numeric');

			
        	if($this->form_validation->run()){

        		$where=array(

		            'ttm_id'=>$this->uri->segment("3"),
		            //'ttm_treatment_details'=>json_encode($this->input->post('ttm_treatment_details[]')),
		            //'ttm_status'=>$this->input->post('ttm_status'),
		        );
		        $data=array(

		            'ttm_treatment_details'=>json_encode($this->session->userdata('manual_order')),
		            'ttm_payment_details'=>json_encode($this->input->post()),
		            'ttm_fees'=>$this->input->post('net_amount'),
		            'ttm_status'=>$this->input->post('ttm_status'),
		        );
		        $this->admin->records_update('tbl_treatment',$data,$where);

				$this->session->unset_userdata('manual_order');
				$this->session->set_flashdata('success_message',"Treatment updated successfully");

				redirect(base_url().'patient/treatment/'.$this->uri->segment("4"));
			}

		}

        $where=array(
    				);
        $this->data['detal_treat_record'] = $this->admin->record_list('tbl_detal_numbering',$where);
        
        $where=array(
        				'ttm_id'=>$this->uri->segment("3"),
    				);
        $this->data['dental_info'] = $this->admin->record_list('tbl_treatment',$where);
        

		if (isset($this->data['dental_info'][0]->ttm_id)) {
			$this->data['dental_info'] = $this->data['dental_info'][0];

			//redirect(base_url('user'));
		}else{
			redirect(base_url('patient'));
		}
        /*echo "<pre>";
        print_r($this->data['dental_info']);
        echo $this->data['dental_info']->ttm_status;
        exit;*/

        $where=array(
		            	'ttmad_status'=>'1',
    				);
        $this->data['treatment_record'] = $this->admin->record_list('tbl_treatment_adviced',$where);
        
		$this->load->view('patient/treatment-update',$this->data);
	}

	public function payment()
	{

		if (!$this->uri->segment('3') || !$this->uri->segment('4')) {
			redirect(base_url('patient'));
		}


		if (!$this->admin->check_user_access('payment-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			//'tbl_user.user_id !='=>'1',
        			'ttm_user_id'=>$this->uri->segment('3'),
    				);
        $this->data['user_record'] = $this->admin->record_list('tbl_treatment',$where);
        
        $where=array(
    				);
        $this->data['detal_treat_record'] = $this->admin->record_list('tbl_detal_numbering',$where);
        
        $where=array(
        				'payment_ttm_id'=>$this->uri->segment('3'),
        				'payment_user_id'=>$this->uri->segment("4"),
    				);
        $this->data['treatment_payment_record'] = $this->admin->record_list('tbl_treatment_payment',$where);

        /*echo "<pre>";
        print_r($this->data['treatment_payment_record']);
        exit;*/
		
		$this->data['page_title'] = "Payment ";

		$this->load->view('patient/payment-list',$this->data);

	}


	public function treatment_advice()
	{


		if (!$this->admin->check_user_access('patient-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			//'tbl_user.user_id !='=>'1',
        			//'ttm_user_id'=>$this->uri->segment('3'),
    				);
        $this->data['treatment_record'] = $this->admin->record_list('tbl_treatment_adviced',$where);
        
		$this->data['page_title'] = "Treatment Advice";

		$this->load->view('patient/treatment-advice-list',$this->data);

	}

	public function add_treatment_advice()
	{

		if (!$this->admin->check_user_access('add-patient')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Treatment Advice";

		if (isset($_POST['btn_add_tretment'])) {
			// echo "<pre>";
			// print_r($_POST);
			// exit;

			
			
			//$this->form_validation->set_rules('payment_user_id','Status','required|xss_clean');

			$this->form_validation->set_rules('ttmad_name','Name','required|xss_clean');

			$this->form_validation->set_rules('ttmad_fees','Amount','required|xss_clean|numeric');

			
        	if($this->form_validation->run()){
        		
        		/*echo "<pre>";
        		print_r($_POST);
        		exit;*/

		        $data=array(
		            'ttmad_name'=>$this->input->post('ttmad_name'),
		            'ttmad_fees'=>$this->input->post('ttmad_fees'),
		            'ttmad_status'=>$this->input->post('ttmad_status'),
		        );
		        $this->admin->record_insert('tbl_treatment_adviced',$data);

				$this->session->set_flashdata('success_message',"Treatment advice created successfully");

				redirect(base_url().'patient/treatment_advice/');
        	}

		}

        
		$this->load->view('patient/treatment-advice-update',$this->data);
	}

	public function update_treatment_advice()
	{

		if (!$this->admin->check_user_access('add-patient')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
    				);
        $this->data['detal_treat_record'] = $this->admin->record_list('tbl_detal_numbering',$where);
        
        $where=array(
        				'ttmad_id'=>$this->uri->segment("3"),
    				);
        $this->data['dental_info'] = $this->admin->record_list('tbl_treatment_adviced',$where);
        

		if (isset($this->data['dental_info'][0]->ttmad_id)) {
			$this->data['dental_info'] = $this->data['dental_info'][0];

			//redirect(base_url('user'));
		}else{
			redirect(base_url('patient/treatment_advice'));
		}

		$this->data['page_title'] = "Update Treatment Advice";

		if (isset($_POST['btn_add_tretment'])) {
			// echo "<pre>";
			// print_r($_POST);
			// exit;

			$this->form_validation->set_rules('ttmad_name','Name','required|xss_clean');

			$this->form_validation->set_rules('ttmad_fees','Amount','required|xss_clean|numeric');

			
        	if($this->form_validation->run()){
        		/*echo "<pre>";
        		print_r($_POST);
        		exit;*/
        		$where=array(

		            'ttmad_id'=>$this->uri->segment("3"),
		        );
		        $data=array(
		            'ttmad_name'=>$this->input->post('ttmad_name'),
		            'ttmad_fees'=>$this->input->post('ttmad_fees'),
		            'ttmad_status'=>$this->input->post('ttmad_status'),
		        );
		        $this->admin->records_update('tbl_treatment_adviced',$data,$where);

				$this->session->set_flashdata('success_message',"Treatment advice updated successfully");

				redirect(base_url().'patient/treatment_advice/');
        	}

		}

        $where=array(
    				);
        $this->data['detal_treat_record'] = $this->admin->record_list('tbl_detal_numbering',$where);
        
		$this->load->view('patient/treatment-advice-update',$this->data);
	}

	public function add_payment()
	{

		if (!$this->admin->check_user_access('add-payment')) {
			redirect(base_url().'dashboard');
		}

		if (!$this->uri->segment('3') || !$this->uri->segment('4')) {
			redirect(base_url('patient'));
		}

		$this->data['page_title'] = "Add Payment";

		if (isset($_POST['btn_add_payment'])) {
			// echo "<pre>";
			// print_r($_POST);
			// exit;

			
			
			$this->form_validation->set_rules('payment_user_id','Status','required|xss_clean');

			$this->form_validation->set_rules('payment_ttm_id','Fee','required|xss_clean|numeric');

			$this->form_validation->set_rules('payment_fees','Amount','required|xss_clean|numeric');

			
        	if($this->form_validation->run()){
        		
        		/*echo "<pre>";
        		print_r($_POST);
        		exit;*/

		        $data=array(
		            'payment_user_id'=>$this->input->post('payment_user_id'),
		            'payment_ttm_id'=>$this->input->post('payment_ttm_id'),
		            'payment_fees'=>$this->input->post('payment_fees'),
		            'payment_mode'=>$this->input->post('payment_mode'),
		            'payment_paid_via'=>$this->input->post('payment_paid_via'),
		        );
		        $this->admin->record_insert('tbl_treatment_payment',$data);

				$this->session->set_flashdata('success_message',"Treatment payment created successfully");

				redirect(base_url().'patient/payment/'.$this->uri->segment("3").'/'.$this->uri->segment("4"));
        	}

		}

        $where=array(
    				);
        $this->data['detal_treat_record'] = $this->admin->record_list('tbl_detal_numbering',$where);
        
        $where=array(
        				'option_status'=>'1',
    				);
        $this->data['payment_option_record'] = $this->admin->record_list('tbl_payment_option',$where);
        
		$this->load->view('patient/payment-add',$this->data);
	}

	public function update_payment()
	{

		if (!$this->admin->check_user_access('update-payment')) {
			redirect(base_url().'dashboard');
		}

		if (!$this->uri->segment('3') || !$this->uri->segment('4')) {
			redirect(base_url('patient'));
		}

        $where=array(
    				);
        $this->data['detal_treat_record'] = $this->admin->record_list('tbl_detal_numbering',$where);
        
        $where=array(
        				'payment_id'=>$this->uri->segment("3"),
    				);
        $this->data['dental_info'] = $this->admin->record_list('tbl_treatment_payment',$where);
        

		if (isset($this->data['dental_info'][0]->payment_id)) {
			$this->data['dental_info'] = $this->data['dental_info'][0];

			//redirect(base_url('user'));
		}else{
			redirect(base_url('patient'));
		}

		$this->data['page_title'] = "Update Payment";

		if (isset($_POST['btn_add_payment'])) {
			// echo "<pre>";
			// print_r($_POST);
			// exit;

			$this->form_validation->set_rules('payment_user_id','Status','required|xss_clean');

			$this->form_validation->set_rules('payment_ttm_id','Fee','required|xss_clean|numeric');

			$this->form_validation->set_rules('payment_fees','Amount','required|xss_clean|numeric');

			
        	if($this->form_validation->run()){
        		/*echo "<pre>";
        		print_r($_POST);
        		exit;*/
        		$where=array(

		            'payment_id'=>$this->uri->segment("3"),
		        );
		        $data=array(
		            'payment_user_id'=>$this->input->post('payment_user_id'),
		            //'payment_ttm_id'=>$this->input->post('payment_ttm_id'),
		            'payment_fees'=>$this->input->post('payment_fees'),
		            'payment_mode'=>$this->input->post('payment_mode'),
		            'payment_paid_via'=>$this->input->post('payment_paid_via'),
		        );
		        $this->admin->records_update('tbl_treatment_payment',$data,$where);

				$this->session->set_flashdata('success_message',"Treatment payment updated successfully");

				redirect(base_url().'patient/payment/'.$this->data['dental_info']->payment_ttm_id.'/'.$this->uri->segment("4"));
        	}

		}

        $where=array(
    				);
        $this->data['detal_treat_record'] = $this->admin->record_list('tbl_detal_numbering',$where);
        
        $where=array(
        				'option_status'=>'1',
    				);
        $this->data['payment_option_record'] = $this->admin->record_list('tbl_payment_option',$where);
        
		$this->load->view('patient/payment-add',$this->data);
	}

	public function all_appointment()
	{

		if (!$this->admin->check_user_access('all-appointment-list')) {
			redirect(base_url().'dashboard');
		}

        /*$where=array(
        			//'tbl_user.user_id !='=>'1',
        			//'tbl_user.user_id'=>$this->uri->segment('3'),
    				);
		$report_to = array('3');
		$this->db->where_in('user_employee_type', $report_to);

        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->data['user_record'] = $this->admin->record_list('tbl_user',$where);*/

        $where=array(
    				//'appointment_patient_id'=>$this->uri->segment('3'),
		            'appointment_location_id'=>$this->session->userdata('location_id'),
    				);
        if($this->session->userdata('emp_type_id')==2){
			$where['appointment_doctor_id']=$this->session->userdata('user_id');
        }
        $this->db->join('tbl_user','tbl_user.user_id=tbl_patient_appointment.appointment_doctor_id');
        $this->db->join('tbl_user abp','abp.user_id=tbl_patient_appointment.appointment_patient_id');
        $this->db->select('tbl_user.user_first_name,tbl_user.user_last_name,abp.user_first_name patient_user_first_name,abp.user_last_name patient_user_last_name,tbl_patient_appointment.*');
        $this->data['appointment_details'] = $this->admin->record_list('tbl_patient_appointment',$where);

        
		$this->data['page_title'] = "Patient Appointment";

		$this->load->view('patient/patient-appointment-list',$this->data);

	}

	public function today_appointment()
	{

		if (!$this->admin->check_user_access('today-appointment-list')) {
			redirect(base_url().'dashboard');
		}

        /*$where=array(
        			//'tbl_user.user_id !='=>'1',
        			//'tbl_user.user_id'=>$this->uri->segment('3'),
    				);
		$report_to = array('3');
		$this->db->where_in('user_employee_type', $report_to);

        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->data['user_record'] = $this->admin->record_list('tbl_user',$where);*/

        /*$where=array(
    				//'appointment_patient_id'=>$this->uri->segment('3'),
    				);*/
        $fromdate=date('Y-m-d');

        $where=array(
		            //'appointment_date_time >='=>$fromdate,
		            'appointment_location_id'=>$this->session->userdata('location_id'),
    				);
        if($this->session->userdata('emp_type_id')==2){
			$where['appointment_doctor_id']=$this->session->userdata('user_id');
        }
		$where['appointment_date_time >=']=$fromdate;
		$where['appointment_date_time <=']=$fromdate.' 23:59:59';

        $this->db->join('tbl_user','tbl_user.user_id=tbl_patient_appointment.appointment_doctor_id');
        $this->db->join('tbl_user abp','abp.user_id=tbl_patient_appointment.appointment_patient_id');
        $this->db->select('tbl_user.user_first_name,tbl_user.user_last_name,abp.user_first_name patient_user_first_name,abp.user_last_name patient_user_last_name,tbl_patient_appointment.*');
        $this->data['appointment_details'] = $this->admin->record_list('tbl_patient_appointment',$where);

        
		$this->data['page_title'] = "Todays Patient Appointment";

		$this->load->view('patient/patient-appointment-list',$this->data);

	}

	public function upcoming_appointment()
	{

		if (!$this->admin->check_user_access('upcoming-appointment-list')) {
			redirect(base_url().'dashboard');
		}

        /*$where=array(
        			//'tbl_user.user_id !='=>'1',
        			//'tbl_user.user_id'=>$this->uri->segment('3'),
    				);
		$report_to = array('3');
		$this->db->where_in('user_employee_type', $report_to);

        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->data['user_record'] = $this->admin->record_list('tbl_user',$where);*/

        /*$where=array(
    				//'appointment_patient_id'=>$this->uri->segment('3'),
    				);*/
        $fromdate=date('Y-m-d');

        $where=array(
		            //'appointment_date_time >'=>$fromdate,
		            'appointment_location_id'=>$this->session->userdata('location_id'),
    				);
        if($this->session->userdata('emp_type_id')==2){
			$where['appointment_doctor_id']=$this->session->userdata('user_id');
        }

		//$where['appointment_date_time >=']=$fromdate;
		$where['appointment_date_time >=']=$fromdate.' 23:59:59';

        $this->db->join('tbl_user','tbl_user.user_id=tbl_patient_appointment.appointment_doctor_id');
        $this->db->join('tbl_user abp','abp.user_id=tbl_patient_appointment.appointment_patient_id');
        $this->db->select('tbl_user.user_first_name,tbl_user.user_last_name,abp.user_first_name patient_user_first_name,abp.user_last_name patient_user_last_name,tbl_patient_appointment.*');
        $this->data['appointment_details'] = $this->admin->record_list('tbl_patient_appointment',$where);
        //echo $this->db->last_query();exit;
        
		$this->data['page_title'] = "Upcoming Patient Appointment";

		$this->load->view('patient/patient-appointment-list',$this->data);

	}

	public function patient_history()
	{

		if (!$this->admin->check_user_access('patient-history-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			//'tbl_user.user_id !='=>'1',
        			'tbl_user.user_id'=>$this->uri->segment('3'),
    				);
		$report_to = array('3');
		$this->db->where_in('user_employee_type', $report_to);

        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->data['user_record'] = $this->admin->record_list('tbl_user',$where);

        $where=array(
    				'appointment_patient_id'=>$this->uri->segment('3'),
    				);
        $this->db->join('tbl_user','tbl_user.user_id=tbl_patient_appointment.appointment_doctor_id');
        $this->data['appointment_details'] = $this->admin->record_list('tbl_patient_appointment',$where);

        
		$this->data['page_title'] = "Patient Appointment";
		$this->data['tab_active'] = "1st";

		$this->load->view('patient/patient-history',$this->data);

	}

	public function document_history()
	{

		if (!$this->admin->check_user_access('document-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			//'tbl_user.user_id !='=>'1',
        			'tbl_user.user_id'=>$this->uri->segment('3'),
    				);
		$report_to = array('3');
		$this->db->where_in('user_employee_type', $report_to);

        $this->db->order_by('tbl_user.user_id','DESC');
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->data['user_record'] = $this->admin->record_list('tbl_user',$where);

        $where=array(
    				'document_patient_id'=>$this->uri->segment('3'),
    				);
        // $this->db->join('tbl_user','tbl_user.user_id=tbl_patient_appointment.appointment_doctor_id');
        $this->data['appointment_details'] = $this->admin->record_list('tbl_patient_document',$where);

        
		$this->data['page_title'] = "Patient Document";
		$this->data['tab_active'] = "2nd";

		$this->load->view('patient/patient-document',$this->data);

	}

	public function add_document()
	{

		if (!$this->admin->check_user_access('add-document')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Document";

		if (isset($_POST['btn_add_appintment'])) {
			
			$this->form_validation->set_rules('document_patient_id','Doctor','required|xss_clean');
					
			$this->form_validation->set_rules('document_name','Name','required|xss_clean');
			
			
        	if($this->form_validation->run()){

				if ($_FILES) {
					
					foreach ($_FILES as $key => $value) {
						//echo $key;

						if ($_FILES[$key]['name']!="" && $key=="document_path") {

							$pet_image=$this->admin->add_image($key,"document/");
							$_POST['document_path']=$pet_image;

						}

					}

				}
				/*echo "<pre>";
				print_r($_POST);
				exit;*/
		        $data=array(
		            'document_upload_user_id'=>$this->session->userdata('user_id'),
		            'document_name'=>$this->input->post('document_name'),
		            'document_patient_id'=>$this->input->post('document_patient_id'),
		            'document_path'=>$_POST['document_path'],
		        );
		        $this->admin->record_insert('tbl_patient_document',$data);

				$this->session->set_flashdata('success_message',"Your document has been created successfully");

				//redirect($_SERVER['HTTP_REFERER']);
				redirect(base_url().'patient/document_history/'.$this->input->post('document_patient_id'));
        	}

		}

        $where=array(
    				);
        $this->data['project_location'] = $this->admin->record_list('tbl_project_location',$where);

		$this->load->view('patient/add-document',$this->data);
	}

	public function add_appointment()
	{

		if (!$this->admin->check_user_access('add-appointment')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Appointment";

		if (isset($_POST['btn_add_appintment'])) {
			
			$this->form_validation->set_rules('appointment_doctor_id','Doctor','required|xss_clean');
					
			$this->form_validation->set_rules('appointment_date_time','Email ID','required');
			
			
        	if($this->form_validation->run()){

		        $data=array(
		            'appointment_book_user_id'=>$this->session->userdata('user_id'),
		            'appointment_doctor_id'=>$this->input->post('appointment_doctor_id'),
		            'appointment_patient_id'=>$this->input->post('appointment_patient_id'),
		            'appointment_date_time'=>date('Y-m-d H:i:s', strtotime($this->input->post('appointment_date_time').' '.$this->input->post('appointment_time'))),
		            'appointment_description'=>$this->input->post('appointment_description'),
		            'appointment_remark'=>$this->input->post('appointment_remark'),
		            'appointment_status'=>$this->input->post('appointment_status'),
		            'appointment_location_id'=>$this->session->userdata('location_id'),

		        );
		        $this->admin->record_insert('tbl_patient_appointment',$data);

				$this->session->set_flashdata('success_message',"Your appointment has been created successfully");

				//redirect($_SERVER['HTTP_REFERER']);
				redirect(base_url().'patient/patient_history/'.$this->input->post('appointment_patient_id'));
        	}

		}

        $where=array(
    				);
        $this->data['project_location'] = $this->admin->record_list('tbl_project_location',$where);

        $where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);

		$this->load->view('patient/add-appointment',$this->data);
	}

	public function update_appointment()
	{

		if (!$this->admin->check_user_access('update-appointment')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update Appointment";

		if (isset($_POST['btn_add_appintment'])) {
			
			$this->form_validation->set_rules('appointment_doctor_id','Doctor','required|xss_clean');
					
			$this->form_validation->set_rules('appointment_date_time','Email ID','required');
			
        	if($this->form_validation->run()){

		        $data=array(
		            'appointment_book_user_id'=>$this->session->userdata('user_id'),
		            'appointment_doctor_id'=>$this->input->post('appointment_doctor_id'),
		            'appointment_patient_id'=>$this->input->post('appointment_patient_id'),
		            'appointment_date_time'=>date('Y-m-d H:i:s', strtotime($this->input->post('appointment_date_time').' '.$this->input->post('appointment_time'))),
		            'appointment_description'=>$this->input->post('appointment_description'),
		            'appointment_remark'=>$this->input->post('appointment_remark'),
		            'appointment_status'=>$this->input->post('appointment_status'),
		            'appointment_location_id'=>$this->session->userdata('location_id'),
		        );
	 			$where=array(
	        		'appointment_id'=>$this->input->post('appointment_id'),
		        );

		        $this->admin->records_update('tbl_patient_appointment',$data,$where);

				$this->session->set_flashdata('success_message',"Appointment information has been Updated successfully");

				//redirect($_SERVER['HTTP_REFERER']);

				redirect(base_url().'patient/patient_history/'.$this->input->post('appointment_patient_id'));
        	}

		}

        $where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);


        $where=array(
        			'appointment_id'=>$this->uri->segment('4')
    				);
     	$patient_info= $this->admin->record_list('tbl_patient_appointment',$where);
		
		$this->data['patient_info']=$patient_info[0];
		
		if (!$this->data['patient_info']) {
			redirect(base_url('patient'));
		}

		$this->load->view('patient/add-appointment',$this->data);
	}

	public function add_appointment_patient()
	{

		if (!$this->admin->check_user_access('add-appointment')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Appointment";

		if (isset($_POST['btn_add_appintment'])) {
			
			$this->form_validation->set_rules('appointment_patient_id','Patient','required|xss_clean');
					
			$this->form_validation->set_rules('appointment_doctor_id','Doctor','required|xss_clean');
					
			$this->form_validation->set_rules('appointment_date_time','Email ID','required');
			
			
        	if($this->form_validation->run()){

		        $data=array(
		            'appointment_book_user_id'=>$this->session->userdata('user_id'),
		            'appointment_doctor_id'=>$this->input->post('appointment_doctor_id'),
		            'appointment_patient_id'=>$this->input->post('appointment_patient_id'),
		            'appointment_date_time'=>date('Y-m-d H:i:s', strtotime($this->input->post('appointment_date_time').' '.$this->input->post('appointment_time'))),
		            'appointment_description'=>$this->input->post('appointment_description'),
		            //'appointment_treatment'=>$this->input->post('appointment_treatment'),

		            'appointment_remark'=>$this->input->post('appointment_remark'),
		            'appointment_status'=>$this->input->post('appointment_status'),
		            'appointment_location_id'=>$this->session->userdata('location_id'),

		        );
		        $this->admin->record_insert('tbl_patient_appointment',$data);

				$this->session->set_flashdata('success_message',"Your appointment has been created successfully");

				//redirect($_SERVER['HTTP_REFERER']);
				redirect(base_url().'patient/all_appointment');
        	}

		}

        $where=array(
    				);
        $this->data['project_location'] = $this->admin->record_list('tbl_project_location',$where);

        $where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);

        $where=array(
		            	'user_employee_type'=>'3',
    				);
        $this->data['patient_list'] = $this->admin->record_list('tbl_user',$where);

		$where=array(
        			'ttm_user_id'=>'0',
        			//'ttm_user_id'=>$this->data['patient_info']->appointment_patient_id,
    				);
        $this->data['treatment_record'] = $this->admin->record_list('tbl_treatment',$where);
        
        
		$this->load->view('patient/add-appointment-patient',$this->data);
	}

	public function update_appointment_patient()
	{

		if (!$this->admin->check_user_access('update-appointment')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update Appointment";

		if (isset($_POST['btn_add_appintment'])) {
			
			$this->form_validation->set_rules('appointment_doctor_id','Doctor','required|xss_clean');
					
			$this->form_validation->set_rules('appointment_patient_id','Patient','required|xss_clean');

			$this->form_validation->set_rules('appointment_date_time','Email ID','required');
			
        	if($this->form_validation->run()){

		        $data=array(
		            'appointment_book_user_id'=>$this->session->userdata('user_id'),
		            'appointment_doctor_id'=>$this->input->post('appointment_doctor_id'),
		            'appointment_patient_id'=>$this->input->post('appointment_patient_id'),
		            'appointment_date_time'=>date('Y-m-d H:i:s', strtotime($this->input->post('appointment_date_time').' '.$this->input->post('appointment_time'))),
		            'appointment_description'=>$this->input->post('appointment_description'),
		            //'appointment_treatment'=>$this->input->post('appointment_treatment'),
		            'appointment_remark'=>$this->input->post('appointment_remark'),
		            'appointment_status'=>$this->input->post('appointment_status'),
		            'appointment_location_id'=>$this->session->userdata('location_id'),
		        );
	 			$where=array(
	        		'appointment_id'=>$this->input->post('appointment_id'),
		        );

		        $this->admin->records_update('tbl_patient_appointment',$data,$where);

		        /*echo $this->db->last_query();
		        exit;*/
				$this->session->set_flashdata('success_message',"Appointment information has been Updated successfully");

				//redirect($_SERVER['HTTP_REFERER']);

				redirect(base_url().'patient/all_appointment');
				//redirect(base_url().'patient/patient_history/'.$this->input->post('appointment_patient_id'));
        	}

		}

        $where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);


        $where=array(
        			'appointment_id'=>$this->uri->segment('3')
    				);
     	$patient_info= $this->admin->record_list('tbl_patient_appointment',$where);
		
		$this->data['patient_info']=$patient_info[0];
		
		if (!$this->data['patient_info']) {
			redirect(base_url('patient'));
		}

        $where=array(
		            	'user_employee_type'=>'3',
    				);
        $this->data['patient_list'] = $this->admin->record_list('tbl_user',$where);
		
		$where=array(
        			//'tbl_user.user_id !='=>'1',
        			'ttm_user_id'=>$this->data['patient_info']->appointment_patient_id,
        			//'ttm_id'=>$this->data['patient_info']->appointment_treatment,
    				);
        $this->data['treatment_record'] = $this->admin->record_list('tbl_treatment',$where);
		
        $where=array(
    				);
        $this->data['detal_treat_record'] = $this->admin->record_list('tbl_detal_numbering',$where);
        
		$this->load->view('patient/add-appointment-patient',$this->data);
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

	public function add_patient()
	{

		if (!$this->admin->check_user_access('add-patient')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Patient";

		if (isset($_POST['btn_add_user'])) {
			// echo "<pre>";
			// print_r($_POST);
			// exit;

			
			$this->form_validation->set_rules('user_first_name','First name','required|xss_clean');
			
			$this->form_validation->set_rules('user_phone_number','contact number','required|numeric|min_length[10]|max_length[12]|is_unique[tbl_user.user_phone_number]');

			//$this->form_validation->set_rules('user_employee_type','employee post','required');
					
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
		            'user_employee_type'=>'3',
		            'project_location_id'=>$this->session->userdata('location_id'),

		            'user_address'=>$this->input->post('user_address'),
		            'user_birth_date'=>$this->input->post('user_birth_date'),
		            'user_blood_group'=>$this->input->post('user_blood_group'),

		        );
		        $this->admin->record_insert('tbl_user',$data);

				$this->session->set_flashdata('success_message',"Your account has been created successfully");

				redirect(base_url().'patient');
        	}

		}

        $where=array(
    				);
        $this->data['project_location'] = $this->admin->record_list('tbl_project_location',$where);

        $where=array(
    				);
        $this->data['blood_group_name_list'] = $this->admin->record_list('tbl_blood_group',$where);

		$this->load->view('patient/user-update',$this->data);
	}

	public function update_patient()
	{

		if (!$this->admin->check_user_access('update-patient')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update Patient";

		if (isset($_POST['btn_add_user'])) {
			
			
			$this->form_validation->set_rules('user_first_name','First name','required|xss_clean');
			
			//$this->form_validation->set_rules('user_phone_number','contact number','required|numeric|min_length[10]|max_length[12]|is_unique[tbl_user.user_phone_number]');

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
		            'user_employee_type'=>'3',
		            'project_location_id'=>$this->session->userdata('location_id'),

		            'user_address'=>$this->input->post('user_address'),
		            'user_birth_date'=>$this->input->post('user_birth_date'),
		            'user_blood_group'=>$this->input->post('user_blood_group'),
		        );

		        if($this->input->post('user_password')!=""){
		            $data['user_password']=md5($this->input->post('user_password'));
		        }

	 			$where=array(
	        		'user_id'=>$this->input->post('user_id'),
		        );

		        $this->admin->records_update('tbl_user',$data,$where);

				$this->session->set_flashdata('success_message',"Employee information has been Updated successfully");

				redirect(base_url().'patient');
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
		$this->db->where_in('emp_type_id', $report_to);

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

        $where=array(
    				);
        $this->data['blood_group_name_list'] = $this->admin->record_list('tbl_blood_group',$where);

		$this->load->view('patient/user-update',$this->data);
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


	public function prescription()
	{

		if (!$this->admin->check_user_access('prescription-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			//'tbl_user.user_id !='=>'1',
        			//'tbl_user.project_location_id'=>$this->session->userdata('location_id'),
    				);
        if($this->session->userdata('emp_type_id')==2){
			$where['pre_doctor_id']=$this->session->userdata('user_id');
        }
        $this->db->order_by('tbl_prescription.pre_id','DESC');
        $this->db->join('tbl_user','tbl_user.user_id=tbl_prescription.pre_patient_id');
        $this->db->join('tbl_user doctor','doctor.user_id=tbl_prescription.pre_doctor_id');
        $this->db->select('tbl_prescription.*,tbl_user.user_phone_number,tbl_user.user_first_name,tbl_user.user_last_name,doctor.user_first_name doctor_first_name,doctor.user_last_name doctor_last_name');
        $this->data['pre_record'] = $this->admin->record_list('tbl_prescription',$where);
        
		$this->data['page_title'] = "Prescription";

		$this->load->view('patient/prescription-list',$this->data);

	}

	public function add_prescription()
	{

		if (!$this->admin->check_user_access('add-prescription')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Prescription";

		if (isset($_POST['btn_add_prescription'])) {
			
			$this->form_validation->set_rules('pre_patient_id','Patient','required|xss_clean');
					
			//$this->form_validation->set_rules('appointment_doctor_id','Doctor','required|xss_clean');
					
			//$this->form_validation->set_rules('appointment_date_time','Email ID','required');
			
			
        	if($this->form_validation->run()){

        		/*echo "<pre>";
        		print_r($_POST);
        		exit;*/

		        $data=array(
		            'pre_doctor_id'=>$this->session->userdata('user_id'),
		            'pre_patient_id'=>$this->input->post('pre_patient_id'),
		            'pre_details'=>json_encode($this->input->post('pre_details')),
		            'pre_details_in_detail'=>json_encode($_POST),
		            'pre_lab_test'=>json_encode($this->input->post('pre_lab_test')),
		            'pre_advice'=>$this->input->post('pre_advice'),
		            'pre_created_on'=>date('Y-m-d H:i:s'),
		            'pre_location_id'=>$this->session->userdata('location_id'),

		        );
		        $this->admin->record_insert('tbl_prescription',$data);

				$this->session->set_flashdata('success_message',"Your appointment has been created successfully");

				//redirect($_SERVER['HTTP_REFERER']);
				redirect(base_url().'patient/prescription');
        	}

		}

        $where=array(
    				);
        $this->data['project_location'] = $this->admin->record_list('tbl_project_location',$where);

        /*
        $where=array(
		            	'user_employee_type'=>'2',
    				);
        $this->data['doctor_list'] = $this->admin->record_list('tbl_user',$where);
        */

        $where=array(
		            	'user_employee_type'=>'3',
    				);
        $this->data['patient_list'] = $this->admin->record_list('tbl_user',$where);

        $where=array(
		            	//'user_employee_type'=>'3',
    				);
        $this->data['medicine_list'] = $this->admin->record_list('tbl_medicine',$where);

        $where=array(
		            	//'user_employee_type'=>'3',
    				);
        $this->data['lab_test_list'] = $this->admin->record_list('tbl_lab_test',$where);

		$this->load->view('patient/add-prescription',$this->data);
	}


	public function show_prescription()
	{

		if (!$this->admin->check_user_access('prescription-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			'pre_id'=>$this->uri->segment('3'),
    				);
        $this->db->order_by('tbl_prescription.pre_id','DESC');
        $this->db->join('tbl_user','tbl_user.user_id=tbl_prescription.pre_patient_id');
        $this->db->join('tbl_user doctor','doctor.user_id=tbl_prescription.pre_doctor_id');
        $this->db->select('tbl_prescription.*,tbl_user.user_phone_number,tbl_user.user_first_name,tbl_user.user_last_name,doctor.user_first_name doctor_first_name,doctor.user_last_name doctor_last_name');
        $this->data['pre_record'] = $this->admin->record_list('tbl_prescription',$where);
        
        if (isset($this->data['pre_record'][0])) {
        	
        }else{
				redirect(base_url().'patient/prescription');
        }
        
		$this->data['page_title'] = "Prescription";

		$this->load->view('patient/invoice',$this->data);

	}


	public function mark_disabled()
	{

        $data=array(
            'pre_status'=>"0",
        );
		$where=array(
    		'pre_id'=>$this->uri->segment('3'),
        );

        $this->admin->records_update('tbl_prescription',$data,$where);

		$this->session->set_flashdata('success_message',"Prescription status updated successfully");

		redirect(base_url().'patient/prescription');

	}

	public function mark_enabled()
	{

        $data=array(
            'pre_status'=>"1",
        );
		$where=array(
    		'pre_id'=>$this->uri->segment('3'),
        );

        $this->admin->records_update('tbl_prescription',$data,$where);

		$this->session->set_flashdata('success_message',"Prescription status updated successfully");

		redirect(base_url().'patient/prescription');

	}
}
