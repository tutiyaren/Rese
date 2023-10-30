# Rese
ある企業のグループ会社の飲食店予約サービス
![スクリーンショット (86)](https://github.com/tutiyaren/Rese/assets/126432220/eb0e59f5-4b3c-4bf5-be54-2af8a8c5e41d)


## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## アプリケーションURL


## 機能一覧
会員登録、ログイン機能、ログアウト、ユーザー情報取得、ユーザー飲食店お気に入り一覧取得、ユーザー飲食店予約情報取得、飲食店一覧取得、飲食店詳細取得、飲食店お気に入り追加、飲食店お気に入り削除、飲食店予約情報追加、飲食店予約情報削除、飲食店予約変更、エリアで検索する、ジャンルで検索する、店名で検索する、レビュー送信、管理者からユーザーにお知らせメール送信、QRコードで予約照合、Stripe決済

## 使用技術（実行環境）
PHP: 8.2
Laravel: 8.x
Node.js: v18

## テーブル設計
![スクリーンショット (87)](https://github.com/tutiyaren/Rese/assets/126432220/0c751946-dd42-47da-8c80-f50232043654)
![スクリーンショット (88)](https://github.com/tutiyaren/Rese/assets/126432220/560fe51d-e475-465a-9ffa-c5e716c44eb7)

## ER図
![スクリーンショット (85)](https://github.com/tutiyaren/Rese/assets/126432220/ea88d4f2-2f64-4e23-bd49-3ae290472c4d)

## 使い方
未ログイン状態
　  飲食店一覧ページと飲食店の検索、飲食店詳細ページを表示できます。
Userログイン状態
　  飲食店一覧ページでお気に入り登録、飲食店詳細ページでお店の予約、マイページでUserごとの予約一覧、予約変更、予約削除、レビューぺージ、QRCodeで予約の照合、Stripe決済、Userごとのお気に入り店舗表示
Representativeログイン状態
　  店舗代表者の飲食店一覧表示と、それぞれのお店の店舗情報更新・予約一覧、新しい店舗情報作成
Adminログイン状態
    店舗代表者の作成、Userへのお知らせメール送信

## 注意事項
- Stripe決済のビューで500エラーがでております。（ローカルでは表示できます）
- キャッシュの問題等で404、500エラー等出る場合があります。その際はEC2にログイン後管理者権限で「php artisan ~:clear、~:cache」を実行すると解決できる可能性があります。

## 環境構築
- docker-compose.yml
![スクリーンショット (89)](https://github.com/tutiyaren/Rese/assets/126432220/d6664349-6ecc-48db-a273-e81d44744b9b)
- Dockerfile
![スクリーンショット (91)](https://github.com/tutiyaren/Rese/assets/126432220/b05964f5-7fea-47ce-9c19-82d73ef16d3e)

- Fortifyインストール
$ composer require laravel/fortify
$ php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

- LaravelMixセットアップ
$ npm install
JavaScriptを使用したが次回動かした際にうまく起動しない場合、JavaScriptのコードを書いたら下記コマンドを実行
開発変更後js ローカル　→　$ docker-compose exec php npm run dev
デプロイ前js　→　$ docker-compose exec php npm run production

- QRCodeインストール
$ composer require simplesoftwareio/simple-qrcode

- AWSへのデプロイの参考記事
[S3](https://qiita.com/kouki_o9/items/dcc40b30924fd3b30787)
[EC2 RDS](https://zenn.dev/funayamateppei/articles/d3ee340a2dc7c1)



