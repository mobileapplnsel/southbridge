<?php
require APPPATH . 'libraries/REST_Controller.php';     

class Native_API_Controller extends REST_Controller {    

    public function __construct() 
    {
      header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
      parent::__construct();
    }

    /*public function user_registration_api_post()
    {
        $postData = $this->input->post();
        //echo "<pre>"; print_r($_FILES);die;

        if (isset($postData) && !empty($postData)) 
        {
            $full_name                  = xss_clean(($this->input->post('full_name') != '') ? $this->input->post('full_name') : '');
            $company_name               = htmlspecialchars_decode(xss_clean(($this->input->post('company_name') != '') ? $this->input->post('company_name') : ''));
            $email                      = xss_clean(($this->input->post('email') != '') ? $this->input->post('email') : '');
            $phone                      = xss_clean(($this->input->post('phone') != '') ? $this->input->post('phone') : '');
            $password                   = htmlspecialchars_decode(xss_clean(($this->input->post('password') != '') ? $this->input->post('password') : ''));
            $address                    = htmlspecialchars_decode(xss_clean(($this->input->post('address') != '') ? $this->input->post('address') : ''));
            $country_id                 = xss_clean(($this->input->post('country_id') != '') ? $this->input->post('country_id') : '');
            $state_id                   = xss_clean(($this->input->post('state_id') != '') ? $this->input->post('state_id') : '');
            $city_id                    = xss_clean(($this->input->post('city_id') != '') ? $this->input->post('city_id') : '');
            $pin_code                   = xss_clean(($this->input->post('pin_code') != '') ? $this->input->post('pin_code') : '');
            $iec_no                     = xss_clean(($this->input->post('iec_no') != '') ? $this->input->post('iec_no') : '');
            $gst_no                     = xss_clean(($this->input->post('gst_no') != '') ? $this->input->post('gst_no') : '');
            $pan_no                     = xss_clean(($this->input->post('pan_no') != '') ? $this->input->post('pan_no') : '');
            $dtime                      = xss_clean(($this->input->post('dtime') != '') ? $this->input->post('dtime') : date('Y-m-d H:i:s'));
            $created_by                 = xss_clean(($this->input->post('created_by') != '') ? $this->input->post('created_by') : '');
            $user_category_id           = xss_clean(($this->input->post('user_category_id') != '') ? $this->input->post('user_category_id') : '');
            $user_sub_category_id       = xss_clean(($this->input->post('user_sub_category_id') != '') ? $this->input->post('user_sub_category_id') : '');
            $fcm_token                  = htmlspecialchars_decode(xss_clean(($this->input->post('fcm_token') != '') ? $this->input->post('fcm_token') : ''));
        } 
        else 
        {
            $jsonData                   = file_get_contents('php://input');
            $postData                   = json_decode($jsonData, true);
            //echo "<pre>"; print_r($postData); exit();

            $full_name                  = xss_clean((isset($postData['full_name'])) ? $postData['full_name'] : '');
            $company_name               = htmlspecialchars_decode(xss_clean((isset($postData['company_name'])) ? $postData['company_name'] : ''));
            $email                      = xss_clean((isset($postData['email'])) ? $postData['email'] : '');
            $phone                      = xss_clean((isset($postData['phone'])) ? $postData['phone'] : '');
            $password                   = htmlspecialchars_decode(xss_clean((isset($postData['password'])) ? $postData['password'] : ''));
            $address                    = htmlspecialchars_decode(xss_clean((isset($postData['address'])) ? $postData['address'] : ''));
            $country_id                 = xss_clean((isset($postData['country_id'])) ? $postData['country_id'] : '');
            $state_id                   = xss_clean((isset($postData['state_id'])) ? $postData['state_id'] : '');
            $city_id                    = xss_clean((isset($postData['city_id'])) ? $postData['city_id'] : '');
            $pin_code                   = xss_clean((isset($postData['pin_code'])) ? $postData['pin_code'] : '');
            $iec_no                     = xss_clean((isset($postData['iec_no'])) ? $postData['iec_no'] : '');
            $gst_no                     = xss_clean((isset($postData['gst_no'])) ? $postData['gst_no'] : '');
            $pan_no                     = xss_clean((isset($postData['pan_no'])) ? $postData['pan_no'] : '');
            $dtime                      = xss_clean((isset($postData['dtime'])) ? $postData['dtime'] : date('Y-m-d H:i:s'));
            $created_by                 = xss_clean((isset($postData['created_by'])) ? $postData['created_by'] : '');
            $user_category_id           = xss_clean((isset($postData['user_category_id'])) ? $postData['user_category_id'] : '');
            $user_sub_category_id       = xss_clean((isset($postData['user_sub_category_id'])) ? $postData['user_sub_category_id'] : '');
            $fcm_token                  = htmlspecialchars_decode(xss_clean((isset($postData['fcm_token'])) ? $postData['fcm_token'] : ''));
        }

        if($full_name != '' && $company_name != '' && $email != '' && $phone != '' && $password != '' && $fcm_token != '' && $address != '' && $country_id != '' && $state_id != '' && $city_id != '' && $pin_code != '' && $iec_no != '' && $gst_no != '' && $pan_no != '' && $created_by != '' && $user_category_id != ''&& $user_sub_category_id != '' )
        {
            $out_message = array();
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $if_email = 1; //email valid
            } 
            else 
            {
                $if_email = 0;
                $out_msg[] = array('statuscode' => '400', 'status' => 'failure', 'message' => 'email validation failed');
            }

            //phone with 10 digit
            if (preg_match('/^[0-9]{10}+$/', $phone)) 
            {
                $if_phone = 1; //phone valid

                if (isset($out_msg)) 
                {
                    $out_message = $out_msg;
                }
            } 
            else 
            {
                $if_phone = 0;
                $out_msg2[] = array('statuscode' => '400', 'status' => 'failure', 'message' => 'phone validation failed');

                if (isset($out_msg)) 
                {
                    $out_message = array_merge($out_msg, $out_msg2);
                } 
                else 
                {
                    $out_message = $out_msg2;
                }
            }

            $fourDigitOtp = rand(1000, 9999);

            if ($if_email == 1 && $if_phone == 1) 
            {
                $checkUserExists    =   [
                                            'email'     =>  $email,
                                            'phone'     =>  $phone
                                        ];

                // check OTP verified or NOT

                $otpVerified   =   $this->am->otp_verified_email_id_check($email);

                if($otpVerified == 'not_verified')
                {
                    $emailData     =     ['email'     =>  $email];
                    $this->am->delete_user_data($emailData);
                }

                $validateUserEmail   =   $this->am->check_user_email_exists($checkUserExists);
                $validateUserPhone   =   $this->am->check_user_phone_exists($checkUserExists);           

                if ($validateUserEmail == true) 
                {
                    $data = [
                                'statuscode'    =>  '405',
                                'status'        =>  'warning',
                                'message'       =>  'Email already exist!!',
                                'usrMobileNo'   =>  $phone,
                                'usrEmail'      =>  $email
                            ];
                } 
                else if ($validateUserPhone == true) 
                {
                    $data = [
                                'statuscode'    =>  '405',
                                'status'        =>  'warning',
                                'message'       =>  'Telephone already exist!!',
                                'usrMobileNo'   =>  $phone,
                                'usrEmail'      =>  $email
                            ];
                }
                else
                {
                    $message = '<!DOCTYPE html>';
                    $message .= '<html>';
                    $message .= '<body  style="font-family: "Open Sans", sans-serif;">';
                    $message .= '<div style="width:100%; max-width:600px; margin: 0 auto; ">';
                    $message .= '<table style="background: #fff; margin: 0 auto; font-family: "Open Sans", sans-serif; padding: 15px;">';
                    $message .= '<tbody>';
                    $message .= '<tr>';
                    $message .= '<td colspan="2" style="text-align: left;">';
                    $message .= '<img src="https://dataar.org/assets/frontend-new/images/dataar-logo.png" class="img-fluid" alt="">';
                    $message .= '</td>';
                    $message .= '</tr>';
                    $message .= '<tr>';
                    $message .= '<td style="padding-top: 20px; vertical-align: top;">';
                    $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin: 0px; margin-bottom: 0px;">Dear,</p>';
                    $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin: 0px; margin-bottom: 8px;"><span>'.ucfirst($firstname).'</span></p>';
                    $message .= '</td>';
                    $message .= '<td style="padding-top: 20px; vertical-align: top;">';
                    $message .= '<p style="font-size: 12px; color: #272727; text-align: right; font-weight: 600; text-transform: capitalize; margin: 0px; margin-bottom: 2px;">Dated: '.date('d/m/Y').'</p>';
                    $message .= '</td>';
                    $message .= '</tr>';
                    $message .= '<tr>';
                    $message .= '<td colspan="2">';
                    $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin-top: 20px;">Hope you are doing well !</p>';
                    $message .= '<div style="border:solid 1px #ddd; padding: 15px; width:100%;display: inherit;background: #fffdfd;">';
                    $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500;">Thank you for being associated with Dataar.</p>';
                    $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500;">Your OTP(One Time Password) is : <strong>'.$fourDigitOtp.'</strong> </p>';
                    $message .= '</div>';
                    $message .= '</td>';
                    $message .= '</tr>';
                    $message .= '<tr>';
                    $message .= '<td colspan="2" style="">';
                    $message .= '<p style="font-size: 12px; color: #1a29d3; text-align: left; font-weight: 500; margin-top: 20px; margin-bottom: 8px;">Rukmini Devi Shivchandram Foundation</p>';
                    $message .= '<p style="font-size: 12px; color: #1a29d3; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;">Dataar</p>';
                    $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;">Administrator</p>';
                    $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;"><a href="https://dataar.org/" target="Blank" style="color: #0e7493; text-decoration: none;">www.dataar.org </a></p>';
                    $message .= '<p style="font-size: 12px; color: #1a29d3; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;">Disclaimer:</p>';
                    $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;">This e-mail message may contain confidential, proprietary or legally privileged information. It should not be used by anyone who is not the original intended recipient. If you have erroneously received this message, please delete it immediately and notify the sender.</p>';
                    $message .= '</td>';
                    $message .= '</tr>';
                    $message .= '</tbody>';
                    $message .= '</table>';
                    $message .= '</div>';
                    $message .= '</body>';
                    $message .= '</html>';

                    $config = array(
                                        'protocol'          => 'smtp',
                                        'smtp_host'         => 'mail.dataar.org',
                                        'smtp_port'         => 25,
                                        'smtp_user'         => DATAAR_NO_REPLY_EMAIL_ID,
                                        'smtp_pass'         => DATAAR_NO_REPLY_PASSWORD,
                                        'mailtype'          => 'html',
                                        'smtp_timeout'      => '4',
                                        'charset'           => 'utf-8',
                                        'wordwrap'          => TRUE
                                    );

                        $this->load->library('email', $config);
                        $this->email->set_newline("\r\n");
                        $this->email->set_mailtype("html");
                        $this->email->from(DATAAR_NO_REPLY_EMAIL_ID, 'Dataar');
                        $this->email->to($email);
                        $this->email->subject('Dataar OTP');
                        $this->email->message($message);
                        $this->email->send();

                        if($phone !='')
                        {
                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                              CURLOPT_URL => 'https://103.229.250.200/smpp/sendsms?to=91'.$phone.'&from=RDSRFD&text=Your%20One%20Time%20Password%20to%20register%20with%20Dataar%20is:%20'.$fourDigitOtp.'.%20RDSRFD%20-%20DATAAR',
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => '',
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => 'POST',
                              CURLOPT_HTTPHEADER => array(
                                'Authorization: Bearer '.SMS_GATEWAY_TOKEN
                              ),
                            ));

                            $response = curl_exec($curl);

                            curl_close($curl);
                        }

                        $data = [
                                    'full_name'             =>  ucfirst($full_name),
                                    'company_name'          =>  ucfirst($company_name),
                                    'user_name'             =>  $email,
                                    'email'                 =>  $email,
                                    'phone'                 =>  $phone,
                                    'password'              =>  md5($password),
                                    'address'               =>  $address,
                                    'country_id'            =>  $country_id,
                                    'state_id'              =>  $state_id,
                                    'city_id'               =>  $city_id,
                                    'pin_code'              =>  $pin_code,
                                    'iec_no'                =>  $iec_no,
                                    'gst_no'                =>  $gst_no,
                                    'pan_no'                =>  $pan_no,
                                    'dtime'                 =>  $dtime,
                                    'created_by'            =>  $created_by,
                                    'user_category_id'      =>  $user_category_id,
                                    'user_sub_category_id'  =>  $user_sub_category_id,
                                    'fcm_token'             =>  $fcm_token,
                                    'otp'                   =>  $fourDigitOtp
                                ];

                    $insertNewUser      =   $this->am->insert_new_user($data);            

                    if ($insertNewUser > 0) 
                    {

                        $data = [
                                    'statuscode'    =>  '200',
                                    'status'        =>  'success',
                                    'message'       =>  'User Registered Sucessfully',
                                ];
                    } 
                    else 
                    {
                        $data   =   ['statuscode' => '200', 'status' => 'failure', 'message' => 'something went wrong'];
                    }
                }    
            } 
            else 
            {
                $data   =   $out_message;
            }    
        }
        else 
        {
            $data   =   ['statuscode' => '200', 'status' => 'failure', 'message' => 'form validation failed'];
        }
        $result = $this->response($data);
    }

    public function user_otp_verification_post()
    {
        header('Content-Type: application/json');
        $postData = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $phone      = $this->input->post('phone', TRUE);
            $otp        = $this->input->post('otp', TRUE);
        } 
        else 
        {
            $jsonData   = file_get_contents('php://input');
            $postData   = json_decode($jsonData, true);
            $phone      = $postData['phone'];
            $otp        = $postData['otp'];
        }

        if ($phone != '' && $otp != '') 
        {
            $params         =   ['phone'  =>  $phone,'otp'   =>  $otp];
            $otp_status     =   $this->am->check_user_otp_status($params);

            if ($otp_status == true) 
            {
                $return                 =   $this->am->get_user_data($params)[0];
                $token['user_id']       =   $return->user_id;
                $token['full_name']     =   $return->full_name;
                $token['email']         =   $return->email;  
                
                $data                   =   $return;
            } 
            else 
            {
                $data   =   ['status' => 'error', 'message'  => 'OTP Verification Failed'];
            }
        } 
        else 
        {
            $data = ['status' => 'warning', 'message' => 'Some Parameter Missing'];
        }

        $this->response($data);
    }

    public function resend_user_otp_post()
    {
        //$this->load->library('twilio');
        header('Content-Type: application/json');

        $postData = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $phone       = $this->input->post('phone');
            $full_name   = $this->input->post('full_name');
        } 
        else 
        {
            $jsonData = file_get_contents('php://input');
            $postData = json_decode($jsonData, true);

            $phone   = $postData['phone'];
            $full_name   = $postData['full_name'];
        }

        if ($phone) 
        {
            $params =   ['phone' => $phone];
            $otp    =   substr(str_shuffle("1234056789"), 0, 4);
            $email  =   $this->am->get_email_id_otp($params)[0];

            $message = '<!DOCTYPE html>';
            $message .= '<html>';
            $message .= '<body  style="font-family: "Open Sans", sans-serif;">';
            $message .= '<div style="width:100%; max-width:600px; margin: 0 auto; ">';
            $message .= '<table style="background: #fff; margin: 0 auto; font-family: "Open Sans", sans-serif; padding: 15px;">';
            $message .= '<tbody>';
            $message .= '<tr>';
            $message .= '<td colspan="2" style="text-align: left;">';
            $message .= '<img src="https://dataar.org/assets/frontend-new/images/dataar-logo.png" class="img-fluid" alt="">';
            $message .= '</td>';
            $message .= '</tr>';
            $message .= '<tr>';
            $message .= '<td style="padding-top: 20px; vertical-align: top;">';
            $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin: 0px; margin-bottom: 0px;">Dear,</p>';
            $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin: 0px; margin-bottom: 8px;"><span>'.ucfirst($full_name).'</span></p>';
            $message .= '</td>';
            $message .= '<td style="padding-top: 20px; vertical-align: top;">';
            $message .= '<p style="font-size: 12px; color: #272727; text-align: right; font-weight: 600; text-transform: capitalize; margin: 0px; margin-bottom: 2px;">Dated: '.date('d/m/Y').'</p>';
            $message .= '</td>';
            $message .= '</tr>';
            $message .= '<tr>';
            $message .= '<td colspan="2">';
            $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin-top: 20px;">Hope you are doing well !</p>';
            $message .= '<div style="border:solid 1px #ddd; padding: 15px; width:100%;display: inherit;background: #fffdfd;">';
            $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500;">Thank you for being associated with Dataar.</p>';
            $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500;">Your OTP(One Time Password) is : <strong>'.$otp.'</strong> </p>';
            $message .= '</div>';
            $message .= '</td>';
            $message .= '</tr>';
            $message .= '<tr>';
            $message .= '<td colspan="2" style="">';
            $message .= '<p style="font-size: 12px; color: #1a29d3; text-align: left; font-weight: 500; margin-top: 20px; margin-bottom: 8px;">Rukmini Devi Shivchandram Foundation</p>';
            $message .= '<p style="font-size: 12px; color: #1a29d3; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;">Dataar</p>';
            $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;">Administrator</p>';
            $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;"><a href="https://dataar.org/" target="Blank" style="color: #0e7493; text-decoration: none;">www.dataar.org </a></p>';
            $message .= '<p style="font-size: 12px; color: #1a29d3; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;">Disclaimer:</p>';
            $message .= '<p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px;">This e-mail message may contain confidential, proprietary or legally privileged information. It should not be used by anyone who is not the original intended recipient. If you have erroneously received this message, please delete it immediately and notify the sender.</p>';
            $message .= '</td>';
            $message .= '</tr>';
            $message .= '</tbody>';
            $message .= '</table>';
            $message .= '</div>';
            $message .= '</body>';
            $message .= '</html>';

            $config = array(
                                    'protocol'      => 'smtp',
                                    'smtp_host'     => 'mail.dataar.org',
                                    'smtp_port'     => 25,
                                    'smtp_user'     => DATAAR_NO_REPLY_EMAIL_ID,
                                    'smtp_pass'     => DATAAR_NO_REPLY_PASSWORD,
                                    'mailtype'      => 'html',
                                    'smtp_timeout'  => '4',
                                    'charset'       => 'utf-8',
                                    'wordwrap'      => TRUE
                                );

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from(DATAAR_NO_REPLY_EMAIL_ID, 'Dataar');
            $this->email->to($email->email);
            $this->email->subject('Dataar OTP');
            $this->email->message($message);
            $this->email->send();

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://103.229.250.200/smpp/sendsms?to=91'.$phone.'&from=RDSRFD&text=Your%20One%20Time%20Password%20to%20register%20with%20Dataar%20is:%20'.$otp.'.%20RDSRFD%20-%20DATAAR',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.SMS_GATEWAY_TOKEN
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //echo $response;die;

            $mobile_number_exist = $this->am->check_mobile_number_exist($params);

            if ($mobile_number_exist == true) 
            {
                $params_update  =   ['otp' => $otp];
                $update_user    =   $this->am->update_user_otp($params, $params_update);

                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'OTP sent successfully to the provided email, please check.'];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Mobile number not exist'];
            }
        } 
        else
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Parameter Missing'];
        }
        $this->response($data);
    }

    public function user_category_list_api_post()
    {
        $all_user_category  = $this->am->getCategoryData(array('status' => '1'), $many = TRUE);

        if(!empty($all_user_category))
        {
            return $this->response(array(
                                            'status'     => TRUE,
                                            'message'    => 'Success',
                                            'data'       => $all_user_category
                                        ), REST_Controller::HTTP_OK);
        }   
        else
        {
            return  $this->response(['status' => FALSE, 'message' => 'No User Category found.'], REST_Controller::HTTP_OK);
        }   
    }

    public function country_list_api_post()
    {
        $all_countries       = $this->am->get_all_countries($param = null, $many = TRUE);

        if(!empty($all_countries))
        {
            return $this->response(array(
                                            'status'     => TRUE,
                                            'message'    => 'Success',
                                            'data'       => $all_countries
                                        ), REST_Controller::HTTP_OK);
        }   
        else
        {
            return  $this->response(['status' => FALSE, 'message' => 'No Country found.'], REST_Controller::HTTP_OK);
        }   
    }

    public function country_wise_state_list_api_post()
    {
        $country_id    = $this->input->post('country_id');

        if(!empty($country_id) && $country_id != 0)
        {
            $param      = array('country_id' => $country_id);
            $all_states = $this->am->get_all_states($param, $many = TRUE);

            if(!empty($all_states))
            {
                return $this->response(array(
                                                'status'     => TRUE,
                                                'message'    => 'Success',
                                                'data'       => $all_states
                                            ), REST_Controller::HTTP_OK);
            }   
            else
            {
                return  $this->response(['status' => FALSE, 'message' => 'No State found.'], REST_Controller::HTTP_OK);
            }
        }
        else
        {
            return  $this->response(['status' => FALSE, 'message' => 'Parameter Missing.'], REST_Controller::HTTP_OK);
        }          
    }

    public function state_wise_city_list_api_post()
    {
        $state_id    = $this->input->post('state_id');
        
        if(!empty($state_id) && $state_id != 0)
        {
            $param      = array('state_id' =>   $state_id);
            $all_cities = $this->am->get_all_cities($param, $many = TRUE);

            if(!empty($all_cities))
            {
                return $this->response(array(
                                                'status'     => TRUE,
                                                'message'    => 'Success',
                                                'data'       => $all_cities
                                            ), REST_Controller::HTTP_OK);
            }   
            else
            {
                return  $this->response(['status' => FALSE, 'message' => 'No City found.'], REST_Controller::HTTP_OK);
            }
        }
        else
        {
            return  $this->response(['status' => FALSE, 'message' => 'Parameter Missing.'], REST_Controller::HTTP_OK);
        }        
    }

    public function login_api_post()
    {
        $postData = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $username       = $this->input->post('username');
            $password       = $this->input->post('password');
            $fcm_token      = xss_clean(($this->input->post('fcm_token') != '') ? $this->input->post('fcm_token') : 'test001');
            $login_ip       = $this->input->ip_address();
            $login_time     = date('Y-m-d H:i:s');
        } 
        else 
        {
            $jsonData       = file_get_contents('php://input');
            $postData       = json_decode($jsonData, true);

            $username       = $postData['username'];
            $password       = $postData['password'];
            $fcm_token      = xss_clean((isset($postData['fcm_token'])) ? $postData['fcm_token'] : 'test001');
            $login_ip       = $this->input->ip_address();
            $login_time     = date('Y-m-d H:i:s');
        }
        
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) 
        {
            $uField = 'Email';
        } 
        else 
        {
            $uField = 'Telephone number';
        }

        if (!empty($username) && !empty($password) && $fcm_token !='') 
        {
            $return     =   $this->am->validate_login($username, $password, $login_ip, $login_time, $fcm_token);

            if ($return == 'not_found') 
            {
                $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => $uField.' is not registered', 'userdata' => ''];
            } 
            else if ($return == 'password_incorrect') 
            {
                $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'password incorrect', 'userdata' => ''];
            } 
            else if ($return == 'inactive') 
            {
                $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'user inactive', 'userdata' => ''];
            } 
            else if ($return == 'cannot_validate') 
            {
                $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'cannot login now', 'userdata' => ''];
            } 
            else 
            {
                $token['user_id']       =   $return->user_id;
                $token['first_name']    =   $return->first_name;
                $token['last_name']     =   $return->last_name;
                $token['email']         =   $return->email;
                $data                   = $return;
            }
        } 
        else 
        {
            $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'Some Parameter Missing'];
        }
        $this->response($data);   
    }

    public function login_with_google_post()
    {
        $social             =    [];
        $check              =    [];

        $postData           = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            //Madhumoy

            $firstName       =    $this->input->post('firstName');
            $lastName        =    $this->input->post('lastName');
            $email           =    $this->input->post('email');
            $googleToken     =    $this->input->post('googleToken');
            $fcm_token       =    $this->input->post('fcm_token');

            $check['email']             =     $this->input->post('email');
            $check['google_token']      =     $this->input->post('googleToken');
        } 
        else 
        {
            $jsonData = file_get_contents('php://input');
            $postData = json_decode($jsonData, true);


            $firstName       =    $postData['firstName'];
            $lastName        =    $postData['lastName'];
            $email           =    $postData['email'];
            $googleToken     =    $postData['googleToken'];
            $fcm_token       =    $postData['fcm_token'];

            $check['email']             =     $postData['email'];
            $check['google_token']      =     $postData['googleToken'];
        }

        $ip         =   $this->input->ip_address();
        $userData   =   $this->am->check_google_user_exist($check);
        $userData   =   $userData[0];

        if (empty($userData)) 
        {
            $social['full_name']        =    $firstName.' '.$lastName;
            $social['user_name']        =    $email;
            $social['email']            =    $email;
            $social['google_token']     =    $googleToken;
            $social['fcm_token']        =    $fcm_token;
            $social['status']           =    "1";
            $social['last_login_ip']    =    $ip;
            $social['last_login_time']  =    dtime;
            $social['sign_up_type']     =   '2';

            $user_id    =   $this->am->insert_new_user($social);
            $getUser    =   $this->am->getUser(array('user_id' => $user_id));
            $userdata   =   $this->am->get_user_profile_info($user_id);

            if (!empty($getUser) && !empty($userdata)) 
            {

                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully', 'userdata' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','userdata' => ''];
            }
        } 
        else 
        {
            $dataU      =   [
                                'last_login_time'   =>  dtime,
                                'last_login_ip'     =>  $ip,
                                'google_token'      =>  $googleToken,
                                'fcm_token'         =>  $fcm_token
                            ];

            $update     =   $this->am->update_user_profile_info($userData['user_id'], $dataU);
            $getUser    =   $this->am->getUser(array('user_id' => $userData['user_id']));
            $userdata   =   $this->am->get_user_profile_info($userData['user_id']);

            if (!empty($getUser) && !empty($userdata)) 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','userdata' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','userdata' => ''];
            }
        }
        $this->response($data);
    }

    public function login_with_facebook_post()
    {
        $social     =    [];
        $check      =    [];

        $postData   = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            //Madhumoy

            $firstName      =    $this->input->post('firstName');
            $lastName       =    $this->input->post('lastName');
            $fb_token       =    $this->input->post('facebookToken');
            $facebook_id    =    $this->input->post('facebook_id');
            $fcm_token      =    $this->input->post('fcm_token');

            $check['facebook_id']       =     $facebook_id;
            $check['fb_token']          =     $this->input->post('facebookToken');
        } 
        else 
        {
            $jsonData = file_get_contents('php://input');
            $postData = json_decode($jsonData, true);

            $firstName      =    $postData['firstName'];
            $lastName       =    $postData['lastName'];
            $fcm_token      =    $postData['fcm_token'];
            $email          =    $postData['email'];
            $fb_token       =    $postData['facebookToken'];
            $facebook_id    =    $postData['facebook_id'];

            $check['facebook_id']       =     $facebook_id;
            $check['fb_token']          =     $postData['facebookToken'];
        }

        $ip         =   $this->input->ip_address();
        $userData   =   $this->am->check_facebook_user_exist($check);

        if (empty($userData)) 
        {
            $social['full_name']        =    $firstName.' '.$lastName;
            $social['fb_token']         =    $fb_token;
            $social['fcm_token']        =    $fcm_token;
            $social['facebook_id']      =    $facebook_id;
            $social['status']           =    "1";
            $social['last_login_ip']    =    $ip;
            $social['last_login_time']  =    dtime;
            $social['sign_up_type']     =   '3';

            $user_id    =   $this->am->insert_new_user($social);
            $getUser    =   $this->am->getUser(array('user_id' => $user_id));
            $userdata   =   $this->am->get_user_profile_info($user_id);

            if (!empty($getUser) && !empty($userdata)) 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','userdata' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','userdata' => ''];
            }
        } 
        else 
        {
            $dataU   =   [
                            'last_login_time'   =>  dtime,
                            'last_login_ip'     =>  $ip,
                            'fb_token'          =>  $fb_token,
                            'fcm_token'         =>  $fcm_token
                        ];

            $update         =   $this->am->update_user_profile_info($userData[0]['user_id'], $dataU);
            $getUser        =   $this->am->getUser(array('user_id' => $userData[0]['user_id']));
            $userdata       =   $this->am->get_user_profile_info($userData[0]['user_id']);

            if (!empty($getUser) && !empty($userdata)) 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully', 'userdata' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','userdata' => ''];
            }
        }
        $this->response($data);
    }

    public function login_with_apple_post()
    {
        $social     =    [];
        $check      =    [];

        $postData   = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            //Madhumoy

            $firstName      =    $this->input->post('firstName');
            $lastName       =    $this->input->post('lastName');
            $apple_id       =    $this->input->post('apple_id');
            $fcm_token      =    $this->input->post('fcm_token');

            $check['apple_id']    =     $apple_id;
        } 
        else 
        {
            $jsonData = file_get_contents('php://input');
            $postData = json_decode($jsonData, true);

            $firstName              =   $postData['firstName'];
            $lastName               =   $postData['lastName'];
            $fcm_token              =   $postData['fcm_token'];
            $apple_id               =   $postData['apple_id'];

            $check['apple_id']      =   $apple_id;
        }

        $ip         =   $this->input->ip_address();
        $userData   =   $this->am->check_apple_user_exist($check);

        if (empty($userData)) 
        {
            $social['full_name']        =    $firstName.' '.$lastName;
            $social['fcm_token']        =    $fcm_token;
            $social['apple_id']         =    $apple_id;
            $social['status']           =    "1";
            $social['last_login_ip']    =    $ip;
            $social['last_login_time']  =    dtime;
            $social['sign_up_type']     =   '4';

            $user_id        =   $this->am->insert_new_user($social);
            $getUser        =   $this->am->getUser(array('user_id' => $user_id));
            $userdata       =   $this->am->get_user_profile_info($user_id);

            if (!empty($getUser) && !empty($userdata)) 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','userdata' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','userdata' => ''];
            }
        } 
        else 
        {
            $dataU   =   [
                            'last_login_time'   =>  dtime,
                            'last_login_ip'     =>  $ip,
                            'apple_id'          =>  $apple_id,
                            'fcm_token'         =>  $fcm_token
                        ];

            if($firstName !='' && $lastName !='')
            {
                $dataU['first_name']    =   $firstName;
                $dataU['last_name']     =   $lastName;
            }            

            $update     =   $this->am->update_user_profile_info($userData[0]['user_id'], $dataU);
            $getUser    =   $this->am->getUser(array('user_id' => $userData[0]['user_id']));
            $userdata   =   $this->am->get_user_profile_info($userData[0]['user_id']);

            if (!empty($getUser) && !empty($userdata)) 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully', 'userdata' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','userdata' => ''];
            }
        }
        $this->response($data);
    }

    public function service_category_list_api_post()
    {
        $all_service_category  = $this->am->getServiceCategoryData(array('status' => '1'), $many = TRUE);

        if(!empty($all_service_category))
        {
            return $this->response(array(
                                            'status'     => TRUE,
                                            'message'    => 'Success',
                                            'data'       => $all_service_category
                                        ), REST_Controller::HTTP_OK);
        }   
        else
        {
            return  $this->response(['status' => FALSE, 'message' => 'No Service Category found.'], REST_Controller::HTTP_OK);
        }   
    }

    public function category_wise_service_list_api_post()
    {
        $category_id    = $this->input->post('category_id');

        if(!empty($category_id) && $category_id != 0)
        {
            $param      = array('category_id' => $category_id,'status'=>'1');
            $all_services = $this->am->getServiceData($param, $many = TRUE);

            if(!empty($all_services))
            {
                return $this->response(array(
                                                'status'     => TRUE,
                                                'message'    => 'Success',
                                                'data'       => $all_services
                                            ), REST_Controller::HTTP_OK);
            }   
            else
            {
                return  $this->response(['status' => FALSE, 'message' => 'No State found.'], REST_Controller::HTTP_OK);
            }
        }
        else
        {
            return  $this->response(['status' => FALSE, 'message' => 'Parameter Missing.'], REST_Controller::HTTP_OK);
        }          
    }*/
}
?>