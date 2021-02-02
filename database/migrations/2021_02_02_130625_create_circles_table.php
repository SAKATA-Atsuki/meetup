<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCirclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circles', function (Blueprint $table) {
            $table->increments('id')->comment('サークルID');
            $table->integer('campus_id')->comment('キャンパスID');
            $table->integer('circle_category_id')->comment('サークルカテゴリID（1=体育系、2=文化系）');
            $table->integer('circle_subcategory_id')->comment('サークルサブカテゴリID');
            $table->string('name', 255)->comment('サークル名');
            $table->string('email', 255)->comment('メールアドレス');
            $table->string('password', 255)->comment('パスワード');
            $table->text('introduction')->comment('サークル紹介');
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
        Schema::dropIfExists('circles');
    }
}
