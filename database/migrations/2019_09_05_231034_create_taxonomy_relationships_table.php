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

            // タクソノミーid (外部キー)
            $table->unsignedBigInteger('taxonomy_id')->nullable(false);
            // タクソノミーidの外部キー指定
            // これでtaxonomy_idとtaxonomyテーブルのidを紐付けて外部キーとして設定する
            $table->foreign('taxonomy_id')->references('id')->on('taxonomy');

            // 記事id (外部キー)
            $table->unsignedBigInteger('post_id')->nullable(false);
            // 記事idの外部キー指定
            // これでpost_idとtaxonomyテーブルのidを紐付けて外部キーとして設定する
            $table->foreign('post_id')->references('id')->on('posts');

            // タクソノミーページ表示時の表示順番号
            // 対象の記事が追加されていくごとに番号を増やして登録する
            $table->unsignedBigInteger('taxonomy_order')->nullable(false)->default(1);

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
