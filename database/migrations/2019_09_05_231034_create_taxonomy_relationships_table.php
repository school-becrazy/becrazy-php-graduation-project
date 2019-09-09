<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     * タクソノミー中間テーブル
     * postsテーブルとtaxonomyテーブルを紐付ける中間テーブル
     * これで複数の記事に対して複数のカテゴリーやタグを紐付ける
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomy_relationships', function (Blueprint $table) {
            // 文字コードと照合順序の設定
            // emojiを含むmb4と大文字小文字も区別するbinで設定
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_bin';

            $table->bigIncrements('id');
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
        Schema::dropIfExists('taxonomy_relationships');
    }
}
