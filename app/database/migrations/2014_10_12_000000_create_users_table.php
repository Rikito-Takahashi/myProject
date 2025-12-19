<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
        $table->bigIncrements('id'); // 登録ユーザーID( AUTO_INCREMENT)
        $table->string('name', 20);
        $table->string('email', 30)->unique(); // メールアドレス（UNIQUE/重複NG）
        $table->string('password', 100); // パスワード(ハッシュ化)
        $table->string('icon_img', 300)->nullable(); // アイコン画像（任意）
        $table->string('header_img', 300)->nullable(); // ヘッダー画像（任意）
        $table->string('profile', 300)->nullable(); // プロフィール文（任意）
        $table->tinyInteger('role')->default(1); // ユーザータイプ(管理者=0、一般ユーザー=1)
        $table->tinyInteger('del_flag')->default(0); // 論理削除用(論理削除時＝1)
        $table->timestamps(); // created_atカラム, updated_atカラムをこの一文で作成
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
