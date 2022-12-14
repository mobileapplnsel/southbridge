<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subcription_Management extends CI_Controller
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
			$data['all_packages'] = $this->am->getPackageData();
			$this->load->view('admin/subcription/list', $data);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function add_package()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{

			$this->data['page_title'] 	= 'Package';

			$this->load->view('admin/subcription/add', $this->data, false);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function create_package()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$this->form_validation->set_rules('package_duration', 'Package Duration', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('package_name', 'Package Name', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('package_details', 'Package Details', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean|htmlentities');

			if ($this->form_validation->run() == FALSE) 
			{
				$this->form_validation->set_error_delimiters('', '');
				$return['errors'] = validation_errors();
				$return['category_added'] = 'rule_error';
			} 
			else 
			{
				$package_duration 	= xss_clean($this->input->post('package_duration'));
				$package_name 		= htmlspecialchars_decode(xss_clean($this->input->post('package_name')));
				$package_details 	= htmlspecialchars_decode(xss_clean($this->input->post('package_details')));
				$price 				= xss_clean($this->input->post('price'));

				$ins_Catdata = array(
										'package_duration'  => $package_duration,
										'package_name'  	=> $package_name,
										'package_details'  	=> $package_details,
										'price'  			=> $price,
										'created_by'  		=> $this->session->userdata('userid'),
										'created_date'  	=> date('Y-m-d H:i:s') 
									);

				$addCategory = $this->am->addPackage($ins_Catdata);

				if ($addCategory) 
				{
					$return['user_added'] = 'success';
				}	
				else 
				{
					$return['user_added'] = 'failure';
				}

				redirect(base_admin_url('package-list'));		
			}	
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function edit_package()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$package_id = decode_url(xss_clean($this->uri->segment(3)));

			$this->data['page_title'] = 'Edit Package';

			$chkdata 	= array('id'  => $package_id);

			$package_data 	= $this->am->getPackageData($chkdata, $many = FALSE);

			if ($package_data) 
			{
				$this->data['package_data'] = $package_data;
				$this->load->view('admin/subcription/edit', $this->data, false);
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

	public function update_package()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$this->form_validation->set_rules('package_id', 'Package ID', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('package_duration', 'Package Duration', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('package_name', 'Package Name', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('package_details', 'Package Details', 'trim|required|xss_clean|htmlentities');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean|htmlentities');

			if ($this->form_validation->run() == FALSE) 
			{
				$this->form_validation->set_error_delimiters('', '');
				$return['errors'] = validation_errors();
				$return['category_added'] = 'rule_error';
			} 
			else 
			{
				$package_id 		= xss_clean($this->input->post('package_id'));
				$package_duration 	= xss_clean($this->input->post('package_duration'));
				$package_name 		= htmlspecialchars_decode(xss_clean($this->input->post('package_name')));
				$package_details 	= htmlspecialchars_decode(xss_clean($this->input->post('package_details')));
				$price 				= xss_clean($this->input->post('price'));

				$chkdata 		= array('id'  => $package_id);
				$upd_userdata 	= array(
											'package_duration'  => $package_duration,
											'package_name'  	=> $package_name,
											'package_details'  	=> $package_details,
											'price'  			=> $price
										);

				$upduser = $this->am->updatePackage($upd_userdata, $chkdata);

				if($upduser)
				{
					$this->data['update_success'] = 'Successfully Updated.';
				}
				else	
				{
					$this->data['update_failure'] = 'Not Updated!';
				}	

				redirect(base_admin_url('package-list'));
			}	
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function updatePackageStatusAjax()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{
				$package_id 		= trim($this->input->post('package_id'));
				$status 			= trim($this->input->post('status'));

				$chkdata 		= array('id'  => $package_id);
				$upd_userdata 	= array('status'  => $status);

				$upduser = $this->am->updatePackage($upd_userdata, $chkdata);

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

	public function subcribed_users_list()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$data['all_subscription'] = $this->am->getSubscriptionData();
			$this->load->view('admin/subcription/subcribed_users_list', $data);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}
}
