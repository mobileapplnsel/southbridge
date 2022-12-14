<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service_Management extends CI_Controller
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
			$data['all_services'] = $this->am->getAllService();
			$this->load->view('admin/service/list', $data);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function add_service()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{

			$this->data['page_title'] 	= 'Service';
			$this->data['all_category'] =  $this->am->getAllServiceCategoryForAddService();

			$this->load->view('admin/service/add', $this->data, false);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function create_service()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('service_name', 'Service Name', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('service_details', 'Service Details', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean|htmlentities');

			if ($this->form_validation->run() == FALSE) 
			{
				$this->form_validation->set_error_delimiters('', '');
				$return['errors'] = validation_errors();
				$return['category_added'] = 'rule_error';
			} 
			else 
			{
				$category_name 		= xss_clean($this->input->post('category_name'));
				$service_name 		= htmlspecialchars_decode(xss_clean($this->input->post('service_name')));
				$service_details 	= htmlspecialchars_decode(xss_clean($this->input->post('service_details')));
				$price 				= xss_clean($this->input->post('price'));

				$ins_Catdata = array(
										'category_id'  		=> $category_name,
										'service_name'  	=> $service_name,
										'service_details'  	=> $service_details,
										'price'  			=> $price,
										'created_by'  		=> $this->session->userdata('userid'),
										'created_date'  	=> date('Y-m-d H:i:s') 
									);

				$addCategory = $this->am->addService($ins_Catdata);

				if ($addCategory) 
				{
					$return['user_added'] = 'success';
				}	
				else 
				{
					$return['user_added'] = 'failure';
				}

				redirect(base_admin_url('service-category-management'));		
			}	
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function edit_service()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$service_id = decode_url(xss_clean($this->uri->segment(3)));

			$this->data['page_title'] = 'Edit Service';

			$chkdata 	= array('id'  => $service_id);

			$service_data 	= $this->am->getServiceData($chkdata, $many = FALSE);

			if ($service_data) 
			{
				$this->data['service_data'] = $service_data;
				$this->data['all_category'] =  $this->am->getAllServiceCategoryForAddService();
				$this->load->view('admin/service/edit', $this->data, false);
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

	public function update_service()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$this->form_validation->set_rules('service_id', 'Service ID', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('service_name', 'Service Name', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('service_details', 'Service Details', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean|htmlentities');

			if ($this->form_validation->run() == FALSE) 
			{
				$this->form_validation->set_error_delimiters('', '');
				$return['errors'] = validation_errors();
				$return['category_added'] = 'rule_error';
			} 
			else 
			{
				$service_id 		= xss_clean($this->input->post('service_id'));
				$category_name 		= xss_clean($this->input->post('category_name'));
				$service_name 		= htmlspecialchars_decode(xss_clean($this->input->post('service_name')));
				$service_details 	= htmlspecialchars_decode(xss_clean($this->input->post('service_details')));
				$price 				= xss_clean($this->input->post('price'));

				$chkdata 		= array('id'  => $service_id);
				$upd_userdata 	= array(
											'category_id'  		=> $category_name,
											'service_name'  	=> $service_name,
											'service_details'  	=> $service_details,
											'price'  			=> $price
										);

				$upduser = $this->am->updateService($upd_userdata, $chkdata);

				if($upduser)
				{
					$this->data['update_success'] = 'Successfully Updated.';
				}
				else	
				{
					$this->data['update_failure'] = 'Not Updated!';
				}	

				redirect(base_admin_url('service-list'));
			}	
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function deleteServiceCategory()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{
				$cat_id 	= decode_url(xss_clean($this->input->post('cat_id')));
				$userdata 	= $this->am->getServiceCategoryData(array('id'  => $cat_id), FALSE);

				if (!empty($userdata)) 
				{
					$deluser = $this->am->deleteServiceCategory(array('id' => $cat_id));

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

	public function updateServiceStatusAjax()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{
				$service_id 		= trim($this->input->post('service_id'));
				$status 			= trim($this->input->post('status'));

				$chkdata 		= array('id'  => $service_id);
				$upd_userdata 	= array('status'  => $status);

				$upduser = $this->am->updateService($upd_userdata, $chkdata);

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
