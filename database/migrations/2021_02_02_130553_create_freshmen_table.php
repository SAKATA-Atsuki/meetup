<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreshmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freshmen', function (Blueprint $table) {
            $table->increments('id')->comment('新入生ID');
            $table->integer('campus_id')->comment('キャンパスID');
            $table->string('name_sei', 255)->comment('氏名（姓）');
            $table->string('name_mei', 255)->comment('氏名（名）');
            $table->string('nickname', 255)->comment('ニックネーム');
            $table->integer('gender')->comment('性別（1=男性、2=女性）');
            $table->string('email', 255)->comment('メールアドレス');
            $table->string('password', 255)->comment('パスワード');
            $table->text('introduction')->comment('自己紹介');
            $table->integer('auth_code')->nullable($value = true)->comment('認証コード');
            $table->timestamp('created_at')->nullable($value = true)->comment('登録日時');
            $table->timestamp('updated_at')->nullable($value = true)->comment('編集日時');
            $table->softDeletes()->comment('削除日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freshmen');
    }
}
