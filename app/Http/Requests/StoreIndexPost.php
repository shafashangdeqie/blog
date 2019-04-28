<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndexPost extends FormRequest
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
            'username'=>'required|unique:index|max:30|min:3',
            'age'=>'required|integer',
        ];
    }
    public function messages ()
    {
       return [
            'username.required'=>'用户名不能为空',
             'username.unique'=>'用户名已存在',
             'username.max'=>'用户名长度超过30位',
            'username.min'=>'用户名长度小于3位',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须是数字',
       ];
    }
}
