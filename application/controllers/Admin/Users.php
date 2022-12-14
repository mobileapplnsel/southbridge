<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('GoogleAuthenticator');
	}

	public function index()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if($this->session->userdata('userid') != ''){
				$userdata = $this->am->getUserData(array('user_id !=' => 1, 'created_by' => $this->session->userdata('userid')), TRUE);	
			}else{
				$userdata = $this->am->getUserData(array('user_id !=' => 1), TRUE);
			}
			
			if ($userdata) {
				foreach ($userdata as $key => $value) {
					$this->data['user_data'][] = array(
						'dtime'  => $value->dtime,
						'userid'  => $value->user_id,
						'usergroup'  => $value->user_group,
						'username'  => $value->user_name,
						'company_name'  => $value->company_name,
						//'password'  => decrypt_it($value->pass),
						'fullname'  => $value->full_name,
						'email'  => $value->email,
						'phone'  => $value->phone,
						'pin_code'  => $value->pin_code,
						'iec_no'  => $value->iec_no,
						'gst_no'  => $value->gst_no,
						'pan_no'  => $value->pan_no,
						'user_category_id'  => $value->user_category_id
					);
				}

				//print_obj($this->data['user_data']);die;

			} else {
				$this->data['user_data'] = '';
			}
			$this->load->view('admin/users/vw_userlist', $this->data, false);
		} else {
			redirect(base_admin_url());
		}
	}

	public function onCheckDuplicateUser()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$email = xss_clean($this->input->post('user_name'));
				//email
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					//$out_message = $email . " is a valid email address";
					$if_email = 1; //email valid
				} else {
					$if_email = 0;
					$out_message = $email . " is not a valid email address!!";
				}

				if ($if_email) {
					$user_exists = $this->am->getUserData(array('user_name' => $email,'email' => $email), FALSE);
					if ($user_exists) {
						if ($email == $this->session->userdata('username')) {
							$return['user_exists'] = 3;
							$return['out_message'] = $email . "!! You can&apos;t use your current username!";
						} else {
							$return['user_exists'] = 1;
							$return['out_message'] = $email . " already exists!!";
						}
					} else {
						$return['user_exists'] = 0;
						$return['out_message'] = $email . " available";
					}
				} else {
					$return['user_exists'] = 1;
					$return['out_message'] = $out_message;
				}

				header('Content-Type: application/json');

				echo json_encode($return);
			} else {
				//exit('No direct script access allowed');
				redirect(base_admin_url());
			}
		} else {
			redirect(base_admin_url());
		}
	}

	public function onCheckDuplicatePhone()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$phone = xss_clean($this->input->post('phone'));

				if(preg_match('/^[0-9]{10}+$/', $phone)) 
				{
					$if_phone = 1;
				} 
				else 
				{
					$if_phone = 0;
					$out_message = $phone . " is not a valid phone number!!";
				}

				if ($if_phone) 
				{
					$user_exists = $this->am->getUserData(array('phone' => $phone), FALSE);
					if ($user_exists) 
					{
						if ($phone == $this->session->userdata('phone')) 
						{
							$return['user_exists'] = 3;
							$return['out_message'] = $phone . "!! You can&apos;t use your current phone number!";
						} 
						else 
						{
							$return['user_exists'] = 1;
							$return['out_message'] = $phone . " already exists!!";
						}
					} 
					else 
					{
						$return['user_exists'] = 0;
						$return['out_message'] = $phone . " available";
					}
				} 
				else 
				{
					$return['user_exists'] = 1;
					$return['out_message'] = $out_message;
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


	public function onGetUserProfile()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$user_id = decode_url(xss_clean($this->uri->segment(3)));

			$this->data['page_title'] = (isset($user_id) && $user_id != '') ? 'User' : 'Profile';
			$chkdata = array(
				'user_id'  => (isset($user_id) && $user_id != '') ? $user_id : $this->session->userdata('userid')
			);
			$userdata = $this->am->getUserData($chkdata, $many = FALSE);
			if ($userdata) {
				$this->data['user_data'] 			= $userdata;
				$this->data['all_countries'] 		= $this->am->get_all_countries($param = null, $many = TRUE);
				$this->data['all_user_category'] 	= $this->am->getCategoryData(array('status' => '1'), $many = TRUE);
				//print_obj($this->data['user_data']);die;
				$this->load->view('admin/users/vw_profile', $this->data, false);
			} else {
				redirect(base_admin_url());
			}
		} else {
			redirect(base_admin_url());
		}
	}

	public function onChangeUserProfile()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			/*echo "<pre>";
			print_r($_POST);die;*/

			$user_id 		= xss_clean($this->input->post('user_id'));
			$full_name 		= xss_clean($this->input->post('full_name'));
			$company_name 	= xss_clean($this->input->post('company_name'));
			$email 			= xss_clean($this->input->post('email'));
			$phone 			= xss_clean($this->input->post('phone'));
			$address 		= xss_clean($this->input->post('address'));
			$country 		= xss_clean($this->input->post('country'));
			$state 			= xss_clean($this->input->post('state'));
			$city 			= xss_clean($this->input->post('city'));
			$pin_code 		= xss_clean($this->input->post('pin_code'));
			$iec_no 		= xss_clean($this->input->post('iec_no'));
			$gst_no 		= xss_clean($this->input->post('gst_no'));
			$pan_no 		= xss_clean($this->input->post('pan_no'));
			$user_category 	= xss_clean($this->input->post('user_category'));
			$sub_category 	= xss_clean($this->input->post('sub_category'));

			$chkdata 		= array('user_id'  => $user_id);

			$upd_userdata 	= array(
										'user_category_id'  		=> $user_category,
										'user_sub_category_id'  	=> $sub_category,
										'full_name'  				=> $full_name,
										'user_name'  				=> $email,
										'company_name'  			=> $company_name,
										'email'  					=> $email,
										'phone'  					=> $phone,
										'address'  					=> $address,
										'country_id'  				=> $country,
										'state_id'  				=> $state,
										'city_id'  					=> $city,
										'pin_code'  				=> $pin_code,
										'iec_no'  					=> $iec_no,
										'gst_no'  					=> $gst_no,
										'pan_no'  					=> $pan_no,
										'last_updated'  			=> dtime,
										'updated_by'  				=> $this->session->userdata('userid')
									);
			

			//print_obj($upd_userdata);die;

			$userdata = $this->am->getUserData($chkdata, $many = FALSE);

			if ($userdata && $email != '') 
			{
				//update

				$upduser = $this->am->updateUser($upd_userdata, $chkdata);

				if ($upduser) 
				{
					$this->data['update_success'] = 'Successfully updated.';
					//list

					$usrdata = $this->am->getUserData($chkdata, $many = FALSE);
					$this->data['user_data'] 			= $userdata;
					$this->data['all_countries'] 		= $this->am->get_all_countries($param = null, $many = TRUE);
					$this->data['all_user_category'] 	= $this->am->getCategoryData(array('status' => '1'), $many = TRUE);
					$setdata = array('username'  => $usrdata->user_name);
					$this->session->set_userdata($setdata);
				} 
				else 
				{
					$this->data['update_failure'] = 'Not updated!';
				}

				$this->data['page_title'] = 'Edit User';

				//$this->load->view('admin/users/vw_profile', $this->data, false);
				redirect(base_admin_url('profile/').encode_url($user_id));
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

	public function onCreateUserView()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] 			= 'User';
			$this->data['all_countries'] 		= $this->am->get_all_countries($param = null, $many = TRUE);
			$this->data['all_user_category'] 	= $this->am->getCategoryData(array('status' => '1'), $many = TRUE);

			$this->load->view('admin/users/vw_createuser', $this->data, false);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function onCreateUser()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{
				$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|htmlentities');
				$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('iec_no', 'IEC No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('gst_no', 'GSTIN No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('pan_no', 'PAN No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('user_category', 'User Category', 'trim|required|xss_clean|htmlentities');

				if($this->input->post('user_category') == '3')
				{
					$this->form_validation->set_rules('sub_category', 'User Sub Category', 'trim|required|xss_clean|htmlentities');
				}	

				if ($this->form_validation->run() == FALSE) 
				{
					$this->form_validation->set_error_delimiters('', '');
					$return['errors'] = validation_errors();
					$return['user_added'] = 'rule_error';
				} 
				else 
				{
					$fullname 			= xss_clean(ucwords($this->input->post('full_name')));
					$company_name 		= xss_clean(ucwords($this->input->post('company_name')));
					$email 				= xss_clean($this->input->post('email'));
					$phone 				= xss_clean($this->input->post('phone'));
					$address 			= xss_clean($this->input->post('address'));
					$country 			= xss_clean($this->input->post('country'));
					$state 				= xss_clean($this->input->post('state'));
					$city 				= xss_clean($this->input->post('city'));
					$pin_code 			= xss_clean($this->input->post('pin_code'));
					$iec_no 			= xss_clean(strtoupper($this->input->post('iec_no')));
					$gst_no 			= xss_clean(strtoupper($this->input->post('gst_no')));
					$pan_no 			= xss_clean(strtoupper($this->input->post('pan_no')));
					$password 			= xss_clean($this->input->post('password'));
					$user_category 		= xss_clean($this->input->post('user_category'));

					if($user_category == '3')
					{
						$sub_category 		= xss_clean($this->input->post('sub_category'));
					}
					else 
					{
						$sub_category 		= NULL;
					}	

					$chkdata = array('user_name'  => $email);
					$userdata = $this->am->getUserData($chkdata, FALSE);

					if (!$userdata) 
					{
						//update

						$ins_userdata = array(
												'full_name'  			=> $fullname,
												'user_category_id'  	=> $user_category,
												'user_sub_category_id'  => $sub_category,
												'company_name'  		=> $company_name,
												'email'  				=> $email,
												'user_name'  			=> $email,
												'phone'  				=> $phone,
												'address'  				=> $address,
												'country_id'  			=> $country,
												'state_id'  			=> $state,
												'city_id'  				=> $city,
												'pin_code'  			=> $pin_code,
												'iec_no'  				=> $iec_no,
												'gst_no'  				=> $gst_no,
												'pan_no'  				=> $pan_no,
												'pass'  				=> md5($password),
												'dtime'  				=> dtime,
												'created_by'  			=> $this->session->userdata('userid')
											);
						//print_obj($ins_userdata);die;
						$adduser = $this->am->addUser($ins_userdata);

						if ($adduser) 
						{
							$return['user_added'] = 'success';
						} 
						else 
						{
							$return['user_added'] = 'failure';
						}
					} 
					else 
					{
						$return['user_added'] = 'already_exists';
					}
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

	public function onDeleteUser()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$user_id = decode_url(xss_clean($this->input->post('userid')));
				$userdata = $this->am->getUserData(array('user_id'  => $user_id), FALSE);

				if (!empty($userdata)) {
					//del

					$deluser = $this->am->delUser(array('user_id' => $user_id));

					if ($deluser) {
						$return['deleted'] = 'success';
					} else {
						$return['deleted'] = 'failure';
					}
				} else {
					$return['deleted'] = 'not_exists';
				}

				header('Content-Type: application/json');
				echo json_encode($return);
			} else {
				redirect(base_admin_url());
			}
		} else {
			redirect(base_admin_url());
		}
	}

	public function onGetTwoFACode()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Two-Factor Authentication';

			$chkdata = array(
				'user_id'  => $this->session->userdata('userid')
			);
			$userdata = $this->am->getUserData($chkdata, $many = FALSE);
			if (!empty($userdata)) {
				$this->data['user_data'] = array(
					'userid'  => $userdata->user_id,
					'user_group'  => $userdata->user_group,
					'username'  => $userdata->user_name,
					'twofa_enabled'  => $userdata->twofa_enabled
				);
				//print_obj($this->data['user_data']);die;

				if ($this->data['user_data']['twofa_enabled'] != 1) {
					$gaobj = new GoogleAuthenticator();
					$secretLength = 32;
					$name = 'BingeHQ';
					//secret key
					$this->data['gauth_secret'] = $gaobj->createSecret($secretLength);
					//qr url
					$this->data['qr_url'] = $gaobj->getQRCodeGoogleUrl($name, $this->data['gauth_secret']);
				} else {
					$this->data['gauth_secret'] = '';
					//qr url
					$this->data['qr_url'] = '';
				}



				$this->load->view('admin/users/vw_2facode', $this->data, false);
			} else {
				redirect(base_admin_url());
			}
		} else {
			redirect(base_admin_url());
		}
	}

	function onSet2FAuth()
	{

		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$this->form_validation->set_rules('tpasscode', 'Passcode', 'trim|required|numeric|xss_clean|htmlentities');
				$this->form_validation->set_rules('tqrcode', 'QR Code', 'trim|required|xss_clean|htmlentities');

				if ($this->form_validation->run() == FALSE) {
					$this->form_validation->set_error_delimiters('', '');
					$return['errors'] = validation_errors();
					$return['twofa'] = 'rule_error';
				} else {
					// 2 factor authentication codes....................................

					$gaobj = new GoogleAuthenticator();
					$secret = strip_tags($this->input->post('tqrcode'));
					$oneCode = strip_tags($this->input->post('tpasscode'));

					$token = $gaobj->getCode($secret);

					$checkResult = $gaobj->verifyCode($secret, $oneCode, 2); // 2 = 2*30sec clock tolerance

					if (!$checkResult) {
						$return['errors'] = 'Two-factor token Failed';
						$return['twofa'] = 'failure';
					} else {
						// Two-factor code success and now steps for username and password verification
						$param = array(
							'user_id'  => $this->session->userdata('userid')
						);

						$upData = array(
							'twofa_enabled'  => 1,
							'twofa_secret'  => $secret
						);

						$upDuser = $this->am->updateUser($upData, $param);
						if ($upDuser) {
							$return['twofa'] = 'success';
						} else {
							$return['errors'] = 'Two-factor Update Failed';
							$return['twofa'] = 'failure';
						}
					}
				}
				header('Content-Type: application/json');
				echo json_encode($return);
			} else {
				redirect(base_admin_url());
			}
		} else {
			redirect(base_admin_url());
		}
	}

	public function getStates()
	{
		$country 	= $this->input->post('selectedCountry');
		$param 		= array('country_id' =>	$country);

		$all_states = $this->am->get_all_states($param, $many = TRUE);
		
		if(!empty($all_states))
		{
			header('Content-Type: application/json');
			echo json_encode($all_states);
		}	
	}

	public function getCities()
	{
		$state 		= $this->input->post('state');
		$param 		= array('state_id' =>	$state);

		$all_cities = $this->am->get_all_cities($param, $many = TRUE);
		
		if(!empty($all_cities))
		{
			header('Content-Type: application/json');
			echo json_encode($all_cities);
		}	
	}

	public function edit_admin_profile()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$user_id 		= $this->session->userdata('userid');
			$user_group 	= $this->session->userdata('usergroup');

			$adminuserdata  = $this->am->getUserData(array('user_id' => $user_id , 'user_group' => '2'), FALSE);

			$data = [];
			$data['page_title'] = 'Admin Profile';

			if(!empty($adminuserdata))
			{
				$data['admin_data'] = $adminuserdata;
			}
			else
			{
				$data['admin_data'] = array();
			}	
	

			$this->load->view('admin/users/admin_user_edit', $data, false);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function update_admin_profile()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$user_id 		= xss_clean($this->input->post('user_id'));
			$full_name 		= xss_clean($this->input->post('full_name'));
			$company_name 	= xss_clean($this->input->post('company_name'));
			$email 			= xss_clean($this->input->post('email'));
			$phone 			= xss_clean($this->input->post('phone'));
			$address 		= xss_clean($this->input->post('address'));

			$chkdata 		= array('user_id'  => $user_id);

			$upd_userdata 	= array(
										'full_name'  				=> $full_name,
										'user_name'  				=> $email,
										'company_name'  			=> $company_name,
										'email'  					=> $email,
										'phone'  					=> $phone,
										'address'  					=> $address
									);

			$upduser = $this->am->updateUser($upd_userdata, $chkdata);

			redirect(base_admin_url('edit-admin-profile'));
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function change_admin_password()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$data['page_title'] = 'Change Password';
			$this->load->view('admin/users/admin_change_password', $data, false);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function verify_old_password()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$user_id 		= xss_clean($this->input->post('user_id'));
			$conf_pass 		= xss_clean($this->input->post('conf_pass'));

			$chkdata 		= array('user_id'  => $user_id);
			$upd_userdata 	= array('pass'  => md5($conf_pass));

			$upduser = $this->am->updateUser($upd_userdata, $chkdata);

			redirect(base_admin_url('change-password'));
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function update_admin_password()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{
				$user_id 	= xss_clean($this->input->post('user_id'));
				$conf_pass 	= xss_clean($this->input->post('conf_pass'));

				
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
