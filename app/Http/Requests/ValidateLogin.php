<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ValidateLogin extends Request
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'uname'=>'required',
        	'password'=>'required'
        ];
    }
    
    public function messages(){
    	return [
    			'uname.required'=>'账号不能为空',
    			'password.required'=>'密码不能为空!',

    	];
    }
}
