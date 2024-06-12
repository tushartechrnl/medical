<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model {
	
	public function record_insert($tbl_name,$data_array)
	{
		$insert_id=$this->db->insert($tbl_name,$data_array);
		
		if($insert_id)
		{
			return $insert_id;
		}
		return false;
	}	

	public function check_user_access($check_this)
	{
		/*echo "<pre>";
		print_r(json_decode($this->session->userdata('emp_type_access')));
		die;*/
		$user_access=json_decode($this->session->userdata('emp_type_access'));
		
		if (@in_array($check_this, $user_access)) {
			return true;
		}


		return false;

	}


	public function login_check()
	{

		if(isset($_SESSION['success_message'])){
		    unset($_SESSION['success_message']);
		}		

		if($this->session->userdata('user_verification')!=1){

			$this->session->sess_destroy();	
			redirect(base_url().'login');
			
		}

		if (!$this->session->userdata('user_id') || !$this->session->userdata('emp_type_id')) {


			$this->session->sess_destroy();	
			redirect(base_url().'login');

		}


        $where=array(
        			'user_id'=>$this->session->userdata('user_id'),
	        		'user_status'=>'1',
    				);
        $this->db->select('tbl_user.*,tbl_employee_type.emp_type_name,tbl_employee_type.emp_type_id,tbl_employee_type.emp_type_access,tbl_project_location.*');
        $this->db->join('tbl_employee_type','tbl_employee_type.emp_type_id=tbl_user.user_employee_type');
        $this->db->join('tbl_project_location','tbl_project_location.location_id=tbl_user.project_location_id','Left');
        $user_record = $this->admin->record_list('tbl_user',$where);
	 	
	 	if ($user_record) {
		        	
			$this->session->set_userdata('emp_type_access',$user_record[0]->emp_type_access);
			$this->session->set_userdata('location_id',$user_record[0]->location_id);
			$this->session->set_userdata('location_name',$user_record[0]->location_name);
		}else{
			
			$this->session->sess_destroy();	
			$this->session->set_flashdata('failed_message',"Your account has been disabled, Please contact your system administrator");
			redirect(base_url().'login');
		}

	}	

	
	public function send_message($mob,$msg,$templateid)
	{

		/*Tirupati code*/
		$rndno=rand(111111, 999999);
        		
		$mobile='919657267261';
		$curl = curl_init();

		curl_setopt_array($curl, [
		  CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
        		  CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"625413d897f39547ff2e3e84\",\n  \"sender\": \"TRTRVL\",\n  \"mobiles\": \"".$mobile."\",\n  \"otp\": \"".$rndno."\" }",
		  CURLOPT_HTTPHEADER => [
		    "authkey: 186319AETWcdPo5a213238",
		    "content-type: application/JSON"
		  ],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}

		exit;
		/*end tirupati code*/

        $urlTri="http://newsms.ashtechnologies.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=17d4185161114f47b93f84ab2a584c17&message=".urlencode(str_replace("&#39;","'",$msg))."&senderId=RMPASS&routeId=1&mobileNos=".$mob."&smsContentType=english".
            "&entityid=1001773228513568979&tmid=1005714394314730783&templateid=".$templateid;
            //tmid=1478523690
          $url = $urlTri;
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$contents = curl_exec($ch);
		if (curl_errno($ch)) {
		  echo curl_error($ch);
		  echo "\n<br />";
		  $contents = '';
		} else {
		  curl_close($ch);
		}

	}	
	
	

	public function record_count($tbl_name,$where1=null)
	{
		
		if($where1!=null)
		{
			$this->db->where($where1);
		}
		
		$count=$this->db->get($tbl_name)->num_rows();
		
		if($count)
		{
			return $count;
		} 
		return false;	
		
	}


	public function add_image($image_name,$where="")
	{
		
		//echo $_FILES['banner_image1']['name'];
		$filename1 		= $_FILES[$image_name]['name'];				
		$filename1 		= explode(".", $filename1);							
		$icon_image 	= $image_name."_".date('Ymd').time().mt_rand(1, 999999)."." .end($filename1);
		$icon_image = str_replace (" ", "", $icon_image);
		$thumb1 = explode(".", $icon_image);
		$thumb1 = $thumb1[0] . "_thumb". "." .end($thumb1);
		//ho $thumb2;
		$_FILES['imag']['name'] 		= $icon_image;
		$_FILES['imag']['type'] 		= $_FILES[$image_name]['type'];
		$_FILES['imag']['tmp_name']    = $_FILES[$image_name]['tmp_name'];
		$_FILES['imag']['error'] = $_FILES [$image_name]['error'];
		$_FILES['imag']['size']  = $_FILES [$image_name]['size'];

		$config = array();
		$config['upload_path'] = './uploads/'.$where;
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';			    
		$config['overwrite']     = FALSE;


		if (!is_dir('uploads/'.$where)) {

			mkdir('./uploads/' . $where, 0755, true);
			//mkdir('./uploads/' . $where, 0777, TRUE);
			//$phone_number=$where;
			
		}


		$this->upload->initialize($config);

		if($this->upload->do_upload ('imag')){
	
			$imagedata1 = $this -> upload -> data();
			$newimagename1 = $imagedata1["file_name"];
	
			/*$this -> load -> library("image_lib");
			$config['image_library'] = 'gd2';
			$config['source_image'] = $imagedata1["full_path"];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['new_image'] = './assets/uploads/'.$where.'100X100';
			$config['width']  = 351;
			$config['height'] = 226;
			$this -> image_lib -> initialize($config);
			$this -> image_lib -> resize();*/
		}			
		$icon_image='uploads/'.$where.$icon_image;			
			
		return $icon_image;
	}

	public function add_multiple_image($image_name,$where,$key)
	{

		$filename1 		= $_FILES[$image_name]['name'][$key];				
		$filename1 		= explode(".", $filename1);							
		$icon_image 	= $image_name."_".date('Ymd').time().mt_rand(1, 999999)."." .end($filename1);
		$icon_image = str_replace (" ", "", $icon_image);
		$thumb1 = explode(".", $icon_image);
		$thumb1 = $thumb1[0] . "." .end($thumb1);
		//ho $thumb2;
		$_FILES['imag']['name'] 		= $icon_image;
		$_FILES['imag']['type'] 		= $_FILES[$image_name]['type'][$key];
		$_FILES['imag']['tmp_name']    = $_FILES[$image_name]['tmp_name'][$key];
		$_FILES['imag']['error'] = $_FILES [$image_name]['error'][$key];
		$_FILES['imag']['size']  = $_FILES [$image_name]['size'][$key];

		$config = array();
		$config['upload_path'] = './uploads/'.$where;
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';			    
		$config['overwrite']     = FALSE;

		$this->upload->initialize($config);

		if($this->upload->do_upload ('imag')){
	
			$imagedata1 = $this -> upload -> data();
			$newimagename1 = $imagedata1["file_name"];
	
			/*$this -> load -> library("image_lib");
			$config['image_library'] = 'gd2';
			$config['source_image'] = $imagedata1["full_path"];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['new_image'] = './assets/uploads/'.$where.'100X100';
			$config['width']  = 351;
			$config['height'] = 226;
			$this -> image_lib -> initialize($config);
			$this -> image_lib -> resize();*/
		}			
		$icon_image='uploads/'.$where.$icon_image;			
			
		return $icon_image;
	}

	public function add_file($image_name,$where)
	{
		
		//echo $_FILES['banner_image1']['name'];
		$filename1 		= $_FILES[$image_name]['name'];				
		$filename1 		= explode(".", $filename1);							
		$icon_image 	= $image_name."_".date('Ymd').time().mt_rand(1, 999999)."." .end($filename1);
		$icon_image = str_replace (" ", "", $icon_image);
		
		$thumb1 = $icon_image;
		//ho $thumb2;
		$_FILES['imag']['name'] 		= $icon_image;
		$_FILES['imag']['type'] 		= $_FILES[$image_name]['type'];
		$_FILES['imag']['tmp_name']    = $_FILES[$image_name]['tmp_name'];
		$_FILES['imag']['error'] = $_FILES [$image_name]['error'];
		$_FILES['imag']['size']  = $_FILES [$image_name]['size'];

		$config = array();
		$config['upload_path'] = './uploads/'.$where;
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';			    
		$config['overwrite']     = FALSE;

		$this->upload->initialize($config);

		if($this->upload->do_upload('imag')){
	
			$imagedata1 = $this -> upload -> data();
			$newimagename1 = $imagedata1["file_name"];
	
			/*$this -> load -> library("image_lib");
			$config['image_library'] = 'gd2';
			$config['source_image'] = $imagedata1["full_path"];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['new_image'] = './assets/uploads/'.$where.'100X100';
			$config['width']  = 351;
			$config['height'] = 226;
			$this -> image_lib -> initialize($config);
			$this -> image_lib -> resize();*/
		}			
		$icon_image='uploads/'.$where.$icon_image;	

		/*$error = array('error' => $this->upload->display_errors());
		echo "<pre>";
		print_r($error);

		exit;*/
		/*echo "<pre>";
		print_r($_FILES[$image_name]['error']);

			echo "<script type=\"text/javascript\">window.open('http://localhost/rustomjee".$icon_image."', '_blank')</script>";
					
		exit;*/
			
		return $icon_image;
	}


	public function countdata($tbl_name)
	{		
	//	$this->db->where($where1);
		$count=$this->db->get($tbl_name)->num_rows();
		
		if($count)
		{
			return $count;
		} 
		return false;			
	}
        
	public function record_list($tbl_name,$where1=null)
	{
		//echo $tbl_name;
		//echo "<pre>";print_r($where1);die;
		//echo "hiii";die;
		if($where1!=null)
		{
			$this->db->where($where1);
		}
		
		$details=$this->db->get($tbl_name)->result();
		//echo "<pre>";print_r($details);die;
		if($details)
		{
			return $details;
		} 
		return false;			
	}

	public function record_count_list($tbl_name,$where1=null)
	{
		//echo $tbl_name;
		//echo "<pre>";print_r($where1);die;
		//echo "hiii";die;
		if($where1!=null)
		{
			$this->db->where($where1);
		}
		
		$details=$this->db->get($tbl_name)->result();
		//echo "<pre>";print_r($details);die;
		if($details)
		{
			return $details;
		} 
		return array();			
	}

	public function records_delete($tbl_name,$where1)
	{
		$this->db->where($where1);
		$details=$this->db->delete($tbl_name);
			
		if($details)
		{
			return $details;
		} 
		return false;			
	}
	
	public function records_delete_temp($tbl_name,$data,$where1)
	{
		$this->db->where($where1);
		$details=$this->db->update($tbl_name,$data);
			
		if($details)
		{
			return $details;
		} 
		return false;	
		
	}	

	public function records_update($tbl_name,$data,$where1)
	{
		$this->db->where($where1);
		$details=$this->db->update($tbl_name,$data);
			
		if($details)
		{
			return $details;
		} 
		return false;	
		
	}	


	public function generatethumb_backend($image_path='',$width='100',$height='100',$center='2')
	{

		//$data=json_decode(file_get_contents('php://input'), true);

		$image_path=$image_path;
		
		$width1 = 0;
		$height1 = 0; 

		/*$image_path='assets/uploads/project/banner_section/desktop_image_202007311596178003.jpg';
		
		$width=460;
		$height=435;*/

		/*echo "<pre>";*/
		 if (file_exists( $image_path ) ) {
		if ($image_path !="") {
			
		$data = getimagesize($image_path);
		$width1 = $data[0];
		$height1 = $data[1]; 


	    // Get the CodeIgniter super object
	    $CI =& get_instance();

	    $image_thumb="";
	    $search="/";
	    $pos = strrpos($image_path, $search);

	    if($pos != false)
	    {
	        $image_thumb = substr_replace($image_path, "/100X100/", $pos, strlen($search));
	    }

	    $search=".";
	    $pos = strrpos($image_thumb, $search);

	    if($pos != false)
	    {
	        $image_thumb = substr_replace($image_thumb, "_".$width."_".$height.".", $pos, strlen($search));
	    }
	    

//echo $image_thumb;
	    // Path to image thumbnail
	    //$image_thumb = dirname( $image_path ) . '/100X100/' .$path. '.jpg';

	    if ( !file_exists( $image_thumb ) ) {
	        // LOAD LIBRARY
	        $CI->load->library( 'image_lib' );

	        // CONFIGURE IMAGE LIBRARY


	        $config['image_library']    = 'gd2';
	        $config['source_image']     = $image_path;
	        $config['new_image']        = $image_thumb;
	        $config['maintain_ratio']   = true;

	        $config['width']            = $width;
	        $config['height']           = $height;
			
			

			//$config['x_axis'] =  ($width1/2) - ($width/2);
            //$config['y_axis'] =($height1/2) - ($height/2);

			//print_r($data[0]); 
			//print_r($data[1]); 


			//echo "<br>".$width1."_".$height1."<br>";
	                 	
	        $CI->image_lib->initialize( $config );
	        $CI->image_lib->resize();
			//$CI->image_lib->crop();
	       // $CI->image_lib->clear();
			
			//print_r($config);

	        
	    }

	    return $image_thumb;

		}
		}
		return "";		
	}


	public function send_email_smtp($send_to="aher91@gmail.com",$subject="Hello",$message="somebody try on mail")
	{

        $this->load->library('email');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'smtp-relay.sendinblue.com';
        $config['smtp_port']    = '587';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'philsengg.erp@gmail.com';
        $config['smtp_pass']    = 'WOpnL2F8BqxGtKDU';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from('philsengg.erp@gmail.com', 'Phils Engg');
        $this->email->to($send_to); 

        $this->email->subject($subject);
        $this->email->message($message);  

        $this->email->send();

        echo $this->email->print_debugger();

	}


	public function send_onesignal_message($users,$quiz_message)
	{
			
	    $content = array(
	        "en" => $quiz_message
	        );

	    $fields = array(
	        'app_id' => "19014ed5-455e-422d-a4f9-3206946ab9cc",
	        'included_segments' => array('All'),
	        'data' => array("foo" => "bar"),
	        'large_icon' =>"ic_launcher_round.png",
	        'contents' => $content,
		   	'include_player_ids' => $users,
	    );

	    $fields = json_encode($fields);
		/*print("\nJSON sent:\n");
		print($fields);*/

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
	                                               'Authorization: Basic Mjc5OGI0M2YtZGNlZS00ZTA4LTliMWMtNTU3NTBmYzVlNDAw'));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, FALSE);
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

	    $response = curl_exec($ch);
	    curl_close($ch);
	    return $ch;
	}

	function send_push_notification($senderids,$title,$description,$imgurl = null){
	    $serverkey = 'AAAA-ClYfnY:APA91bHsEwcPrc5n8Raf2XUJyT9t_q9o84-FXMM2AeGNYLfP8P8FhPDbLo35iOKaxwbSJtackqX8sK3rAlRvUUoYepUCWd1DqCZRTrW3bNxxuL5YbznR_7bDqNEoPRp52tUAGKkUCiwb';// this is a Firebase server key 
	    $data = array(
	                'registration_ids' => $senderids,
	                 'notification' => 
	                        array(
	                        'body' => $description,
	                        'title' => $title,
	                        "image"=> $imgurl),
	                        "data"=> array(
	                                "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
	                                "sound"=> "default", 
	                                 "status"=> "done"
	                                 )
	                        ); 
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,"https://fcm.googleapis.com/fcm/send");
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));  //Post Fields
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: key='.$serverkey));
	    $output = curl_exec ($ch);
	    curl_close ($ch);
	    //print_r($ch) ;
	}

}
