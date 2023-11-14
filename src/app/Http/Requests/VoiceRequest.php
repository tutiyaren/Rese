<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoiceRequest extends FormRequest
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
            'rating' => 'required',
            'comment' => 'nullable|string|max:400',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '※５段階評価（星マーク）を入力してください',
            'comment.string' => '※口コミは文字列で入力してください',
            'comment.max' => '※口コミは400文字以内で入力してください',
            'image.image' => '※画像ファイルである必要があります。',
            'image.mimes' => '※.jpegもしくは.pngにしてください',
            'image.max' => '※2048KB以下である必要があります'
        ];
    }
}
