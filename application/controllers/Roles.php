<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->admin->login_check();		

	}   


	public function index()
	{

		if (!$this->admin->check_user_access('role-list')) {
			redirect(base_url().'dashboard');
		}

        $where=array(
        			'emp_type_id !='=>'1'
    				);
        $this->db->order_by('emp_type_id','DESC');
        $this->data['roles_record'] = $this->admin->record_list('tbl_employee_type',$where);
        
		$this->data['page_title'] = "Roles";

		$this->data['sub_sidebar'] = "Roles List";

		$this->load->view('roles/roles-list',$this->data);

	}

	public function add_roles()
	{
		if (!$this->admin->check_user_access('add-role')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Add Roles";

		if (isset($_POST['btn_add_stock_category'])) {
			
			$this->form_validation->set_rules('user_access[]','Access','xss_clean');
			
			$this->form_validation->set_rules('emp_type_name','Role Name','required|xss_clean');
			
        	if($this->form_validation->run()){

		        $data=array(
		            'emp_type_name'=>$this->input->post('emp_type_name'),
		            'emp_type_access'=>json_encode($this->input->post('user_access[]')),
		        );

		        $this->admin->record_insert('tbl_employee_type',$data);

				$this->session->set_flashdata('success_message',"Your role has been created successfully");

				redirect(base_url().'user');
        	}

		}

		$this->load->view('roles/roles-add',$this->data);
	}

	public function update_roles()
	{
		if (!$this->admin->check_user_access('update-role')) {
			redirect(base_url().'dashboard');
		}

		$this->data['page_title'] = "Update Roles";

		if (isset($_POST['btn_add_stock_category'])) {
			
			$this->form_validation->set_rules('user_access[]','Access','xss_clean');
			
			$this->form_validation->set_rules('emp_type_name','Role Name','required|xss_clean');
			
        	if($this->form_validation->run()){

		        $data=array(
		            'emp_type_name'=>$this->input->post('emp_type_name'),
		            'emp_type_access'=>json_encode($this->input->post('user_access[]')),
		        );

	 			$where=array(
	        		'emp_type_id'=>$this->input->post('emp_type_id'),
		        );

		        $this->admin->records_update('tbl_employee_type',$data,$where);

				$this->session->set_flashdata('success_message',"Role Updated successfully");

				redirect(base_url().'roles');
        	}

		}

        $where=array(
        			'emp_type_id'=>$this->uri->segment('3')
    				);
     	$role_info= $this->admin->record_list('tbl_employee_type',$where);
		
		$this->data['role_info']=$role_info[0];
		
		if (!$this->data['role_info']) {
			redirect(base_url('roles'));
		}

		$this->load->view('roles/roles-add',$this->data);
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
