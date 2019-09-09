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
        // ユーザー名: test-user
        // メールアドレス: test-user@example.com
        // パスワード: password
        DB::table('users')->insert([
            'name' => 'test-user',
            'email' => 'test-user@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
