<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
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
            'shop' => 'required|string|max:40', 
            'area' => 'required|string|max:40',
            'genre' => 'required|string|max:40',
            'content' => 'string|max:300',
            'image' => 'max:2048', 
        ];
    }

    public function messages()
    {
        return [
            'shop.required' => '店舗名は必須項目です',
            'shop.string' => '店舗名は文字列で入力してください',
            'shop.max' => '店舗名は40文字以内で入力してください',
            'area.required' => 'エリアは必須項目です',
            'area.string' => 'エリアは文字列で入力してください',
            'area.max' => 'エリアは40文字以内で入力してください',
            'genre.required' => 'ジャンルは必須項目です',
            'genre.string' => 'ジャンルは文字列で入力してください',
            'genre.max' => 'ジャンルは40文字以内で入力してください',
            'content.string' => '内容は文字列で入力してください',
            'content.max' => '内容は300文字以内で入力してください',
            'image.max' => '画像のファイルサイズは2MB以内である必要があります',
        ];
    }
}
