<?php

namespace App\Laravel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Str,Log;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function validationData(){
        if(Str::lower($this->method()) == "post"){
            return $this->post();
        }else{
            return $this->all();
        }
    }

    public function rules(){
        return [];
    }


    public function messages(){
        return [
            'integer'  => "Data should be numeric only.",
            'regex' => "Invalid data."
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $format = $this->route('format');
        $_response = [
            'msg' => "Incomplete or invalid input",
            'status' => FALSE,
            'status_code' => "INVALID_DATA",
            'has_requirements' => TRUE,
            'errors' => $validator->errors(),
        ];

        if(strlen($format) > 0){
            switch ($format) {
                case 'json':
                    throw new HttpResponseException(response()->json($_response, 422));
                break;
                case 'xml':
                    throw new HttpResponseException(response()->xml($_response, 422));
                break;
            }
        }

        session()->flash('notification-status','error');
        session()->flash('notification-msg','Some fields are missing or not accepted.');
        throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());

        
    }
}
