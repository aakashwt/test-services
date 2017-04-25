<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
/**
 * This Class used as admin management
 * @package   CodeIgniter
 * @category  Controller
 * @author    Sorav Garg
 */

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->uid = $this->session->userdata("id");
		$this->session_model->checkAdminSession();
	}

	/**
	 * Function Name: dashboard
	 * Description:   To admin dashboard
	 */
	public function dashboard()
	{
		$data['parent'] = "dashboard";
		$this->template->load('default', 'dashboard',$data);
	}

	/**
	 * Function Name: changepassword
	 * Description:   To change admin password view
	 */
	public function changepassword()
	{
		$data['parent'] = "password";
		$this->template->load('default', 'changepassword',$data);
	}

	/**
	 * Function Name: categories
	 * Description:   To view all the categories
	 */
	public function categories()
	{
		if($this->input->post('submit'))
		{
			$data_arr = array();
			$data_arr['name'] = $this->input->post('name');
			$file_upload = corefileUploading('image','categories');
			if(!empty($file_upload)){
				$data_arr['image'] = $file_upload;
				$lid = $this->Common_model->insertData('categories',$data_arr);
				if($lid){
					$this->session->set_flashdata('success','Category added successfully');
					redirect('admin/categories');
				}else{
					$this->session->set_flashdata('error',GENERAL_ERROR);
					redirect('admin/categories');
				}
			}else{
				$this->session->set_flashdata('error','Image uploading failed');
				redirect('admin/categories');
			}
		}
		$data['parent'] = "categories";
		$data['categories'] = $this->Common_model->getAll('categories','name','ASC');
		$this->template->load('default', 'categories',$data);
	}


	/**
	 * Function Name: logout
	 * Description:   To admin logout
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		delete_cookie("siteadmin");
		redirect("siteadmin");
	}
	
	/**
	 * Function Name: dochangepassword
	 * Description:   To change admin password
	 */
	public function dochangepassword()
	{
		if($this->input->is_ajax_request())
		{
			$old_pswd     = md5(base64_decode($this->input->post('old_pswd')));
			$new_pswd     = base64_decode($this->input->post('new_pswd'));
			$confirm_pswd = base64_decode($this->input->post('confirm_pswd'));
			$results = $this->Common_model->getsingle(ADMIN,array('password' => $old_pswd));
			if(empty($results))
			{
				echo json_encode(array('type' => 'failed','msg' => 'Invalid Current Password'));exit;
			}
			if(!empty($new_pswd) && !empty($confirm_pswd)){
				if($new_pswd != $confirm_pswd){
					echo json_encode(array('type' => 'failed','msg' => 'Password not matched !'));exit;
				}else{
					$pswdArr = array('password' => md5($new_pswd));
					$where   = array('id' => $this->uid);
					if($this->Common_model->updateFields(ADMIN,$pswdArr,$where)){
						echo json_encode(array('type' => 'success','msg' => 'Password successfully changed !'));exit;
					}else{
						echo json_encode(array('type' => 'failed','msg' => NO_CHANGES));exit;
					}
				}
			}else{
				echo json_encode(array('type' => 'failed','msg' => GENERAL_ERROR));
			}
		}
	}

	public function delete_category()
	{
		if($this->input->get('id'))
		{
			$status = $this->Common_model->deleteData('categories',array('id' => $this->input->get('id')));
			if($status){
				$this->session->set_flashdata('success','Category deleted successfully');
				redirect('admin/categories');
			}else{
				$this->session->set_flashdata('error',GENERAL_ERROR);
				redirect('admin/categories');
			}
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
