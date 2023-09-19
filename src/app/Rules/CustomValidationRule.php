<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;

class CustomValidationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        switch ($attribute) {
            case 'name':
                return is_string($value) && strlen($value) <= 255;
            case 'email':
                return is_string($value) && filter_var($value, FILTER_VALIDATE_EMAIL) && strlen($value) <= 255 && !User::where('email', $value)->exists();
            case 'password':
                
                return is_string($value) && strlen($value) >= 8 && strlen($value) <= 255 && $value === request('password_confirmation');
            default:
                return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
            'name.required' => '名前は必須です。',
            'name.string' => '名前は文字列で入力してください。',
            'name.max' => '名前は最大255文字まで設定できます。',
            'email.required' => 'メールアドレスは必須です。',
            'email.string' => 'メールアドレスは文字列で入力してください。',
            'email.email' => '有効なメールアドレス形式で入力してください。',
            'email.max' => 'メールアドレスは最大255文字まで設定できます。',
            'email.unique' => 'このメールアドレスはすでに使用されています。',
            'password.required' => 'パスワードは必須項目です。',
            'password.string' => 'パスワードは文字列で入力してください。',
            'password.min' => 'パスワードは最小8文字で入力してください。',
            'password.max' => 'パスワードは最大255文字まで設定できます。',
            'password.confirmed' => 'パスワードと確認用のパスワードが一致しません。',
        ];
    }
}
