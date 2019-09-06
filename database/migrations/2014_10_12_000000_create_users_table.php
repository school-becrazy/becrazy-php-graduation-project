<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * ユーザーテーブル
     * 管理ユーザーを管理するためのテーブル
     * メールアドレスとパスワードで認証を行う
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
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
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
