<?php 

namespace App\Laravel\Transformers;

use App\Laravel\Models\{BlogComment,Blog};
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use App\Laravel\Transformers\BlogTransformer;

use Str;
class BlogCommentTransformer extends TransformerAbstract{

	protected $availableIncludes = [
		'blog'
    ];


	public function transform(BlogComment $comment) {

		$x = 2;
		$y = 6;
		$result = "No x";

		if($x > $y){
			$result = "yes X";
		}

	    return [
	     	'id' => $comment->id,
	     	'blog_id' => $comment->blog_id,
	     	'comment' => $comment->comment,
	     	'total_comments' => 1203+50,
	     	'result' => $result,
	     	'created_at' => $comment->created_at ? $comment->created_at->format("F d, Y h:i A") : "-"
	     ];
	}

	public function includeBlog(BlogComment $comment){

		$blog =$comment->blog;
		if(!$blog){
			$blog = new Blog;
			$blog->id = 0;
		}
		return $this->item($blog, new BlogTransformer);

	}
}