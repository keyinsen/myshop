<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ValidateRegister extends Request
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
				'uname'=>'required|regex:/^[A-Za-z0-9_]{6,17}$/',
				'password'=>'required|regex:/^[A-Za-z0-9_]{6,17}$/|confirmed',
        ];
    }
    public  function messages(){
    	return [
    			'uname.required'=>'用户名不能为空',
     			'uname.regex'=>'用户名长度只能是6位到16位之间,只能包含数字、字母和下划线',
     			'password.required'=>'密码不能为空!',
    			'password.regex'=>'密码长度只能是6位到16位之间,只能包含数字、字母和下划线',
    			'password.confirmed'=>'确认密码与密码不一致!',
    	];
    }
}
