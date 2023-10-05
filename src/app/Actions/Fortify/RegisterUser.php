<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rules;

class RegisterUser implements CreatesNewUsers
{
    /**
     * ユーザーを作成し、保存します。
     *
     * @param  array  $input
     * @return mixed
     */
    public function create(array $input)
    {
        // バリデーションルール
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ], [
            'name.required' => '名前は必須です。',
            'name.string' => '名前は文字列で入力してください',
            'name.max' => '名前は最大255字までです',
            'email.required' => 'メールアドレスは必須です。',
            'email.string' => 'メールアドレスは文字列で入力してください',
            'email.email' => '有効なメールアドレスを入力してください',
            'email.max' => 'メールアドレスは最大255字までです',
            'email.unique' => 'このメールアドレスはすでに使用されています',
            'password.required' => 'パスワードは必須項目です',
            'password.string' => 'パスワードは文字列で入力してください',
            'password.min' => 'パスワードは少なくとも8文字必要です。',
            'password.max' => 'パスワードは255字以内で入力してください',
            'password.confirmed' => 'パスワードと確認用のパスワードが一致しません。',
        ]);

        // ユーザーを作成して保存する
        $user = new \App\Models\User;
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->save();

        return $user;
    }
}
