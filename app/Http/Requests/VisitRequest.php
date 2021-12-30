<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
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
            'visit_name'=>'required|string',
            'about'=>'required|string',
            'tabs.*'=>'required|string',
            'files.*' =>'mimes:jpg,jpeg,png|max:10240',

        ];
    }

    public function attributes()
    {
        $att = [
            'visit_name' => '體驗行程名稱',
            'about' => '課程簡介',
        ];

        for($i=0;$i<20;$i++){
            $j = $i+1;
            $att['tabs.'.$i] = "標籤".$j;
        }
        for($i=0;$i<20;$i++){
            $j = $i+1;
            $att['files.'.$i] = "照片".$j;
        }
        return $att;
    }
}
