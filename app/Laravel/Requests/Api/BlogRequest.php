<?php namespace App\Laravel\Requests\Api;

use Session,Auth;
use App\Laravel\Requests\ApiRequestManager;

class BlogRequest extends ApiRequestManager{

	public function rules(){

		$blog_id = $this->route('id')?:0;
		$rules = [
			'title' => "required|min:10|unique:blog,title,{blog_id}",
			'content' => "required|min:100"
		];

		return $rules;
	}

	public function messages(){
		return [
			'required'	=> "Field is required.",
			'title.min' => "Blog title is too short.",
			'title.unique_blog' => "Blog already exists.",
		];
	}
}