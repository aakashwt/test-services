<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This Class used as admin management
 * @package   CodeIgniter
 * @category  Controller
 * @author    Sorav Garg
 */

class Siteadmin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}

	/**
     * Function Name: index
     * Description:   To admin login view
     */
	public function index()
	{
		$user = $this->session->userdata("id");
		$cookie_data = $this->input->cookie('siteadmin',true);
		if(isset($cookie_data) && !empty($cookie_data)){
			$cookie_val = explode("_", decoding($cookie_data));
			if($cookie_val[0] == $this->session->userdata("email") && $cookie_val[1] == $this->session->userdata("id")){
				redirect("/admin/dashboard");
			}
		}
		if(!empty($user))
		{
			redirect("/admin/dashboard");
		}
		$this->load->view("admin/login");
	}

	/**
     * Function Name: login
     * Description:   To admin login
     */
	public function login()
	{	   
		if($this->input->is_ajax_request())
		{
			$data = $this->input->post();
			$u_data = array();
			$u_data["email"] = $data["email"];
			$u_data["password"] = md5($data["password"]);
			$user_data = $this->Common_model->getsingle(ADMIN,$u_data);
			if(!empty($user_data))
			{	
				$user_id = (int)$user_data->id;
				$last_login = datetime();
				$this->session->set_userdata("id",$user_id);
				$this->session->set_userdata("email",$user_data->email);
				$this->session->set_userdata("last_login",$user_data->last_login);
				$this->session->set_userdata("last_ip",$user_data->last_ip);
				$this->session->set_userdata('user_activity',time()); 
				$this->Common_model->updateFields(ADMIN,array('last_login'=>$last_login,'last_ip' => getRealIpAddr()),array('id'=>$user_data->id));
				if(isset($data['remember_me'])){
					$cookie= array(
					      'name'   => 'siteadmin',
					      'value'  => encoding($user_data->email."_".$user_id),
					      'expire' => '864000', // 10 days
					  );
				  	$this->input->set_cookie($cookie);
				}
				echo "success";exit;	
			}else
			{
				echo "error";exit;	
			}
		}
	}

}

/* End of file Siteadmin.php */
/* Location: ./application/controllers/Siteadmin.php */

?>