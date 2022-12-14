<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_Management extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('GoogleAuthenticator');
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$data['all_category'] = $this->am->getAllCategory();
			$this->load->view('admin/user_category/vw_categorylist', $data);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function onCreateCategoryView()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{

			$this->data['page_title'] = 'User Category';
			$this->load->view('admin/user_category/vw_create_category', $this->data, false);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function onCheckDuplicateCategory()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{

				$category_name = xss_clean($this->input->post('category_name'));

				$category_exists = $this->am->getCategoryData(array('category_name' => $category_name), FALSE);
				if ($category_exists) 
				{

					$return['user_exists'] = 1;
					$return['out_message'] = $category_name . " already exists!!";

				} 
				else 
				{
					$return['user_exists'] = 0;
					$return['out_message'] = $category_name . " available";
				}

				header('Content-Type: application/json');

				echo json_encode($return);
			} 
			else 
			{
				//exit('No direct script access allowed');
				redirect(base_admin_url());
			}
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function onCreateCategory()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean|htmlentities');

			if ($this->form_validation->run() == FALSE) 
			{
				$this->form_validation->set_error_delimiters('', '');
				$return['errors'] = validation_errors();
				$return['category_added'] = 'rule_error';
			} 
			else 
			{
				$category_name 	= xss_clean($this->input->post('category_name'));

				$ins_Catdata = array(
										'category_name'  	=> $category_name,
										'created_date'  	=> date('Y-m-d H:i:s') 
									);

				$addCategory = $this->am->addCategory($ins_Catdata);

				if ($addCategory) 
				{
					$return['user_added'] = 'success';
				}	
				else 
				{
					$return['user_added'] = 'failure';
				}

				redirect(base_admin_url('user-category-management'));		
			}	
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function onGetCategory()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$cat_id = decode_url(xss_clean($this->uri->segment(3)));

			$this->data['page_title'] = 'Edit User Category';

			$chkdata 	= array('id'  => $cat_id);

			$userdata 	= $this->am->getCategoryData($chkdata, $many = FALSE);

			if ($userdata) {
				$this->data['user_data'] = array(
													'id'  				=> $userdata->id,
													'category_name'  	=> $userdata->category_name,
													'status'  			=> $userdata->status,
													'created_date'  	=> $userdata->created_date
												);
				$this->load->view('admin/user_category/vw_edit_category', $this->data, false);
			} 
			else 
			{
				redirect(base_admin_url());
			}
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function updateCategory()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$cat_id 		= trim($this->input->post('cat_id'));
			$page_title 	= trim($this->input->post('page_title'));
			$category_name 	= trim($this->input->post('category_name'));

			$chkdata 		= array('id'  => $cat_id);
			$upd_userdata 	= array('category_name'  => $category_name);

			$upduser = $this->am->updateCategory($upd_userdata, $chkdata);

			if($upduser)
			{
				$this->data['update_success'] = 'Successfully Updated.';
			}
			else	
			{
				$this->data['update_failure'] = 'Not Updated!';
			}	

			redirect(base_admin_url('user-category-management'));
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function deleteCategory()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{
				$cat_id 	= decode_url(xss_clean($this->input->post('cat_id')));
				$userdata 	= $this->am->getCategoryData(array('id'  => $cat_id), FALSE);

				if (!empty($userdata)) 
				{
					$deluser = $this->am->deleteCategory(array('id' => $cat_id));

					if ($deluser) 
					{
						$return['deleted'] = 'success';
					} 
					else 
					{
						$return['deleted'] = 'failure';
					}
				} 
				else 
				{
					$return['deleted'] = 'not_exists';
				}

				header('Content-Type: application/json');
				echo json_encode($return);
			} 
			else 
			{
				redirect(base_admin_url());
			}
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function updateCategoryStatusAjax()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{
				$category_id 		= trim($this->input->post('category_id'));
				$status 			= trim($this->input->post('status'));

				$chkdata 		= array('id'  => $category_id);
				$upd_userdata 	= array('status'  => $status);

				$upduser = $this->am->updateCategory($upd_userdata, $chkdata);

				if($upduser)
				{
					$return = 'Successfully Updated';
				}
				else	
				{
					$return = 'Not Updated!';
				}

				header('Content-Type: application/json');
				echo json_encode($return);
			} 
			else 
			{
				redirect(base_admin_url());
			}
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}
}
