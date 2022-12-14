<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CMS_Management extends CI_Controller
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
			$data['all_cms'] = $this->am->getAllCms();
			$this->load->view('admin/cms/vw_cms', $data);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function edit_cms($id)
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{	
			$this->data['cms_details'] 	= $this->am->getAllCms(array('id' => base64_decode($id)), FALSE);
			$this->data['page_title'] 	= 'Edit CMS';
			$this->load->view('admin/cms/vw_edit_cms', $this->data, false);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function update_cms()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$cms_id 		= trim($this->input->post('cms_id'));
			$module_name 	= trim($this->input->post('module_name'));
			$content 	= trim($this->input->post('content'));

			$chkdata 		= array('id'  => $cms_id);
			$upd_userdata 	= array('content'  => $content);

			$upduser = $this->am->updateCms($upd_userdata, $chkdata);

			if($upduser)
			{
				$this->session->set_flashdata('success','CMS Updated Successfully..');
			}
			else	
			{
				$this->session->set_flashdata('failed','CMS Not Updated Successfully..');
			}	

			redirect(base_admin_url('cms'));
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
