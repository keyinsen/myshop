<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserValidate extends Request
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
			'pwd'=>'required',
            'password'=>'required|regex:/^[A-Za-z0-9_]{6,17}$/|confirmed',
        ];
    }
    
    public function messages(){
    	return [
    			'pwd.required'=>'原始密码不能为空!',
    			'password.required'=>'新密码不能为空!',
    			'password.regex'=>'新密码长度只能是6位到16位之间,只能包含数字、字母和下划线',
    			'password.confirmed'=>'新密码与重复新密码不一致!',
    	];
    }
}

