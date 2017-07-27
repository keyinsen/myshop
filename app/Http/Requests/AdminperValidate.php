<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminperValidate extends Request
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
            'nickname'=>'regex:/[^.~!@#$%\^<>(),=+&*-]{3,8}/'
        ];
    }
    
    public function messages(){
    	return [
    			'nickname.regex'=>'昵称不能有特殊字符,且长度在3到8位'
    	];
    }
}
