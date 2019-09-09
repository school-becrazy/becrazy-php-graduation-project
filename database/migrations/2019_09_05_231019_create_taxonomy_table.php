<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     * タクソノミーテーブル作成
     * カテゴリーやタグを保存するテーブルとなる。
     * taxonomy_relationshipsテーブル(中間テーブル)でpostsテーブルとの紐付けを行う
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomy', function (Blueprint $table) {
            // 文字コードと照合順序の設定
            // emojiを含むmb4と大文字小文字も区別するbinで設定
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_bin';

            // 主キー
            $table->bigIncrements('id');

            // 分類タイプ
            // category: カテゴリー
            // tag: タグ
            $table->string('type', 32)->nullable(false);

            // 分類名
            // カテゴリー名やタグ名
            $table->string('name')->nullable(false);

            // 分類スラッグ
            // カテゴリーページやタグページのURLの一部になる
            // 例) http://example.com/category/slug
            $table->string('slug', 200)->nullable(false);

            // 分類の説明文
            $table->longText('description');

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
        Schema::dropIfExists('taxonomy');
    }
}
