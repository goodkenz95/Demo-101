<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
	use SoftDeletes;
    protected $table = 'blog';

    public function comments(){
    	return $this->hasMany("App\Laravel\Models\BlogComment",'blog_id','id');
    }
}
