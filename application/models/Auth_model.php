<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class Auth_model extends MY_Model
{


	function __construct()
	{
		$this->table = 'users';
		$this->primary_key = 'user_id';
	}

	//users
	public function addUser($data)
	{
		$this->table = 'users';
		return $this->store($data);
	}
	public function getUserData($param = null, $many = FALSE)
	{
		$this->table = 'users';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
			//return $this->db->last_query();
		} elseif ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by = 'user_id', $order = 'DESC', FALSE);
		} else {
			return $this->get_many();
		}
	}

    public function getUserListData($param = null, $many = FALSE)
    {
        $this->table = 'users';
        if ($param != null && $many == FALSE) {
            return $this->get_one($param);
            //return $this->db->last_query();
        } elseif ($param != null && $many == TRUE) {
            return $this->get_many($param, $order_by = 'full_name', $order = 'ASC', FALSE);
        } else {
            return $this->get_many();
        }
    }


	public function updateUser($data, $param)
	{
		$this->table = 'users';
		return $this->modify($data, $param);
	}
	public function delUser($param)
	{
		$this->table = 'users';
		return $this->remove($param);
	}

	public function getAllCategory()
	{
		$this->db->from('category');
		//$this->db->where('status','1');
		$this->db->order_by("category_name", "asc");
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function getCategoryData($param = null, $many = FALSE)
	{
		$this->table = 'category';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
			//echo $this->db->last_query();
		} elseif ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by = 'category_name', $order = 'ASC', FALSE);
		} else {
			return $this->get_many();
		}
	}

	public function addCategory($data)
	{
		$this->table = 'category';
		return $this->store($data);
	}

	public function updateCategory($data, $param)
	{
		$this->table = 'category';
		return $this->modify($data, $param);
	}

	public function deleteCategory($param)
	{
		$this->table = 'category';
		return $this->remove($param);
	}

	public function get_all_countries($param = null, $many = FALSE)
	{
		$this->table = 'countries_master';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
			//echo $this->db->last_query();
		} elseif ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by = 'name', $order = 'ASC', FALSE);
		} else {
			return $this->get_many();
		}
	}

	public function get_all_states($param = null, $many = FALSE)
	{
		$this->table = 'states_master';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
			//echo $this->db->last_query();
		} elseif ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by = 'name', $order = 'ASC', FALSE);
		} else {
			return $this->get_many();
		}
	}

	public function get_all_cities($param = null, $many = FALSE)
	{
		$this->table = 'cities_master';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
			//echo $this->db->last_query();
		} elseif ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by = 'name', $order = 'ASC', FALSE);
		} else {
			return $this->get_many();
		}
	}

	public function getAllServiceCategory()
	{
		$this->db->from('service_category');
		//$this->db->where('status','1');
		$this->db->order_by("id", "DESC");
		$query = $this->db->get(); 
		return $query->result_array();
	}
	public function getAllServiceCategoryForAddService()
	{
		$this->db->from('service_category');
		$this->db->where('status','1');
		$this->db->order_by("category_name", "ASC");
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function getServiceCategoryData($param = null, $many = FALSE)
	{
		$this->table = 'service_category';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
			//echo $this->db->last_query();die;
		} elseif ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by = 'category_name', $order = 'ASC', FALSE);
		} else {
			return $this->get_many();
		}
	}

	public function addServiceCategory($data)
	{
		$this->table = 'service_category';
		return $this->store($data);
	}

	public function updateServiceCategory($data, $param)
	{
		$this->table = 'service_category';
		return $this->modify($data, $param);
	}

	public function deleteServiceCategory($param)
	{
		$this->table = 'service_category';
		return $this->remove($param);
	}

	public function addService($data)
	{
		$this->table = 'service';
		return $this->store($data);
	}

	public function getAllService()
	{
		$this->db->from('service');
		//$this->db->where('status','1');
		$this->db->order_by("id", "DESC");
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function updateService($data, $param)
	{
		$this->table = 'service';
		return $this->modify($data, $param);
	}

	public function getServiceData($param = null, $many = FALSE)
	{
		$this->table = 'service';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
			//echo $this->db->last_query();die;
		} elseif ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by = 'id', $order = 'DESC', FALSE);
		} else {
			return $this->get_many();
		}
	}


	public function otp_verified_email_id_check($email_id) 
	{
		$this->db->select('otp_verified');
		$this->db->from('users');
		$this->db->where('email', $email_id);

		$query = $this->db->get();

		if($query->num_rows() > 0) 
		{
			$result = $query->row();
			if($result->otp_verified == 1) 
			{
				return 'verified';
			} 
			else 
			{
				return 'not_verified';
			}
		} 
		else 
		{
			return 'doesnt_exists';
		}
	}

	public function delete_user_data($data)
    {
        $this->db->where($data)->delete('users');
        return true;
    }

    public function check_user_email_exists($params)
    {
        //check for profile update
        if (array_key_exists("usrId", $params)) 
        {
            $st = "(`email` = '" . $params['email'] . "')";
            $this->db->where($st, NULL, FALSE);
        } 
        else 
        {
            $st = "(`email` = '" . $params['email'] . "')";
            $this->db->where($st, NULL, FALSE);
        }

        $query = $this->db->get('users');

        if ($query->num_rows() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public function check_user_phone_exists($params)
    {
    	//check for profile update
        if (array_key_exists("usrId", $params)) 
        {
            $st = "(`phone` = '" . $params['phone'] . "')";
            $this->db->where($st, NULL, FALSE);
        } 
        else 
        {
            $st = "(`phone` = '" . $params['phone'] . "')";
            $this->db->where($st, NULL, FALSE);
        }

        $query = $this->db->get('users');

        if ($query->num_rows() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public function check_user_otp_status($params)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(['phone' => $params['phone']]);

        $query      =   $this->db->get();
        $result     =   $query->row();

        if (!empty($result)) 
        {
            $Userid = $result->user_id;
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where(['user_id' => $Userid, 'otp' => $params['otp']]);

            $querycheck     =   $this->db->get();
            $resultrow      =   $querycheck->num_rows();

            if ($resultrow > 0) 
            {
                $otparray   =   ['status' => '1', 'otp_verified' => '1'];

                $this->db->where('user_id', $Userid);
                $this->db->update('users', $otparray);

                $query      =   $this->db->get('users');

                return true;
            } 
            else 
            {
                return false;
            }
        } 
        else 
        {
            return false;
        }
    }

    public function check_login_otp_status($params)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(['phone' => $params['phone']]);

        $query      =   $this->db->get();
        $result     =   $query->row();

        if (!empty($result)) 
        {
            $Userid = $result->user_id;
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where([
                                'user_id'           => $Userid, 
                                'login_otp'         => $params['otp']
                            ]);

            $querycheck     =   $this->db->get();
            $resultrow      =   $querycheck->num_rows();

            if ($resultrow > 0) 
            {
                $otparray   =   [
                                    'last_login_time'   => $params['login_time'], 
                                    'last_login_ip'     => $params['login_ip'], 
                                    'fcm_token'         => $params['fcm_token'],
                                    'token'             => $params['token']
                                ];

                $this->db->where('user_id', $Userid);
                $this->db->update('users', $otparray);
                //echo $this->db->last_query();die;

                $query  =   $this->db->get('users');

                $response = 'OTP Verified';
                return $response;
            } 
            else 
            {
                $response = 'Wrong OTP';
                return $response;
            }
        } 
        else 
        {
            $response = $params['phone'].' This Phone Number is not registered';
            return $response;
        }
    }

    public function get_user_data($params)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('phone', $params['phone']);

        return $this->db->get()->result();
    }

    public function get_email_id_otp($params)
    {
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('phone', $params['phone']);
        return $this->db->get()->result();
    }

    public function check_mobile_number_exist($params)
    {
        $this->db->where('phone', $params['phone']);

        $query  =   $this->db->get('users');
        $c      =   $query->num_rows();

        if ($c > 0) 
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function update_user_otp($params, $params_update)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(['phone' => $params['phone']]);

        $query  = $this->db->get();
        $result = $query->row();

        if (!empty($result)) 
        {
            $Userid = $result->user_id;

            $this->db->where('user_id', $Userid);

            if ($this->db->update('users', $params_update)) 
            {
                return true;
            } 
            else 
            {
                return false;
            }
        } 
        else 
        {
            return false;
        }
    }

    public function validate_login($phone_number)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(['phone' => $phone_number]);
        
        $query      =   $this->db->get();
        $result     =   $query->row();

        if (!empty($result)) 
        {
            if ($result->status == 1) 
            {
                ///$data['login_otp']          =   rand(1000,9999);
                $data['login_otp']          =   '1234';

                $this->db->where('phone', $phone_number);

                if ($this->db->update('users', $data)) 
                {
                    $this->db->select('user_id,full_name,user_name,phone,status,login_otp,user_group');
                    $this->db->from('users');
                    $this->db->where(['phone' => $phone_number]);
                    
                    $que        =   $this->db->get();
                    $res        =   $que->row();

                    return $res;
                } 
                else 
                {
                    return 'cannot_validate';
                }
            } 
            else 
            {
                return 'inactive';
            }
        } 
        else 
        {
            return 'not_found';
        }
    }

    public function check_google_user_exist($params)
    {
        $data['status']  			=   '1';
        $data['email']          	=   $params['email'];
        $token['google_token']    	=   $params['google_token'];
        $where  					=  "`google_token` != '' ";

        //check for registered gmail user id

        $this->db->select('email');
        $this->db->from('users');
        $this->db->where($data);
        $this->db->where($where);

        $query 		= 	$this->db->get();
        $numRows    =   $query->num_rows();

        if ($this->db->get_where('users', $params)->num_rows()) 
        {
            return $this->db->get_where('users', $params)->result_array();
        }
        else 
        {
            if ($numRows) 
            {
                $this->db->where('email', $data['email'])->update('users', $token);
                return $this->db->get_where('users', $params)->result_array();
            } 
            else 
            {
                return false;
            }
        }
    }

    public function getUser($params = null)
    {
        $this->db->select('*');
        $this->db->from('users');

        if ($params != null) 
        {
            $this->db->where($params);
        }
        return $this->db->get()->result();
    }

    public function get_user_profile_info($id)
    {
        $this->db->select('*')
            	 ->from('users')
            	 ->where('users.user_id', $id);

        $query  =   $this->db->get();

        return $query->row_array();
    }

    public function update_user_profile_info($id, $params)
    {
        $this->db->where('user_id', $id)->update('users', $params);
        return $this->db->affected_rows();
    }

    public function check_facebook_user_exist($params)
    {
        $data['status']  			=   '1';
		$data['facebook_id']      	=    $params['facebook_id'];
        $token['fb_token']  		=    $params['fb_token'];
        $where              		=   "`fb_token` != ''";

        $this->db->select('email')
            	 ->from('users')
            	 ->where($data)
            	 ->where($where);

        $query 		= 	$this->db->get();
        $numRows    =   $query->num_rows();

		if ($numRows) 
		{
            return $this->db->get_where('users', array('facebook_id =' => $params['facebook_id']))->result_array();
        } 
        else 
        {
            if ($numRows) 
            {
                $this->db->where('facebook_id', $data['facebook_id']);
                $this->db->update('users', $token);
                return true;
            } 
            else 
            {
                return false;
            }
        }
    }

    public function check_apple_user_exist($params)
    {
        $data['status']         =   '1';
        $data['apple_id']       =    $params['apple_id'];

        $token['apple_id']  =   $params['apple_id'];
        $where              =   "`apple_id` !=''";

        //check for registered gmail user id

        $this->db->select('user_id')
                 ->from('users')
                 ->where($data);

        $query = $this->db->get();

        $numRows         =   $query->num_rows();
        $result_array    =   $query->result_array();

        if ($this->db->get_where('users', $params)->num_rows()) 
        {
            return $this->db->get_where('users', $params)->result_array();
        } 
        else 
        {
            if ($numRows) 
            {
                $user_id = $result_array[0]['user_id'];
                $this->db->where('user_id', $user_id)->update('users', $token);
                return true;
            } 
            else 
            {
                return false;
            }
        }
    }

    public function insert_new_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }


    public function getPackageData($param = null, $many = FALSE)
    {
        $this->table = 'package';
        if ($param != null && $many == FALSE) {
            return $this->get_one($param);
            //echo $this->db->last_query();die;
        } elseif ($param != null && $many == TRUE) {
            return $this->get_many($param, $order_by = 'package_name', $order = 'ASC', FALSE);
        } else {
            return $this->get_many();
        }
    }

    public function addPackage($data)
    {
        $this->db->insert('package', $data);
        return $this->db->insert_id();
    }

    public function updatePackage($data, $param)
    {
        $this->table = 'package';
        return $this->modify($data, $param);
    }

    public function getSubscriptionData($param = null, $many = FALSE)
    {
        $this->table = 'subscription';
        if ($param != null && $many == FALSE) {
            return $this->get_one($param);
            //echo $this->db->last_query();die;
        } elseif ($param != null && $many == TRUE) {
            return $this->get_many($param, $order_by = 'id', $order = 'DESC', FALSE);
        } else {
            return $this->get_many();
        }
    }
    
    public function getEnqueryData($param = null, $many = FALSE)
    {
        $this->table = 'enquery_management';
        if ($param != null && $many == FALSE) {
            return $this->get_one($param);
            //echo $this->db->last_query();die;
        } elseif ($param != null && $many == TRUE) {
            return $this->get_many($param, $order_by = 'id', $order = 'DESC', FALSE);
        } else {
            return $this->get_many();
        }
    }

    public function updateEnquery($data, $param)
    {
        $this->table = 'enquery_management';
        return $this->modify($data, $param);
    }

    public function updateComment($data, $param)
    {
        $this->table = 'enquery_comments';
        return $this->modify($data, $param);
    }

    public function getAllServiceCategoryList()
    {
        $this->db->from('service_category');
        $this->db->where('status','1');
        $this->db->order_by("category_name", "ASC");
        $query = $this->db->get(); 
        return $query->result_array();
    }

    public function home_user_data($user_id, $params_update)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(['user_id' => $user_id]);

        $query  = $this->db->get();
        $result = $query->row();

        if (!empty($result)) 
        {
            $Userid = $result->user_id;

            $this->db->where('user_id', $user_id);

            if ($this->db->update('users', $params_update)) 
            {
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where(['user_id' => $user_id]);

                $query2  = $this->db->get();
                $result2 = $query2->row();

                return $result2;
            } 
            else 
            {
                return 'update_faild';
            }
        } 
        else 
        {
            return 'not_found';
        }
    }

    public function insert_new_enquiry($data)
    {
        $this->db->insert('enquery_management', $data);
        return $this->db->insert_id();
    }

    public function get_enquiry($params = null, $many = FALSE)
    {
        $this->db->select('enquery_management.*,users.full_name,');

        if ($params != null) 
        {
            $this->db->where($params);
        }

        $this->db->join('users', 'enquery_management.user_id = users.user_id', 'inner');
        $this->db->order_by("enquery_management.created_date", "DESC");

        $query = $this->db->get('enquery_management');
        //echo $this->db->last_query();die;
        if ($many == TRUE) 
        {
            $data = $query->result_array();
        } 
        else 
        {
            $data = $query->row_array();
        }

        return $data;
    }

    public function insert_new_enquiry_comments($data)
    {
        $this->db->insert('enquery_comments', $data);
        return $this->db->insert_id();
    }

    public function getComments($params = null, $many = FALSE)
    {
        $this->db->select('enquery_comments.*,users.full_name,');

        if ($params != null) 
        {
            $this->db->where($params);
        }

        $this->db->join('users', 'enquery_comments.user_id = users.user_id', 'inner');
        $this->db->order_by("enquery_comments.created_date", "DESC");

        $query = $this->db->get('enquery_comments');
        //echo $this->db->last_query();die;
        if ($many == TRUE) 
        {
            $data = $query->result_array();
        } 
        else 
        {
            $data = $query->row_array();
        }

        return $data;
    }

    public function insert_purchase_service($data)
    {
        $this->db->insert('purchase_service', $data);
        return $this->db->insert_id();
    }
    public function getServiceBookingsData($param = null, $many = FALSE)
    {
        $this->table = 'purchase_service';
        if ($param != null && $many == FALSE) {
            return $this->get_one($param);
            //echo $this->db->last_query();die;
        } elseif ($param != null && $many == TRUE) {
            return $this->get_many($param, $order_by = 'id', $order = 'DESC', FALSE);
        } else {
            return $this->get_many();
        }    
    }

    public function addPurchaseSubscription($data)
    {
        $this->db->insert('subscription', $data);
        return $this->db->insert_id();
    }

    public function getSubscribtionData($param = null, $many = FALSE)
    {
        $this->table = 'subscription';
        if ($param != null && $many == FALSE) {
            return $this->get_one($param);
            //echo $this->db->last_query();die;
        } elseif ($param != null && $many == TRUE) {
            return $this->get_many($param, $order_by = 'id', $order = 'DESC', FALSE);
        } else {
            return $this->get_many();
        }
    }

    public function getMySubscribtionData($user_id)
    {
        $this->db->select('subscription.*, package.*');
        $this->db->from('subscription');
        $this->db->join('package', 'package.id = subscription.package_id');
        $this->db->where('subscription.user_id',$user_id);
        
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }
        else
        {
            return array();
        }
    }

    public function getAllCms($param = null, $many = FALSE)
    {
        $this->table = 'cms';
        if ($param != null && $many == FALSE) {
            return $this->get_one($param);
            //echo $this->db->last_query();die;
        } elseif ($param != null && $many == TRUE) {
            return $this->get_many($param, $order_by = 'id', $order = 'DESC', FALSE);
        } else {
            return $this->get_many();
        }
    }

    public function updateCms($data, $param)
    {
        $this->table = 'cms';
        return $this->modify($data, $param);
    }
}
