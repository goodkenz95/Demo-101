<?php namespace App\Laravel\Requests\Frontend;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class BlogRequest extends RequestManager{

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