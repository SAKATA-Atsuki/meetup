<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id')->comment('スレッドID');
            $table->integer('freshman_id')->nullable($value = true)->comment('新入生ID');
            $table->integer('circle_id')->comment('サークルID');
            $table->string('title', 255)->comment('スレッドタイトル');
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
        Schema::dropIfExists('threads');
    }
}
