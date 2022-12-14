<?php
defined('BASEPATH') OR exut('No direct script access allowed');

class API_Model extends CI_Model 
{

    public function __construct(){

        parent::__construct();
        $this->load->library('GoogleAuthenticator');

    }
}
?>