<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
	use SoftDeletes;
    protected $table = 'blog_comment';

    public function blog(){
    	return $this->belongsTo("App\Laravel\Models\Blog",'blog_id','id');
    }
}
