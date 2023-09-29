<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\CreatesNewAdmins;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateNewAdmin implements CreatesNewAdmins
{
    /**
     * Validate and create a newly registered admin user.
     *
     * @param  array  $input
     * @return \App\Models\Admin
     */
    public function create(array $input)
    {
        // バリデーションルールを定義
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('admins'),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // バリデーションに失敗した場合は例外をスロー
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        // 新しい管理者ユーザーを作成して保存
        return Admin::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
