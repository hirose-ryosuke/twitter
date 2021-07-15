<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagePathTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image_path')->default("default_image.png");  //カラム追加
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
+           $table->dropColumn('image_path');  //カラムの削除
        });
    }
}
