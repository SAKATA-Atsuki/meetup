<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircleSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circle_subcategories', function (Blueprint $table) {
            $table->increments('id')->comment('サークルサブカテゴリID');
            $table->integer('circle_category_id')->comment('サークルカテゴリID（1=体育系、2=文化系）');
            $table->string('name', 255)->comment('サークルサブカテゴリ名');
            $table->timestamp('created_at')->nullable($value = true)->comment('登録日時');
            $table->timestamp('updated_at')->nullable($value = true)->comment('更新日時');
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
        Schema::dropIfExists('circle_subcategories');
    }
}
