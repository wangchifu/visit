<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorDataRequest extends FormRequest
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
            'about'=>'required|string',
            'address'=>'required|string',
            'name'=>'required|string',
            'telephone_number'=>'required|string',
            'email'=>'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'about'=>'單位簡介',
            'address'=>'地址',
            'name'=>'聯絡人',
            'telephone_number'=>'聯絡電話',
            'email'=>'電子信箱',
        ];
    }
}
