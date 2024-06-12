<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->admin->login_check();		
		
	}   

	public function index()
	{

        $where=array(
        			'noti_user_id'=>$this->session->userdata('user_id')
    				);
        $this->db->order_by('noti_id','DESC');
        //$this->db->join('tbl_notification','tbl_stock_size.stock_size_id=tbl_stock.stock_size_id', 'left');
        //$this->db->select('tbl_stock.*,tbl_stock_type.stock_type_name');
        $this->data['noti_record'] = $this->admin->record_list('tbl_notification',$where);
        
		$this->data['page_title'] = "Notification";

		$this->data['sub_sidebar'] = "Notification List";

		$this->load->view('notification/notification-list',$this->data);

	}

	public function remove_notification()
	{
		$where = array(
			'noti_id'=>$this->uri->segment('3')
			);
		$this->admin->records_delete('tbl_notification',$where);

		$this->session->set_flashdata('success_message',"Notification removed successfully");

		redirect(base_url().'notification');
	}

	public function mark_notification()
	{
		$data = array(
    		'noti_status'=>1,
			);

		$where=array(
			'noti_id'=>$this->uri->segment('3')
        );

        $this->admin->records_update('tbl_notification',$data,$where);

		$this->session->set_flashdata('success_message',"Notification mark readed successfully");

		redirect(base_url().'notification');
	}



}
