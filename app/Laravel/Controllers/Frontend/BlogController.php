<?php

namespace App\Laravel\Controllers\Frontend;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Frontend\BlogRequest;

use App\Laravel\Models\Blog;

class BlogController extends Controller{

	protected $data = [];

	public function __construct(){
		parent::__construct();
		array_merge($this->data, parent::get_data());
	}

	public function index(PageRequest $request){
		$this->data['page_title'] .= " - List of Blog";
		$this->data['blogs'] = Blog::orderBy('created_at',"DESC")->get();
		return view('frontend.blog.index',$this->data);
	}

	public function create(PageRequest $request){
		$this->data['page_title'] .= " - New blog";
		return view('frontend.blog.create',$this->data);

	}

	public function store(BlogRequest $request){
		$blog = new Blog;
		$blog->title = $request->input('title');
		$blog->content = $request->input('content');
		$blog->save();
		session()->flash('notification-status', "success");
		session()->flash('notification-msg', "Blog created.");
		return redirect()->route('frontend.blog.index');

	}

	public function edit(PageRequest $request,$id = NULL){
		$blog = Blog::find($id);

		if(!$blog){
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Blog not found.");
			return redirect()->route('frontend.blog.index');
		}
		$this->data['blog'] = $blog;
		$this->data['page_title'] .= " - Update Blog Details";
		return view('frontend.blog.edit',$this->data);

	}

	public function update(BlogRequest $request,$id = NULL){
		$blog = Blog::find($id);

		if(!$blog){
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Blog not found.");
			return redirect()->route('frontend.blog.index');
		}

		$blog->title = $request->input('title');
		$blog->content = $request->input('content');
		$blog->save();

		session()->flash('notification-status', "success");
		session()->flash('notification-msg', "Blog modified.");

		return redirect()->route('frontend.blog.index');

	}

	public function destroy(PageRequest $request, $id = NULL){
		$blog = Blog::find($id);

		if(!$blog){
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Blog not found.");
			return redirect()->route('frontend.blog.index');
		}

		$blog->delete();
		session()->flash('notification-status', "success");
		session()->flash('notification-msg', "Blog deleted.");
		return redirect()->route('frontend.blog.index');
	}

}