<?php

namespace App\Laravel\Middlewares\Api;

use Closure,Str;
use App\Laravel\Models\{Blog};


class ExistRecord
{

    protected $format;
    protected $reference_id;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $model
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        $this->format = $request->format;
        $response = array();

        switch (strtolower($model)) {
            case 'blog':
                $this->reference_id = $request->route('id');
                if(! $this->__exist_blog($request)) {
                    $response = [
                        'msg' => "Blog not found.",
                        'status' => FALSE,
                        'status_code' => "RECORD_NOT_FOUND",
                        'hint' => "Make sure the blog 'id' from your route parameter exists and valid."
                    ];
                }
            break;
        }

        if(empty($response)) {
            return $next($request);
        }

        return response()->json($response, 406);

    }

    private function __exist_blog($request){
        $blog = Blog::find($this->reference_id);
        if($blog){
            $request->merge(['blog_data' => $blog]);
            return TRUE;
        }

        return FALSE; 
    }
}