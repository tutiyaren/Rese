<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Requests\ImportRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Representative;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ImportController extends Controller
{
    public function import(Request $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $header = array_shift($data);

        foreach ($data as $row) {
            $storeData = array_combine($header, $row);

            // データベースに重複がないか確認
            $existingStore = Shop::where('shop', $storeData['店舗名'])->first();

            if (!$existingStore) {
                // バリデーション
                $validator = Validator::make($storeData, [
                    '管理者ID' => 'required',
                    '店舗代表者名前' => 'required|max:255',
                    '店舗代表者メールアドレス' => 'required|email',
                    '今の日時' => '',
                    'パスワード' => 'required|min:8|max:255|',
                    '店舗代表者ID' => 'required',
                    '店舗名' => 'required|max:50',
                    '地域' => 'required|in:東京都,大阪府,福岡県',
                    'ジャンル' => 'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
                    '店舗概要' => 'required|max:400',
                    '画像URL' => 'required',
                ]);

                if ($validator->fails()) {
                    // エラー処理
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                if ($request->hasFile('画像URL')) {
                    // アップロードされた画像ファイルを取得
                    $uploadedImage = $request->file('画像URL');
                    // 画像ファイル名を取得
                    $imageName = $uploadedImage->getClientOriginalName();
                    // 画像を storage/app/public ディレクトリに保存し、ファイル名は '画像URL' から取得
                    $imagePath = $uploadedImage->storeAs('public', $imageName);
                    // 保存した画像のURLを取得
                    $imageUrl = Storage::url($imagePath);
                    // 保存した画像のファイル名のみを取得
                    $savedImageFileName = pathinfo($imageUrl, PATHINFO_BASENAME);
                    // 画像の拡張子を変更（例えば .png に変更）
                    $newImageName = pathinfo($savedImageFileName, PATHINFO_FILENAME) . '.png';
                    Storage::move("public/{$savedImageFileName}", "public/{$newImageName}");
                    // 保存した画像のURLを新しいファイル名で取得
                    $imageUrl = Storage::url("public/{$newImageName}");
                } else {
                    // 画像URLが存在しない場合、CSV から取得
                    $imageUrl = $storeData['画像URL'];
                    // 画像をダウンロードして保存
                    $imageContent = file_get_contents($imageUrl);
                    $imageName = basename($imageUrl);
                    Storage::put("public/{$imageName}", $imageContent);
                    // 保存した画像のURLを取得
                    $imageUrl = Storage::url($imageName);
                    // 保存した画像のファイル名のみを取得
                    $savedImageFileName = pathinfo($imageUrl, PATHINFO_BASENAME);
                    // 画像の拡張子を変更（例えば .png に変更）
                    $newImageName = pathinfo($savedImageFileName, PATHINFO_FILENAME) . '.png';
                    Storage::move("public/{$savedImageFileName}", "public/{$newImageName}");
                    // 保存した画像のURLを新しいファイル名で取得
                    $imageUrl = Storage::url("public/{$newImageName}");
                }

                // 代表者を取得または新しく作成
                $representative = Representative::firstOrNew(
                    [
                        'name' => $storeData['店舗代表者名前'],
                        'email' => $storeData['店舗代表者メールアドレス'],
                    ],
                    [
                        'email_verified_at' => $storeData['今の日時'],
                    ]
                );

                // パスワードのハッシュ化
                $hashedPassword = Hash::make($storeData['パスワード']);

                // ハッシュ化したパスワードを設定
                $representative->password = $hashedPassword;

                $representative->save();

                // データベースに保存
                Shop::create([
                    'representative_id' =>
                    $representative->id,
                    'shop' => $storeData['店舗名'],
                    'area' => $storeData['地域'],
                    'genre' => $storeData['ジャンル'],
                    'content' => $storeData['店舗概要'],
                    'image' => $newImageName,
                ]);
            }
        }
        return redirect()->back()->with('success', 'CSVファイルが正常にインポートされて店舗情報が追加されました');
    }
}
