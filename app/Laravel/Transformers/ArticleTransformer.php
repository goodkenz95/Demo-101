<?php 

namespace App\Laravel\Transformers;

use App\Laravel\Models\{Blog,BlogComment};
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;

use Str;
class ArticleTransformer extends TransformerAbstract{

	protected $availableIncludes = [
		'comments','last_comment'
    ];


	public function transform(Blog $article) {

	    return [
	     	'id' => $article->id,
	     	'article_id' => $article->id,
	     	'article_name' => $article->title,
	     	'content' => $article->content,
	     	'another_field' => "Content created from transformer",
	     	'slug' => "api/blog/".Str::slug("{$article->id} {$article->title}"),
	     	'author' => "",
	     	'category' => ""
	     ];
	}

	public function includeComments(Blog $blog){
		return $this->collection($blog->comments, new BlogCommentTransformer);

	}

	public function includeLastComment(Blog $blog){
		$last_comment = BlogComment::where('blog_id',$blog->id)->orderBy('created_at',"DESC")->first();
		return $this->item($last_comment, new BlogCommentTransformer);

	}
}