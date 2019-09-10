<?php

use Illuminate\Database\Seeder;

class BlogOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ブログオプション用Seeder
     * 必ず必要そうな事前情報だけ挿入しておく
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('blog_options');

        // シードデータの配列
        $seed_data = [
            // インストール済みかどうか
            // インストール後に1に変更する
            [
                'key_name' => 'isInstalled',
                'option_value' => '0'
            ],
            // メタタグで記述するトップページ用の説明文
            [
                'key_name' => 'indexPageMetaDescription',
                'option_value' => 'トップページのmetaタグにおけるdescription属性値'
            ]
        ];

        foreach($seed_data as $value) {
            $table->insert($value);
        }
    }
}
