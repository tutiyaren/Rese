<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '1',
            'shop_id' => '1',
            'rating' => '1',
            'comment' => '老舗の雰囲気にひかれて訪問しましたが、落胆の一言です。まず店内に入るや否や悪臭が鼻につき、コバエがいたるところで飛んでいました。女将さんの人柄は悪くなく、食材に関しての知識もお有りのようです。店の衛生状態を鑑みると失格と言わざるを得ません。',
            'image' => 'sushi.png'
        ];
        DB::table('voices')->insert($param);
        $param = [
            'user_id' => '2',
            'shop_id' => '1',
            'rating' => '3',
            'comment' => 'ランチで行きました。ネタは小さいですが、回転寿司並みの価格で、ちゃんとしたお寿司が食べられます。提供も早く、アットホームな雰囲気も味わえます。',
            'image' => 'sushi.png'
        ];
        DB::table('voices')->insert($param);
        $param = [
            'user_id' => '2',
            'shop_id' => '2',
            'rating' => '2',
            'comment' => '肉は美味しいが、焼肉はタレが重要だと気づかされた店',
            'image' => 'yakiniku.png'
        ];
        DB::table('voices')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '1',
            'rating' => '5',
            'comment' => '今までに食した事の無いおいしい貴重な経験をさせて頂きます。また是非、おじゃましたいです。本当にご馳走様でした。',
            'image' => 'sushi.png'
        ];
        DB::table('voices')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '2',
            'rating' => '4',
            'comment' => 'こういう焼き方があるのかと衝撃を受けたお店。同じ食材でも、全く違うホルモンになるんじゃないかと思うほどおいしく調理できる。立地のわりにリーズナブルに食べられる。唯一のマイナスは少々煙いところ。',
            'image' => 'yakiniku.png'
        ];
        DB::table('voices')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '3',
            'rating' => '1',
            'comment' => '他の店が混み合っていて、ガラガラだったので入店しました。店員さんはずっとスマホいじっているし、頼んだアルコール忘れられるし、料理もいまいち…。もう二度と利用しないかな',
            'image' => 'izakaya.png'
        ];
        DB::table('voices')->insert($param);
        $param = [
            'user_id' => '4',
            'shop_id' => '1',
            'rating' => '5',
            'comment' => '最高においしかったです。',
            'image' => 'sushi.png'
        ];
        DB::table('voices')->insert($param);
    }
}
