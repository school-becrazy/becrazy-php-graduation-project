<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * ユーザーテーブル作成
     * 管理ユーザーを管理するためのテーブル
     * メールアドレスとパスワードで認証を行う
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // 文字コードと照合順序の設定
            // emojiを含むmb4と大文字小文字も区別するbinで設定
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_bin';

            // 主キー
            $table->bigIncrements('id');

            // ユーザー名前
            $table->string('name');

            // メールアドレス(ログインID)
            $table->string('email')->unique();

            // メールアドレス確認日時(使用しない)
            $table->timestamp('email_verified_at')->nullable();

            // パスワードハッシュ
            $table->string('password');

            // remember meトークン(ログイン継続用)
            $table->rememberToken();

            // created_at, updated_at
            $table->timestamps();

            // 論理削除用カラム
            // https://readouble.com/laravel/5.8/ja/eloquent.html#soft-deleting
            $table->softDeletes();
        });
    }

    /**
     * テーブル削除
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
