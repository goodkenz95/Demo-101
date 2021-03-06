<?php 

namespace App\Laravel\Services;

use Illuminate\Validation\Validator;
// use App\Laravel\Models\{IPAddress,Employee,AttendanceOvertime,EmployeeLeaveCredit,AttendanceLeave};
use App\Laravel\Models\{Blog};

use Illuminate\Http\Request;
use Auth, Hash,Str,Carbon;

class CustomValidator extends Validator {
	public function validateUniqueBlog($attribute,$value,$parameters){
	    $id = (is_array($parameters) AND isset($parameters[0]) ) ? $parameters[0] : "0";
	    
	    $blog_title = Str::lower($value);

	    return Blog::whereRaw("LOWER(title) = ?",[$blog_title])
	                    ->where('id','<>',$id)
	                    ->count() ? FALSE : TRUE;
	}
}