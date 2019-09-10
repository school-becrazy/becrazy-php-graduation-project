<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ユーザーテーブル用Seeder
     * 初期管理ユーザー情報をテスト用に追加
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('users');

        // シードデータの配列
        $seed_data = [
            // ユーザー名: test-user
            // メールアドレス: test-user@example.com
            // パスワード: password
            [
                'name' => 'test-user',
                'email' => 'test-user@example.com',
                'password' => bcrypt('password'),
            ]
        ];

        foreach ($seed_data as $value) {
            $table->insert($value);
        }
    }
}
