<?php 

namespace App\Laravel\Transformers;

use App\Laravel\Models\{Blog,BlogComment};
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;

use Str;
class BlogTransformer extends TransformerAbstract{

	protected $availableIncludes = [
		'comments','last_comment'
    ];


	public function transform(Blog $blog) {

	    return [
	     	'id' => $blog->id,
	     	'blog_id' => $blog->id,
	     	'blog_name' => $blog->title,
	     	'content' => $blog->content,
	     	'another_field' => "Content created from transformer",
	     	'slug' => "api/blog/".Str::slug("{$blog->id} {$blog->title}")
	     ];
	}

	public function includeComments(Blog $blog){
		return $this->collection($blog->comments, new BlogCommentTransformer);

	}

	public function includeLastComment(Blog $blog){
		$last_comment = BlogComment::where('blog_id',$blog->id)->orderBy('created_at',"DESC")->first();
		if(!$last_comment) {
			$last_comment =  new BlogComment;
			$last_comment->id = 0;
		}

		return $this->item($last_comment, new BlogCommentTransformer);

	}
}