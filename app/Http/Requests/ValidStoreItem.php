<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidStoreItem extends FormRequest
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
            //
            'item_name'  => 'required',
            'price'      => 'required',
            // 'store_id'=> 'required',
            'item_status'=> 'required',
            'file'       => 'required|file|image|',
        ];
    }
    // public function messages(){
    //     return [
    //         'item_name.required'  => '名前を入力してください。',
    //         'price.required'=> '値段を入力してください。',
    //         'item_status.required'     => '販売状況を入力してください。',
    //         'item_image.required'     => '写真をアップロードして下さい。',
    //     ];
    // }
}
