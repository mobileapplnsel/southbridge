<?php
require APPPATH . 'libraries/REST_Controller.php';     

class Native_API_Controller extends REST_Controller {    

    public function __construct() 
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        date_default_timezone_set('Asia/Kolkata');
        parent::__construct();
    }

    public function generate_token($data)
    {
        $jwt            = new JWT();
        $jwtsecretkey   = 'hellokolkatakey';
        $token          = $jwt->encode($data,$jwtsecretkey,'HS256');
        return $token;
    }

    function verifyAuthToken($token,$user_id)
    {
        $params = array('user_id'=>$user_id,'token'=>$token);
        return $get_data = $this->am->getUserData($params,FALSE);
    }

    public function user_registration_api_post()
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
            $address                    = htmlspecialchars_decode(xss_clean((isset($postData['address'])) ? $postData['address'] : ''));
            $country_id                 = xss_clean((isset($postData['country_id'])) ? $postData['country_id'] : '');
            $state_id                   = xss_clean((isset($postData['state_id'])) ? $postData['state_id'] : '');
            $city_id                    = xss_clean((isset($postData['city_id'])) ? $postData['city_id'] : '');
            $pin_code                   = xss_clean((isset($postData['pin_code'])) ? $postData['pin_code'] : '');
            $iec_no                     = xss_clean((isset($postData['iec_no'])) ? $postData['iec_no'] : '');
            $gst_no                     = xss_clean((isset($postData['gst_no'])) ? $postData['gst_no'] : '');
            $pan_no                     = xss_clean((isset($postData['pan_no'])) ? $postData['pan_no'] : '');
            $dtime                      = date('Y-m-d H:i:s');
            $created_by                 = '1';
            $user_category_id           = xss_clean((isset($postData['user_category_id'])) ? $postData['user_category_id'] : '');
            $user_sub_category_id       = xss_clean((isset($postData['user_sub_category_id'])) ? $postData['user_sub_category_id'] : '');
            $fcm_token                  = htmlspecialchars_decode(xss_clean((isset($postData['fcm_token'])) ? $postData['fcm_token'] : ''));
        }

        if($full_name != '' && $company_name != '' && $email != '' && $phone != '' && $fcm_token != '' && $address != '' && $country_id != '' && $state_id != '' && $city_id != '' && $pin_code != '' && $iec_no != '' && $gst_no != '' && $pan_no != '' && $user_category_id != '')
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

            //$fourDigitOtp = rand(1000, 9999);
            $fourDigitOtp = '1234';

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
                    /*$message = '<!DOCTYPE html>';
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
                        }*/

                        $data = [
                                    'full_name'             =>  ucfirst($full_name),
                                    'company_name'          =>  ucfirst($company_name),
                                    'user_name'             =>  $email,
                                    'email'                 =>  $email,
                                    'phone'                 =>  $phone,
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
                        $userData = $this->am->getUserData(array('user_id' =>  $insertNewUser), FALSE);
                        $data = [
                                    'statuscode'    =>  '200',
                                    'status'        =>  'success',
                                    'message'       =>  'User Registered Sucessfully',
                                    'data'     =>  $userData
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

                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User OTP Verified', 'data' => $return];
            } 
            else 
            {
                $data = [
                            'statuscode'    =>  '200',
                            'status'        =>  'error',
                            'message'       =>  'OTP Verification Failed'
                        ];
            }
        } 
        else 
        {
            $data = [
                        'statuscode'    =>  '200',
                        'status'        =>  'warning',
                        'message'       =>  'Some Parameter Missing'
                    ];
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

            $phone          = $postData['phone'];
            $full_name      = $postData['full_name'];
        }

        if ($phone) 
        {
            $params =   ['phone' => $phone];
            //$otp    =   substr(str_shuffle("1234056789"), 0, 4);
            $otp    =   '1234';
            $email  =   $this->am->get_email_id_otp($params)[0];

            /*$message = '<!DOCTYPE html>';
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

            curl_close($curl);*/
            //echo $response;die;

            $mobile_number_exist = $this->am->check_mobile_number_exist($params);

            if ($mobile_number_exist == true) 
            {
                $params_update  =   ['otp' => $otp];
                $update_user    =   $this->am->update_user_otp($params, $params_update);

                $data = [
                            'statuscode'    =>  '200',
                            'status'        =>  'success',
                            'message'       =>  'OTP sent successfully to the provided email, please check.'
                        ];
            } 
            else 
            {
                $data = [
                            'statuscode'    =>  '200',
                            'status'        =>  'warning',
                            'message'       =>  'Mobile number not exist.'
                        ];
            }
        } 
        else
        {
            $data = [
                        'statuscode'    =>  '200',
                        'status'        =>  'warning',
                        'message'       =>  'Some Parameter Missing'
                    ];
        }
        $this->response($data);
    }

    public function user_category_list_api_post()
    {
        $all_user_category  = $this->am->getCategoryData(array('status' => '1'), $many = TRUE);

        if(!empty($all_user_category))
        {
            $data = [
                        'statuscode'    =>  '200',
                        'status'        =>  'success',
                        'data'          => $all_user_category
                    ];
        }   
        else
        {
            $data = [
                        'statuscode'    =>  '200',
                        'status'        =>  'warning',
                        'message'       =>  'No User Category found.'
                    ];
        } 
        $this->response($data);  
    }

    public function country_list_api_post()
    {
        $all_countries       = $this->am->get_all_countries($param = null, $many = TRUE);

        if(!empty($all_countries))
        {
            $data = [
                        'statuscode'    =>  '200',
                        'status'        =>  'success',
                        'data'          =>  $all_countries
                    ];
        }   
        else
        {
            $data = [
                        'statuscode'    =>  '200',
                        'status'        =>  'warning',
                        'message'       =>  'No Country found.'
                    ];
        }  
        $this->response($data); 
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
                $data = [
                            'statuscode'    =>  '200',
                            'status'        =>  'success',
                            'data'          =>  $all_states
                        ];
            }   
            else
            {
                $data = [
                            'statuscode'    =>  '200',
                            'status'        =>  'warning',
                            'message'       =>  'No State found.'
                        ];
            }
        }
        else
        {
            $data = [
                        'statuscode'    =>  '200',
                        'status'        =>  'warning',
                        'message'       =>  'Parameter Missing.'
                    ];
        }  
        $this->response($data);         
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
                $data = [
                            'statuscode'    =>  '200',
                            'status'        =>  'success',
                            'data'          =>  $all_cities
                        ];
            }   
            else
            {
                $data = [
                            'statuscode'    =>  '200',
                            'status'        =>  'warning',
                            'message'       =>  'No City found.'
                        ];
            }
        }
        else
        {
            $data = [
                        'statuscode'    =>  '200',
                        'status'        =>  'warning',
                        'message'       =>  'Parameter Missing.'
                    ];
        }  
        $this->response($data);       
    }

    public function login_api_post_old()
    {
        $postData = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $username       = $this->input->post('username');
            $password       = $this->input->post('password');
            $fcm_token      = xss_clean(($this->input->post('fcm_token') != '') ? $this->input->post('fcm_token') : '');
            $login_ip       = $this->input->ip_address();
            $login_time     = date('Y-m-d H:i:s');
        } 
        else 
        {
            $jsonData       = file_get_contents('php://input');
            $postData       = json_decode($jsonData, true);

            $username       = $postData['username'];
            $password       = $postData['password'];
            $fcm_token      = xss_clean((isset($postData['fcm_token'])) ? $postData['fcm_token'] : '');
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
                $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => $uField.' is not registered', 'data' => ''];
            } 
            else if ($return == 'password_incorrect') 
            {
                $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'password incorrect', 'data' => ''];
            } 
            else if ($return == 'inactive') 
            {
                $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'user inactive', 'data' => ''];
            } 
            else if ($return == 'cannot_validate') 
            {
                $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'cannot login now', 'data' => ''];
            } 
            else if($return->user_group != '3')
            {
                $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'These credentials do not match our user records'];
            }   
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully', 'data' => $return];
            }
        } 
        else 
        {
            $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'Some Parameter Missing'];
        }
        $this->response($data);   
    }

    public function login_api_post()
    {
        $postData = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $phone_number   = xss_clean($this->input->post('phone_number'));
        } 
        else 
        {
            $jsonData       = file_get_contents('php://input');
            $postData       = json_decode($jsonData, true);

            $phone_number   = xss_clean($postData['phone_number']);
        }

        if (!empty($phone_number) && $phone_number !='') 
        {
            if (preg_match('/^[0-9]{10}+$/', $phone_number)) 
            {
                $return     =   $this->am->validate_login($phone_number);

                /*echo "<pre>";
                print_r($return);die;*/

                if ($return == 'not_found') 
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => $phone_number.' This Phone Number is not registered', 'data' => ''];
                }  
                else if ($return == 'inactive') 
                {
                    $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'user inactive', 'data' => ''];
                } 
                else if ($return == 'cannot_validate') 
                {
                    $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'cannot login now', 'data' => ''];
                } 
                else if($return->user_group != '3')
                {
                    $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'These credentials do not match our user records'];
                }   
                else 
                {
                    $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Login OTP successfully Sent', 'data' => $return];
                }
            }
            else 
            {
                $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => $phone_number.' is Invalid Phone Number', 'data' => ''];
            }    
        } 
        else 
        {
            $data   =   ['statuscode' => '405', 'status' => 'warning', 'message' => 'Parameter Missing'];
        }
        $this->response($data);   
    }

    public function user_otp_verification_for_login_post()
    {
        header('Content-Type: application/json');
        $postData = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $phone          = xss_clean($this->input->post('phone', TRUE));
            $otp            = xss_clean($this->input->post('otp', TRUE));
            $fcm_token      = xss_clean(($this->input->post('fcm_token') != '') ? xss_clean($this->input->post('fcm_token')) : '');
        } 
        else 
        {
            $jsonData       = file_get_contents('php://input');
            $postData       = json_decode($jsonData, true);
            $phone          = $postData['phone'];
            $otp            = $postData['otp'];
            $fcm_token      = xss_clean((isset($postData['fcm_token'])) ? $postData['fcm_token'] : '');
        }

        $login_ip       = $this->input->ip_address();
        $login_time     = date('Y-m-d H:i:s');

        if ($phone != '' && $otp != '' && $fcm_token != '') 
        {
            $params         =   [
                                    'phone'         => $phone,
                                    'otp'           => $otp, 
                                    'fcm_token'     => $fcm_token, 
                                    'login_ip'      => $login_ip, 
                                    'login_time'    => $login_time
                                ];
            $return         =   $this->am->get_user_data($params)[0];

            $token['user_id']       =   $return->user_id;
            $token['full_name']     =   $return->full_name;
            $token['email']         =   $return->email;
            $token['rand']          =   rand(10000,99999);
            $params['token']        =   $this->generate_token($token);

            $otp_status     =   $this->am->check_login_otp_status($params);

            if ($otp_status == 'OTP Verified') 
            {
                $return   =   $this->am->get_user_data($params)[0]; 
                
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User Login OTP Verified', 'data' => $return];
            } 
            else if($otp_status == 'Wrong OTP')
            {
                $data   =   ['status' => 'error', 'message'  => 'Wrong OTP'];
            }
            else 
            {
                $data   =   ['status' => 'error', 'message'  => $phone.' This Phone Number is not registered'];
            }
        } 
        else 
        {
            $data = ['status' => 'warning', 'message' => 'Some Parameter Missing'];
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
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully', 'data' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','data' => ''];
            }
        } 
        else 
        {
            $token['user_id']       =   $userData['user_id'];
            $token['full_name']     =   $userData['full_name'];
            $token['email']         =   $userData['email'];
            $token['rand']          =   rand(10000,99999);
            $token                  =   $this->generate_token($token);

            $dataU      =   [
                                'last_login_time'   =>  dtime,
                                'last_login_ip'     =>  $ip,
                                'google_token'      =>  $googleToken,
                                'fcm_token'         =>  $fcm_token,
                                'token'             =>  $token
                            ];

            $update     =   $this->am->update_user_profile_info($userData['user_id'], $dataU);
            $getUser    =   $this->am->getUser(array('user_id' => $userData['user_id']));
            $userdata   =   $this->am->get_user_profile_info($userData['user_id']);

            if (!empty($getUser) && !empty($userdata)) 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','data' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','data' => ''];
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
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','data' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','data' => ''];
            }
        } 
        else 
        {
            $token['user_id']       =   $userData['user_id'];
            $token['full_name']     =   $userData['full_name'];
            $token['email']         =   $userData['email'];
            $token['rand']          =   rand(10000,99999);
            $token                  =   $this->generate_token($token);

            $dataU   =   [
                            'last_login_time'   =>  dtime,
                            'last_login_ip'     =>  $ip,
                            'fb_token'          =>  $fb_token,
                            'fcm_token'         =>  $fcm_token,
                            'token'             =>  $token
                        ];

            $update         =   $this->am->update_user_profile_info($userData[0]['user_id'], $dataU);
            $getUser        =   $this->am->getUser(array('user_id' => $userData[0]['user_id']));
            $userdata       =   $this->am->get_user_profile_info($userData[0]['user_id']);

            if (!empty($getUser) && !empty($userdata)) 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully', 'data' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','data' => ''];
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
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','data' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','data' => ''];
            }
        } 
        else 
        {
            $token['user_id']       =   $userData['user_id'];
            $token['full_name']     =   $userData['full_name'];
            $token['email']         =   $userData['email'];
            $token['rand']          =   rand(10000,99999);
            $token                  =   $this->generate_token($token);

            $dataU   =   [
                            'last_login_time'   =>  dtime,
                            'last_login_ip'     =>  $ip,
                            'apple_id'          =>  $apple_id,
                            'fcm_token'         =>  $fcm_token,
                            'token'             =>  $token
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
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully', 'data' => $getUser];
            } 
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully','data' => ''];
            }
        }
        $this->response($data);
    }

    public function service_category_list_api_post()
    {
        $all_service_category  = $this->am->getServiceCategoryData(array('status' => '1'), $many = TRUE);

        if(!empty($all_service_category))
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'data' => $all_service_category];
        }   
        else
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No Service Category found.'];
        }  
        $this->response($data); 
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
                $data = ['statuscode' => '200', 'status' => 'success', 'data' => $all_services];
            }   
            else
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No Service found.'];
            }
        }
        else
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Parameter Missing'];
        }
        $this->response($data);          
    }

    public function user_list_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id            = xss_clean(($postData['user_id'] != '') ? $postData['user_id'] : '');
                //$is_subscribed      = xss_clean(($postData['is_subscribed'] != '') ? $postData['is_subscribed'] : '1');
            } 
            else 
            {
                $jsonData       = file_get_contents('php://input');
                $postData       = json_decode($jsonData, true);

                $user_id            = xss_clean(($postData['user_id'] != '') ? $postData['user_id'] : '');
                //$is_subscribed      = xss_clean(($postData['is_subscribed'] != '') ? $postData['is_subscribed'] : '1');
            }

            if(!empty($user_id) && $user_id != 0)
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    $param      = array(
                                            'user_group'        => '3',
                                            'status'            => '1',
                                            'user_id !='        => $user_id,
                                            'is_subscribed'     => '1'
                                        );
                    $all_users = $this->am->getUserListData($param,TRUE);

                    if(!empty($all_users))
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'data' => $all_users];
                    }   
                    else
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No Subscribed User Found.'];
                    }
                }
                else
                {
                    $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Invalid Token Provided.'];
                }    
            }
            else
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Parameter Missing'];
            } 
        }
        catch(Exception $e)
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Invalid Token Provided.'];
        }

        $this->response($data);
    }

    public function home_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id        = $this->input->post('user_id');
                $fcm_token      = xss_clean(($this->input->post('fcm_token') != '') ? $this->input->post('fcm_token') : '');
            } 
            else 
            {
                $jsonData       = file_get_contents('php://input');
                $postData       = json_decode($jsonData, true);

                $user_id        = $postData['user_id'];
                $fcm_token      = xss_clean((isset($postData['fcm_token'])) ? $postData['fcm_token'] : '');
            }

            if (!empty($user_id) && $fcm_token !='') 
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {

                    $params_update  =   ['fcm_token' => $fcm_token];
                    $return         =   $this->am->home_user_data($user_id, $params_update);

                    if ($return == 'not_found') 
                    {
                        $data   =   ['statuscode' => '404', 'status' => 'error', 'message' =>'User Not Found', 'data' => ''];
                    } 
                    else if ($return == 'update_faild') 
                    {
                        $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'FCM Token Update Failed', 'data' => ''];
                    } 
                    else 
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User logged in successfully', 'data' => $return];
                    } 
                }   
                else
                {
                    $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Invalid Token Provided.'];
                } 
            } 
            else 
            {
                $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Some Parameter Missing'];
            }   
        }   
        catch(Exception $e) 
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Invalid Token Provided.'];
        } 
        $this->response($data); 
    }

    public function add_enquiry_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData   = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id       =    trim($postData['user_id']);
                $title         =    trim($postData['title']);
                $description   =    trim($postData['description']);
                $is_subscribed =    trim($postData['is_subscribed']);
            } 
            else 
            {
                $jsonData       =   file_get_contents('php://input');
                $postData       =   json_decode($jsonData, true);

                $user_id        =   trim($postData['user_id']);
                $title          =   trim($postData['title']);
                $description    =   trim($postData['description']);
                $is_subscribed  =   trim($postData['is_subscribed']);
            }

            if($user_id && $title && $description)
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    if($is_subscribed == 1)
                    {
                        if (!is_dir('uploads/enquiry_doc'))
                        {
                            mkdir('uploads/enquiry_doc', 0777);
                        }

                        if(!empty($_FILES['enquiry_image']['name']))
                        {
                            $new_name1                  =   time() . '_enquiry_image';
                            $config1['file_name']       =   $new_name1;
                            $config1['upload_path']     =   "uploads/enquiry_doc/";
                            $config1['allowed_types']   =   'gif|jpg|png|jpeg';

                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);

                            if ($this->upload->do_upload('enquiry_image')) 
                            {
                                $uploadData1          =     $this->upload->data();
                                $enquiryimageFile     =     $uploadData1['file_name'];
                            }
                        } 
                        else 
                        {
                            $enquiryimageFile       =     '';
                        }

                        $data   =   [
                                        'user_id'        =>  $user_id,
                                        'title'          =>  $title,
                                        'description'    =>  $description,
                                        'image'          =>  $enquiryimageFile,
                                        'created_date'   =>  date('Y-m-d H:i:s')
                                    ];

                        $insert_id   =   $this->am->insert_new_enquiry($data);  
                        
                        if($insert_id != 0 && $insert_id != '')
                        {
                            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'An Enquiry Posted Sucessfully'];
                        }          
                    }    
                    else 
                    {
                        $data = ['statuscode' => '404', 'status' => 'error', 'message' => 'You Are Not A Subscribed User.'];
                    }
                }
                else 
                {
                    $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Invalid Token Provided.'];
                } 
            }    
            else 
            {
                $data = ['statuscode' => '404', 'status' => 'error', 'message' => 'Some params missing'];
            }
        } 
        catch(Exception $e) 
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Invalid Token Provided.'];
        } 
        $this->response($data);    



        $postData   = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $user_id       =    trim($postData['user_id']);
            $title         =    trim($postData['title']);
            $description   =    trim($postData['description']);
            $is_subscribed =    trim($postData['is_subscribed']);
        } 
        else 
        {
            $jsonData       =   file_get_contents('php://input');
            $postData       =   json_decode($jsonData, true);

            $user_id        =   trim($postData['user_id']);
            $title          =   trim($postData['title']);
            $description    =   trim($postData['description']);
            $is_subscribed  =   trim($postData['is_subscribed']);
        }

        if($user_id && $title && $description)
        {
            if($is_subscribed == 1)
            {
                if (!is_dir('uploads/enquiry_doc'))
                {
                    mkdir('uploads/enquiry_doc', 0777);
                }

                if(!empty($_FILES['enquiry_image']['name']))
                {
                    $new_name1                  =   time() . '_enquiry_image';
                    $config1['file_name']       =   $new_name1;
                    $config1['upload_path']     =   "uploads/enquiry_doc/";
                    $config1['allowed_types']   =   'gif|jpg|png|jpeg';

                    $this->load->library('upload', $config1);
                    $this->upload->initialize($config1);

                    if ($this->upload->do_upload('enquiry_image')) 
                    {
                        $uploadData1          =     $this->upload->data();
                        $enquiryimageFile     =     $uploadData1['file_name'];
                    }
                } 
                else 
                {
                    $enquiryimageFile       =     '';
                }

                $data   =   [
                                'user_id'        =>  $user_id,
                                'title'          =>  $title,
                                'description'    =>  $description,
                                'image'          =>  $enquiryimageFile,
                                'created_date'   =>  date('Y-m-d H:i:s')
                            ];

                $insert_id   =   $this->am->insert_new_enquiry($data);  
                
                if($insert_id != 0 && $insert_id != '')
                {
                    $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'An Enquiry Posted Sucessfully'];
                }          
            }    
            else 
            {
                $data = ['statuscode' => '404', 'status' => 'error', 'message' => 'You Are Not A Subscribed User.'];
            }
        }   
        else 
        {
            $data = ['statuscode' => '404', 'status' => 'error', 'message' => 'Some params missing'];
        } 
        $this->response($data);
    }

    public function enquiry_list_api_post()
    {
        $param  = array('enquery_management.status' => '1');
        $enquiryData   = $this->am->get_enquiry($param,TRUE);

        if(!empty($enquiryData))
        {
            foreach ($enquiryData as $key => $value) 
            {
                /*$paramsComment  =     array('enquiry_id' => $value['id']);
                $comments       =     $this->am->getComments($paramsComment,TRUE);

                if (!empty($comments)) 
                {
                    foreach ($comments as $key => $val) 
                    {
                        if(!empty($val['comment_image']) && $val['comment_image'] !='')
                        {
                            $comments[$key]['comment_image_url'] = base_url('uploads/comment_doc/').$val['comment_image'];
                        } 
                        else 
                        {
                            $comments[$key]['comment_image_url'] = '';
                        } 
                    }
                    $enquiryData[$key]['comments'] = $comments;
                } 
                else 
                {
                    $enquiryData[$key]['comments'] = '';
                }*/

                if(!empty($value['image']) && $value['image'] !='')
                {
                    $enquiryData[$key]['image_url'] = base_url('uploads/enquiry_doc/').$value['image'];
                } 
                else 
                {
                    $enquiryData[$key]['image_url'] = '';
                }   
            }  
            //$data['enquiry_data'] = $enquiryData;  

            $data = ['statuscode' => '200', 'status' => 'success', 'data' => $enquiryData];
        }   
        else
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No Enquiry found.'];
        }
        //die;
        $this->response($data);
    }

    public function enquiry_details_api_post()
    {
        $postData = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $enquiry_id            = xss_clean(($postData['enquiry_id'] != '') ? $postData['enquiry_id'] : '0');
        } 
        else 
        {
            $jsonData       = file_get_contents('php://input');
            $postData       = json_decode($jsonData, true);

            $enquiry_id            = xss_clean(($postData['enquiry_id'] != '') ? $postData['enquiry_id'] : '0');
        }

        if(!empty($enquiry_id) && $enquiry_id != 0)
        {
            $param          = array('enquery_management.id'=>$enquiry_id,'enquery_management.status' => '1');
            $enquiryData    = $this->am->get_enquiry($param,FALSE);
                /*echo "<pre>";
                print_r($enquiryData);die;*/
            if(!empty($enquiryData))
            {
                if(!empty($enquiryData['image']) && $enquiryData['image'] !='')
                {
                    $enquiryData['image_url'] = base_url('uploads/enquiry_doc/').$enquiryData['image'];
                } 
                else 
                {
                    $enquiryData['image_url'] = '';
                }
                
                $paramsComment  =     array('enquiry_id' => $enquiryData['id']);
                $comments       =     $this->am->getComments($paramsComment,TRUE);

                if (!empty($comments)) 
                {
                    /*foreach ($comments as $key => $val) 
                    {
                        if(!empty($val['comment_image']) && $val['comment_image'] !='')
                        {
                            $comments[$key]['comment_image_url'] = base_url('uploads/comment_doc/').$val['comment_image'];
                        } 
                        else 
                        {
                            $comments[$key]['comment_image_url'] = '';
                        } 
                    }*/
                    $enquiryData['comments'] = $comments;
                } 
                else 
                {
                    $enquiryData['comments'] = '';
                }   
                //$data['enquiry_data'] = $enquiryData;  

                $data = ['statuscode' => '200', 'status' => 'success', 'data' => $enquiryData];
            }   
            else
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No Enquiry found.'];
            }
        }
        else 
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Parameter Missing'];
        }    
        $this->response($data); 
    }

    public function user_details_api_post_old()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData   = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id       =    trim($postData['user_id']);
            } 
            else 
            {
                $jsonData       =   file_get_contents('php://input');
                $postData       =   json_decode($jsonData, true);

                $user_id        =   trim($postData['user_id']);
            }

            if($user_id != '0' && $user_id != '')
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    $param      = array(
                                            'user_group'        => '3',
                                            'status'            => '1',
                                            'user_id'           => $user_id
                                        );
                    $user_details = $this->am->getUserListData($param,FALSE);

                    if(!empty($user_details))
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'data' => $user_details];
                    }   
                    else
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No User Found.'];
                    } 
                }  
                else 
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
                }   
            }    
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Params Missing.'];
            }    
        }
        catch(Exception $e) 
        {
            $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
        }    
        $this->response($data);   
    }
    public function user_details_api_post()
    {
        $postData   = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $user_id       =    trim($postData['user_id']);
        } 
        else 
        {
            $jsonData       =   file_get_contents('php://input');
            $postData       =   json_decode($jsonData, true);

            $user_id        =   trim($postData['user_id']);
        }

        if($user_id != '0' && $user_id != '')
        {
            $param      = array(
                                    'user_group'        => '3',
                                    'status'            => '1',
                                    'user_id'           => $user_id
                                );
            $user_details = $this->am->getUserListData($param,FALSE);

            if(!empty($user_details))
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'data' => $user_details];
            }   
            else
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No User Found.'];
            } 
        }    
        else 
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Params Missing.'];
        }  
        $this->response($data);
    }

    public function add_comments_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData   = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id        =    trim($postData['user_id']);
                $enquiry_id     =    trim($postData['enquiry_id']);
                $comment        =    trim($postData['comment']);
                $is_subscribed  =    trim($postData['is_subscribed']);
            } 
            else 
            {
                $jsonData       =   file_get_contents('php://input');
                $postData       =   json_decode($jsonData, true);

                $user_id        =   trim($postData['user_id']);
                $enquiry_id     =   trim($postData['enquiry_id']);
                $comment        =   trim($postData['comment']);
                $is_subscribed  =   trim($postData['is_subscribed']);
            }

            if($user_id != '0' && $user_id != '' && $enquiry_id != '0' && $enquiry_id != '' && $comment != '')
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    if($is_subscribed == '1')
                    {
                        if (!is_dir('uploads/comment_doc'))
                        {
                            mkdir('uploads/comment_doc', 0777);
                        }

                        if(!empty($_FILES['comment_image']['name']))
                        {
                            $new_name1                  =   time() . '_comment_image';
                            $config1['file_name']       =   $new_name1;
                            $config1['upload_path']     =   "uploads/comment_doc/";
                            $config1['allowed_types']   =   'gif|jpg|png|jpeg';

                            $this->load->library('upload', $config1);
                            $this->upload->initialize($config1);

                            if ($this->upload->do_upload('comment_image')) 
                            {
                                $uploadData1          =     $this->upload->data();
                                $commentimageFile     =     $uploadData1['file_name'];
                            }
                        } 
                        else 
                        {
                            $commentimageFile       =     '';
                        }

                        $data   =   [
                                        'user_id'           =>  $user_id,
                                        'enquiry_id'        =>  $enquiry_id,
                                        'comment'           =>  $comment,
                                        'comment_image'     =>  $commentimageFile,
                                        'created_date'      =>  date('Y-m-d H:i:s')
                                    ];

                        $insert_id   =   $this->am->insert_new_enquiry_comments($data);  
                        
                        if($insert_id != 0 && $insert_id != '')
                        {
                            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'An Enquiry Comment Posted Sucessfully.'];
                        }            
                    }   
                    else 
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'You Are Not A Subscribed User.'];
                    }
                }  
                else 
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
                }
            }
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Params Missing.'];
            }    
        }
        catch(Exception $e) 
        {
            $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
        }      
        $this->response($data);
    }

    public function my_profile_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData   = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id       =    trim($postData['user_id']);
            } 
            else 
            {
                $jsonData       =   file_get_contents('php://input');
                $postData       =   json_decode($jsonData, true);

                $user_id        =   trim($postData['user_id']);
            }

            if(!empty($user_id) && $user_id != '0' && $user_id != '')
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    $param      = array(
                                            'user_group'        => '3',
                                            'status'            => '1',
                                            'user_id'           => $user_id
                                        );
                    $user_details = $this->am->getUserListData($param,FALSE);

                    if(!empty($user_details))
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'data' => $user_details];
                    }   
                    else
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No User Found.'];
                    }
                }  
                else 
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
                }
            }
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Params Missing.'];
            }
        }
        catch(Exception $e)
        {
            $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
        }     
        $this->response($data);
    }

    public function update_profile_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id                    = xss_clean(($this->input->post('user_id') != '') ? $this->input->post('user_id') : '');
                $full_name                  = xss_clean(($this->input->post('full_name') != '') ? $this->input->post('full_name') : '');
                $company_name               = htmlspecialchars_decode(xss_clean(($this->input->post('company_name') != '') ? $this->input->post('company_name') : ''));
                $address                    = htmlspecialchars_decode(xss_clean(($this->input->post('address') != '') ? $this->input->post('address') : ''));
                $country_id                 = xss_clean(($this->input->post('country_id') != '') ? $this->input->post('country_id') : '');
                $state_id                   = xss_clean(($this->input->post('state_id') != '') ? $this->input->post('state_id') : '');
                $city_id                    = xss_clean(($this->input->post('city_id') != '') ? $this->input->post('city_id') : '');
                $pin_code                   = xss_clean(($this->input->post('pin_code') != '') ? $this->input->post('pin_code') : '');
                $iec_no                     = xss_clean(($this->input->post('iec_no') != '') ? $this->input->post('iec_no') : '');
                $gst_no                     = xss_clean(($this->input->post('gst_no') != '') ? $this->input->post('gst_no') : '');
                $pan_no                     = xss_clean(($this->input->post('pan_no') != '') ? $this->input->post('pan_no') : '');
                $user_category_id           = xss_clean(($this->input->post('user_category_id') != '') ? $this->input->post('user_category_id') : '');
                $user_sub_category_id       = xss_clean(($this->input->post('user_sub_category_id') != '') ? $this->input->post('user_sub_category_id') : '');
            } 
            else 
            {
                $jsonData                   = file_get_contents('php://input');
                $postData                   = json_decode($jsonData, true);
                //echo "<pre>"; print_r($postData); exit();

                $user_id                    = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
                $full_name                  = xss_clean((isset($postData['full_name'])) ? $postData['full_name'] : '');
                $company_name               = htmlspecialchars_decode(xss_clean((isset($postData['company_name'])) ? $postData['company_name'] : ''));
                $address                    = htmlspecialchars_decode(xss_clean((isset($postData['address'])) ? $postData['address'] : ''));
                $country_id                 = xss_clean((isset($postData['country_id'])) ? $postData['country_id'] : '');
                $state_id                   = xss_clean((isset($postData['state_id'])) ? $postData['state_id'] : '');
                $city_id                    = xss_clean((isset($postData['city_id'])) ? $postData['city_id'] : '');
                $pin_code                   = xss_clean((isset($postData['pin_code'])) ? $postData['pin_code'] : '');
                $iec_no                     = xss_clean((isset($postData['iec_no'])) ? $postData['iec_no'] : '');
                $gst_no                     = xss_clean((isset($postData['gst_no'])) ? $postData['gst_no'] : '');
                $pan_no                     = xss_clean((isset($postData['pan_no'])) ? $postData['pan_no'] : '');
                $user_category_id           = xss_clean((isset($postData['user_category_id'])) ? $postData['user_category_id'] : '');
                $user_sub_category_id       = xss_clean((isset($postData['user_sub_category_id'])) ? $postData['user_sub_category_id'] : '');
            }

            if($user_id != '' && $full_name != '' && $company_name != '' && $address != '' && $country_id != '' && $state_id != '' && $city_id != '' && $pin_code != '' && $iec_no != '' && $gst_no != '' && $pan_no != '' && $user_category_id != '')
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    $params         = array('user_id'=>$user_id);
                    $update_data    = array(
                                                'full_name'             => $full_name,
                                                'company_name'          => $company_name,
                                                'address'               => $address,
                                                'country_id'            => $country_id,
                                                'state_id'              => $state_id,
                                                'city_id'               => $city_id,
                                                'pin_code'              => $pin_code,
                                                'iec_no'                => $iec_no,
                                                'gst_no'                => $gst_no,
                                                'pan_no'                => $pan_no,
                                                'user_category_id'      => $user_category_id,
                                                'user_sub_category_id'  => $user_sub_category_id
                                            );

                    $upDuser = $this->am->updateUser($update_data, $params);

                    if($upDuser)
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User Data Updated Successfully', 'data' =>$update_data ];
                    } 
                    else
                    {
                        $data = ['statuscode' => '404', 'status' => 'error', 'message' => 'Update Failed!'];
                    }
                }
                else 
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
                }    
            }   
            else 
            {
                $data = ['statuscode' => '404', 'status' => 'error', 'message' => 'Some params missing'];
            } 
        }
        catch(Exception $e)
        {
            $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
        }      
        $this->response($data);
    }

    public function service_details_api_post()
    {
        $postData   = $this->input->post();

        if (isset($postData) && !empty($postData)) 
        {
            $service_id       =    trim($postData['service_id']);
        } 
        else 
        {
            $jsonData       =   file_get_contents('php://input');
            $postData       =   json_decode($jsonData, true);

            $service_id        =   trim($postData['service_id']);
        }

        if(!empty($service_id) && $service_id != '0' && $service_id != '')
        {
            $param      = array('id' => $service_id,'status'=>'1');
            $all_services = $this->am->getServiceData($param, $many = TRUE);

            if(!empty($all_services))
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'data' => $all_services];
            }   
            else
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No Service found.'];
            } 
        }
        else 
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Params Missing.'];
        } 
        $this->response($data);
    }

    public function purchase_service_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData   = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id            = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
                $service_id         = xss_clean((isset($postData['service_id'])) ? $postData['service_id'] : '');
                $amount             = xss_clean((isset($postData['amount'])) ? $postData['amount'] : '');
                $transaction_id     = xss_clean((isset($postData['transaction_id'])) ? $postData['transaction_id'] : '');
            } 
            else 
            {
                $jsonData       =   file_get_contents('php://input');
                $postData       =   json_decode($jsonData, true);

                $user_id            = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
                $service_id         = xss_clean((isset($postData['service_id'])) ? $postData['service_id'] : '');
                $amount             = xss_clean((isset($postData['amount'])) ? $postData['amount'] : '');
                $transaction_id     = xss_clean((isset($postData['transaction_id'])) ? $postData['transaction_id'] : '');
            }

            if($user_id != '' && $service_id != '' && $amount != '' && $transaction_id != '')
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    $purchase_no     = rand(1111111111,9999999999);
                    $payment_status  = '1';
                    $created_date    = date('Y-m-d H:i:s');

                    $insert_data    = array(
                                                'user_id'             => $user_id,
                                                'service_id'          => $service_id,
                                                'amount'              => $amount,
                                                'transaction_id'      => $transaction_id,
                                                'purchase_no'         => $purchase_no,
                                                'payment_status'      => $payment_status,
                                                'created_date'        => $created_date
                                            );

                    $inserted   =   $this->am->insert_purchase_service($insert_data);

                    if($inserted > '0')
                    {
                        /*Email & SMS Code*/
                        //echo ABS_PATH; die;
                        $tcpdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
                        $tcpdf->SetTitle('Southbridge - Booking Invoice');
                        $tcpdf->SetTopMargin(5);
                        $tcpdf->setFooterMargin(5);
                        $tcpdf->SetAutoPageBreak(true);
                        $tcpdf->SetAuthor('Southbridge');
                        $tcpdf->SetDisplayMode('real', 'default');
                        $tcpdf->AddPage('P',"A4");

                        $params = array('transaction_id'=>'pay_KMzENMX3Y4Ywlz');
                        $service_bookings = $this->am->getServiceBookingsData($params, $many = FALSE);

                        if(!empty($service_bookings))
                        {
                            $params             = array('user_id'=>$service_bookings->user_id);
                            $user_data          = $this->am->getUserData($params, $many = FALSE);

                            $params_two         = array('id'=>$service_bookings->service_id);
                            $service_data       = $this->am->getServiceData($params_two, $many = FALSE);

                            if(!empty($user_data) && !empty($service_data))
                            {
                                $params_three       = array('id'=>$service_data->category_id);
                                $service_cat_data   = $this->am->getServiceCategoryData($params_three, $many = FALSE);

                                $user_name              = ucwords($user_data->full_name);
                                $user_email             = $user_data->email;
                                $user_phone             = $user_data->phone;
                                $user_company_name      = ucwords($user_data->company_name);

                                $service_category_name  = ucwords($service_cat_data->category_name);
                                $service_name           = ucwords($service_data->service_name);
                                $service_setails        = ucfirst($service_data->service_details);
                                $amount                 = '₹ '.$service_data->price;

                                $purchase_no            = $service_bookings->purchase_no;
                                $transaction_id         = $service_bookings->transaction_id;
                                $booking_date           = date('m-d-Y H:i A',strtotime($service_bookings->created_date));

                                $head_date              = date("d/m/Y",strtotime($service_bookings->created_date));
                                $logo                   = base_url('common/images/southbridge-logo.png');

                                $html = <<<EOD
                                <!DOCTYPE html>
                                <html>
                                <body  style="font-family: "Open Sans", sans-serif;">
                                    <div style="width:100%; max-width:600px; margin: 0 auto; ">
                                        <table style="background: #fff; margin: 0 auto; font-family: "Open Sans", sans-serif; padding: 15px;">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="text-align: left;">
                                                        <img src="$logo" style="width: 20%;" class="img-fluid" alt="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 20px; vertical-align: top;">
                                                        <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin: 0px; margin-bottom: 0px;">Dear,</p>
                                                        <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin: 0px; margin-bottom: 8px; line-height:0px"><span>$user_name</span></p>
                                                        <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin: 0px; margin-bottom: 8px; line-height:0px"><span>$user_email</span></p>
                                                        <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin: 0px; margin-bottom: 8px; line-height:0px"><span>$user_phone</span></p>
                                                        <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin: 0px; margin-bottom: 8px; line-height:0px"><span>$user_company_name</span></p>
                                                    </td>
                                                    <td style="padding-top: 20px; vertical-align: top;">
                                                        <p style="font-size: 12px; color: #272727; text-align: right; font-weight: 600; text-transform: capitalize; margin: 0px; margin-bottom: 2px;">Dated: $booking_date</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; text-transform: capitalize; margin-top: 20px;">Hope you are doing well !</p>
                                                        <div style="border:solid 1px #ddd; padding: 15px; width:100%;display: inherit;background: #fffdfd;">
                                                            <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500;">Thank you for making your donation for campaign Please download donation receipt with thank you letter attached to this email.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="">
                                                        <p style="font-size: 12px; color: #1a29d3; text-align: left; font-weight: 500; margin-top: 20px; margin-bottom: 8px; ">Rukmini Devi Shivchandram Foundation</p>
                                                        <p style="font-size: 12px; color: #1a29d3; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px; line-height:0px">Dataar</p>
                                                        <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px; line-height:0px">Administrator</p>
                                                        <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px; line-height:0px"><a href="https://dataar.org/" target="Blank" style="color: #0e7493; text-decoration: none;">www.dataar.org </a></p>
                                                        <p style="font-size: 12px; color: #1a29d3; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px; ">Disclaimer:</p>
                                                        <p style="font-size: 12px; color: #272727; text-align: left; font-weight: 500; margin: 0; margin-bottom: 8px; ">This e-mail message may contain confidential, proprietary or legally privileged information. It should not be used by anyone who is not the original intended recipient. If you have erroneously received this message, please delete it immediately and notify the sender.</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </body>
                                </html>
EOD;
                                $tcpdf->writeHTML($html);

                                $filename = 'booking-inv-'.$purchase_no.'.pdf';
                                $filepath = base_url().'uploads/invoices/'.$filename;
                                $fullname = ABS_PATH.'uploads/invoices/'.$filename;

                                $tcpdf->Output($fullname, 'F'); 
                                echo "string"; die;
                                //$data = ['statuscode' => '200', 'status' => 'success', 'data' => $insert_data];
                            } 
                            else 
                            {
                                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User Not Found!'];
                            }   
                        }  
                        else
                        {
                            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Booking Not Found!'];
                        }  
                    }  
                    else 
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Something Wrong!'];
                    }
                }
                else 
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
                }    
            }
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Params Missing.'];
            }    
        }
        catch(Exception $e)
        {
            $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
        }    
        $this->response($data);
    }

    public function service_booking_list_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData   = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id        = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
            } 
            else 
            {
                $jsonData       = file_get_contents('php://input');
                $postData       = json_decode($jsonData, true);

                $user_id        = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
            }

            if($user_id != '')
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    $params = array('user_id'=>$user_id);
                    $all_service_bookings = $this->am->getServiceBookingsData($params, $many = TRUE);

                    if(!empty($all_service_bookings))
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'data' => $all_service_bookings];
                    }   
                    else
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No Service Booking found.'];
                    }
                }
                else
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
                }    
            }    
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Params Missing.'];
            }    
        }
        catch(Exception $e)
        {
            $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
        }    
        $this->response($data);
    }

    public function package_list_api_post()
    {
        $all_packages = $this->am->getPackageData(array('status'=> '1'),TRUE);

        if(!empty($all_packages))
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'data' => $all_packages];
        }   
        else
        {
            $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No Service found.'];
        } 
        $this->response($data); 
    }

    public function purchase_subscription_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData   = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id            = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
                $package_id         = xss_clean((isset($postData['package_id'])) ? $postData['package_id'] : '');
                $amount             = xss_clean((isset($postData['amount'])) ? $postData['amount'] : '');
                $transaction_id     = xss_clean((isset($postData['transaction_id'])) ? $postData['transaction_id'] : '');
            } 
            else 
            {
                $jsonData           = file_get_contents('php://input');
                $postData           = json_decode($jsonData, true);

                $user_id            = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
                $package_id         = xss_clean((isset($postData['package_id'])) ? $postData['package_id'] : '');
                $amount             = xss_clean((isset($postData['amount'])) ? $postData['amount'] : '');
                $transaction_id     = xss_clean((isset($postData['transaction_id'])) ? $postData['transaction_id'] : '');
            }

            if($user_id != '' && $package_id != '' && $amount != '' && $transaction_id != '')
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    $package_details    = $this->am->getPackageData(array('id'=> $package_id),false);
                    $today              = date('Y-m-d');

                    if(strtolower($package_details->package_duration) == 'monthly')
                    {
                        $end_date               = date('Y-m-d', strtotime($today. ' + 30 days'));
                    }   
                    elseif (strtolower($package_details->package_duration) == 'quaterly') 
                    {
                        $end_date               = date('Y-m-d', strtotime($today. ' + 90 days'));
                    } 
                    elseif(strtolower($package_details->package_duration) == 'yearly')
                    {
                        $end_date               = date('Y-m-d', strtotime($today. ' + 365 days')); 
                    } 

                    $receipt_no             = 'SB-'.date('d-m-Y-H-i-s').rand(10000,99999);
                    $subcription_start_date = date('Y-m-d H:i:s');
                    $subcription_end_date   = $end_date.' 23:59:59'; 

                    $insert_data = array(
                                            'receipt_no'                => $receipt_no,
                                            'user_id'                   => $user_id,
                                            'package_id'                => $package_id,
                                            'subcription_start_date'    => $subcription_start_date,
                                            'subcription_end_date'      => $subcription_end_date,
                                            'amount'                    => $amount,
                                            'payment_status'            => '1',
                                            'transaction_id'            => $transaction_id,
                                            'created_date'              => $subcription_start_date,
                                            'status'                    => '1'
                                        );  

                    $addPurchaseSubscription = $this->am->addPurchaseSubscription($insert_data);

                    if(!empty($addPurchaseSubscription))
                    {
                        $chkdata        = array('user_id'  => $user_id);
                        $upd_userdata   = array('is_subscribed'  => '1');
                        $upduser        = $this->am->updateUser($upd_userdata, $chkdata);

                        // SMS & Email Code

                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Subcription Compleated.', 'data' => $insert_data];
                        
                    }   
                    else
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Something Wrong'];
                    }
                }
                else 
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
                }    
            }   
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Parameter Missing!!!'];
            } 
        }
        catch(Exception $e)
        {
            $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
        }    
        $this->response($data);
    }

    public function my_subscribtion_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData   = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id        = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
            } 
            else 
            {
                $jsonData       = file_get_contents('php://input');
                $postData       = json_decode($jsonData, true);

                $user_id        = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
            }

            if($user_id != '')
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    $params = array('user_id'=>$user_id);
                    $subscribtion_details = $this->am->getMySubscribtionData($user_id);

                    if(!empty($subscribtion_details))
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'data' => $subscribtion_details];
                    }   
                    else
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'No Subscribtion found.'];
                    } 
                }
                else 
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
                }    
            }
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Params Missing.'];
            }
        }
        catch(Exception $e)
        {
            $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
        }    
        $this->response($data);
    }

    public function logout_api_post()
    {
        $headerToken    = $this->input->get_request_header('Authorization');
        $splitToken     = explode(' ', $headerToken);

        try
        {
            $postData   = $this->input->post();

            if (isset($postData) && !empty($postData)) 
            {
                $user_id        = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
            } 
            else 
            {
                $jsonData       = file_get_contents('php://input');
                $postData       = json_decode($jsonData, true);

                $user_id        = xss_clean((isset($postData['user_id'])) ? $postData['user_id'] : '');
            }

            if($user_id != '')
            {
                $user_count   = $this->verifyAuthToken($splitToken[1],$user_id);

                if($user_count)
                {
                    $last_logout_time   = date('Y-m-d H:i:s');
                    $token              = NULL;

                    $param              = array('user_id'=>$user_id);
                    $update_data        = array('last_logout_time'=>$last_logout_time,'token'=>$token); 

                    $upDuser            = $this->am->updateUser($update_data, $param);

                    if($upDuser)
                    {
                        $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'User Data Updated Successfully', 'data' =>$update_data ];
                    } 
                    else
                    {
                        $data = ['statuscode' => '404', 'status' => 'error', 'message' => 'Update Failed!'];
                    }
                }
                else 
                {
                    $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
                }    
            }
            else 
            {
                $data = ['statuscode' => '200', 'status' => 'success', 'message' => 'Some Params Missing.'];
            }
        }
        catch(Exception $e)
        {
            $data   =   ['statuscode' => '404', 'status' => 'error', 'message' => 'Invalid Token Provided.'];
        }    
        $this->response($data);
    }
}
?>