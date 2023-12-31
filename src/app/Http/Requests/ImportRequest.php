<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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
            'csv_file' => 'required|file|mimes:csv',
        ];
    }

    public function messages()
    {
        return [
            'csv_file.required' => 'CSVファイルは必須項目です',
            'csv_file.mimes' => 'CSVファイルは拡張子がcsvである必要があります',
        ];
    }
}
