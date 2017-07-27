<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FileValidate extends Request
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
            'imgpath'=>'mimes:jpeg,bmp,png,gif,svg,jpg',
        ];
    }
    
    public function messages()
    {
    	return [
    		'imgpath.mimes'=>'必须是图片的格式！'
    	];
    }
}
