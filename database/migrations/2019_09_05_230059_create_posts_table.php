<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     * 記事情報格納テーブル作成
     * その他アップロードファイルの情報もレコードとして保存する役割を持たせる
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // 文字コードと照合順序の設定
            // emojiを含むmb4と大文字小文字も区別するbinで設定
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_bin';

            // 主キー
            $table->bigIncrements('id');
            // ユーザーid(外部キー)
            $table->unsignedBigInteger('user_id')->nullable(false);
            // ユーザーidの外部キー指定
            // これでuser_idとusersテーブルのidを紐付けて外部キーとして設定する
            $table->foreign('user_id')->references('id')->on('users');

            // タイトル デフォルトの255文字まで nullを許可しない
            $table->string('title')->nullable(false);

            // 本文
            $table->longText('content')->default('');

            // 投稿状態 nullを許可しない
            // 'publish': 公開済み
            // 'draft': 下書き
            // 2つのどちらかのみを登録する
            $table->string('status', 10)->nullable(false);

            // スラッグ(URLの一部になる文字列) nullを許可しない
            // 記事ごとのURLを決定する
            // 例) http://example.com/article/slug
            $table->string('slug', 100)->nullable(false)->index();

            // 投稿種別 nullを許可しない デフォルト'article'
            // article: 記事
            // page: 固定ページ(ブログ紹介ページや自己紹介ページ等の記事以外)
            $table->string('type', 15)->default('article')->nullable(false);
            // slugカラムとtypeカラムで複合一意キーを設定
            // これで同一URLの記事を作成しないように制限する
            $table->unique(['slug', 'type']);

            // MIME_TYPEの設定
            // 通常の記事の場合は'text/html'
            $table->string('mime_type', 50)->nullable(false);

            // created_at・updated_at
            $table->timestamps();
            // deleted_at(論理削除カラム)
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
        Schema::dropIfExists('posts');
    }
}
