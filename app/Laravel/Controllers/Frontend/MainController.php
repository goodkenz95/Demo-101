<?php

namespace App\Laravel\Controllers\Frontend;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;

class MainController extends Controller{

	protected $data = [];

	public function __construct(){
		parent::__construct();
		array_merge($this->data, parent::get_data());
	}

	public function index(){
		$this->data['page_title'] .= " - Dashboard";
		return view('frontend.index',$this->data);
	}

}