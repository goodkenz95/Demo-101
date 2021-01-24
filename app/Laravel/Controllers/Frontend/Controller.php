<?php

namespace App\Laravel\Controllers\Frontend;

use App\Laravel\Controllers\Controller as BaseController;

use Carbon, Route, Request,Str;

class Controller extends BaseController{

	protected $data;

	public function __construct(){

	}

	public function get_data(){
		$this->data['page_title'] = env("SITE_NAME","Laravel Demo");
		return $this->data;
	}

}