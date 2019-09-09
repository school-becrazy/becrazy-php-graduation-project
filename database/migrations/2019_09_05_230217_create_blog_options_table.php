<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogOptionsTable extends Migration
{
    /**
     * Run the migrations.
     * ブログオプションテーブル作成
     * ブログ全体の設定に関わるレコードをkey-value形式で保存する
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_options', function (Blueprint $table) {
            // 文字コードと照合順序の設定
            // emojiを含むmb4と大文字小文字も区別するbinで設定
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_bin';

            // 主キー
            $table->bigIncrements('id');

            // キー名 ユニーク nullを許可しない
            $table->string('key_name')->unique()->nullable(false);

            // 設定値 nullを許可しない
            $table->string('option_value')->nullable(false);

            // 自動読み込み設定
            // 1: 設定値自動読み込み
            // 0: 自動読み込みしない
            // デフォルト 1
            $table->tinyInteger('autoload')->default(1);

            // created_at・updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_options');
    }
}
