<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Calcutta");
	}

}

