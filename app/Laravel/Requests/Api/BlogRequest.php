<?php namespace App\Laravel\Requests\Api;

use Session,Auth;
use App\Laravel\Requests\ApiRequestManager;

class BlogRequest extends ApiRequestManager{

	public function rules(){

		$rules = [
			'title' => "required|min:10",
			'content' => "required|min:100"
		];

		return $rules;
	}

	public function messages(){
		return [
			'required'	=> "Field is required.",
			'title.min' => "Blog title is too short."
		];
	}
}