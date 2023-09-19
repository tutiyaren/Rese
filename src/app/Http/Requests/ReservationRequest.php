<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'time' => 'required',
            'number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'time.required' => '※時間を入力してください',
            'number.required' => '※人数を入力してください',
        ];
    }
}
