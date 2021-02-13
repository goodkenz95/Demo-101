<?php

namespace App\Laravel\Controllers\Api;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Api\BlogRequest;

use App\Laravel\Models\Blog;
use App\Laravel\Transformers\{TransformerManager,BlogTransformer};

class BlogController extends Controller{

	protected $response = [];
	protected $response_code;


	public function __construct(){
		$this->response = array(
			"msg" => "Bad Request.",
			"status" => FALSE,
			'status_code' => "BAD_REQUEST"
			);
		$this->response_code = 400;
		$this->transformer = new TransformerManager;
	}

	public function index(PageRequest $request){
		$blogs = Blog::orderBy('created_at',"DESC")->paginate(5);
		$this->response['status'] = TRUE;
		$this->response['status_code'] = "BLOG_LIST";
		$this->response['msg'] = "List of Blogs";
		$this->response['total'] = $blogs->total();
		$this->response['current_page'] = $blogs->currentPage();
		$this->response['last_page'] = $blogs->lastPage();
	    $this->response['has_morepages'] = $blogs->hasMorePages();
		$this->response['data'] = $this->transformer->transform($blogs,new BlogTransformer,'collection');

		$this->response_code = 200;
		return response()->json($this->response, $this->response_code);
	}

	public function show(PageRequest $request,$id = NULL){
		$blog = Blog::find($id);

		if(!$blog){
			$this->response['status'] = FALSE;
			$this->response['status_code'] = "NOT_FOUND";
			$this->response['msg'] = "Blog not found.";
			$this->response_code = 404;
			goto callback;

		}


		$this->response['status_code'] = "BLOG_DETAILS";
		$this->response['msg'] = "Blog details.";
		$this->response['data'] = $this->transformer->transform($blog,new BlogTransformer,'item');
		$this->response_code = 200;

		callback:
		return response()->json($this->response, $this->response_code);
	}

	public function store(BlogRequest $request){
		$blog = new Blog;
		$blog->title = $request->input('title');
		$blog->content = $request->input('content');
		$blog->save();

		$this->response['status'] = TRUE;
		$this->response['status_code'] = "BLOG_CREATED";
		$this->response['msg'] = "Blog created.";
		$this->response['data'] = $this->transformer->transform($blog,new BlogTransformer,'item');

		$this->response_code = 201;
		return response()->json($this->response, $this->response_code);
	}

	public function update(BlogRequest $request,$id = NULL){
		$blog = Blog::find($id);

		if(!$blog){
			$this->response['status'] = FALSE;
			$this->response['status_code'] = "NOT_FOUND";
			$this->response['msg'] = "Blog not found.";
			$this->response_code = 404;
			goto callback;
		}

		$blog->title = $request->input('title');
		$blog->content = $request->input('content');
		$blog->save();

		$this->response['status_code'] = "BLOG_MODIFIED";
		$this->response['msg'] = "Blog modified.";
		$this->response['data'] = $this->transformer->transform($blog,new BlogTransformer,'item');
		$this->response_code = 200;

		callback:
		return response()->json($this->response, $this->response_code);
	}

	public function destroy(PageRequest $request, $id = NULL){
		$blog = Blog::find($id);

		if(!$blog){
			$this->response['status'] = FALSE;
			$this->response['status_code'] = "NOT_FOUND";
			$this->response['msg'] = "Blog not found.";
			$this->response_code = 404;
			goto callback;
		}

		$blog->delete();

		$this->response['status_code'] = "BLOG_DELETED";
		$this->response['msg'] = "Blog deleted.";
		$this->response_code = 202;

		callback:
		return response()->json($this->response, $this->response_code);
	}

}