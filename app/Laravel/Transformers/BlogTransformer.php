<?php 

namespace App\Laravel\Transformers;

use App\Laravel\Models\Blog;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;

class BlogTransformer extends TransformerAbstract{

	protected $availableIncludes = [
    ];


	public function transform(Blog $blog) {

	    return [
	     	'id' => $blog->id,
	     	'title' => $blog->title,
	     	'content' => $blog->content,
	     ];
	}
}