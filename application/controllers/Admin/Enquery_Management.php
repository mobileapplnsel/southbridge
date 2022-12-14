<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Enquery_Management extends CI_Controller
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
			$data['all_enquery'] = $this->am->getEnqueryData();
			$this->load->view('admin/enquery/list', $data);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function updateEnqueryStatusAjax()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{
				$enquery_id 		= trim($this->input->post('enquery_id'));
				$status 			= trim($this->input->post('status'));

				$chkdata 		= array('id'  => $enquery_id);
				$upd_userdata 	= array('status'  => $status);

				$upduser = $this->am->updateEnquery($upd_userdata, $chkdata);

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

	public function enquiry_details($encoded_id)
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			$enquery_id 	= base64_decode($encoded_id);
			$param  		= array('enquery_management.status' => '1','enquery_management.id' => $enquery_id);
	        $enquiryData   	= $this->am->get_enquiry($param,FALSE);

	        if(!empty($enquiryData))
	        {
	        	/*echo "<pre>";
	        	print_r($enquiryData);*/
                $paramsComment  =     array('enquiry_id' => $enquiryData['id']);
                $comments       =     $this->am->getComments($paramsComment,TRUE);

                if (!empty($comments)) 
                {
                    $enquiryData['comments'] = $comments;
                } 
                else 
                {
                    $enquiryData['comments'] = '';
                }
	              
	            $data['enquiry_data'] = $enquiryData;
	        }   
	        else
	        {
	        	$data = array();
	        }	

	        $this->load->view('admin/enquery/enquiry_details', $data);
		} 
		else 
		{
			redirect(base_admin_url());
		}
	}

	public function updateCommentStatusAjax()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) 
		{
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
			{
				$comment_id 		= trim($this->input->post('comment_id'));
				$status 			= trim($this->input->post('status'));

				$chkdata 		= array('id'  => $comment_id);
				$upd_userdata 	= array('status'  => $status);

				$upduser = $this->am->updateComment($upd_userdata, $chkdata);

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
