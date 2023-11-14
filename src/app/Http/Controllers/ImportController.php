<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Requests\ImportRequest;
use Illuminate\Support\Facades\Validator;

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
                // データベースに保存
                Shop::create([
                    'representative_id' => $storeData['店舗代表者ID'],
                    'shop' => $storeData['店舗名'],
                    'area' => $storeData['地域'],
                    'genre' => $storeData['ジャンル'],
                    'content' => $storeData['店舗概要'],
                    'image' => $storeData['画像URL'],
                ]);
            }
        }
        return redirect()->back()->with('success', 'CSVファイルが正常にインポートされて店舗情報が追加されました');
    }
}
