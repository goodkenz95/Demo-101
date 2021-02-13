<?php 

namespace App\Laravel\Transformers;

use App\Laravel\Models\BlogComment;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Str;
class BlogCommentTransformer extends TransformerAbstract{

	protected $availableIncludes = [

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
	     	'created_at' => $comment->created_at->format("F d, Y h:i A")
	     ];
	}
}