<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('local_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->timestamps();
        });

        Schema::create('prefectures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->id('local_name_id');
            $table->timestamps();

            $table
            ->foreign('local_name_id')
            ->references('id')
            ->on('local_names')
            ->onDelete('set null');
        });

        Schema::create('boards', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyText('title');
            $table->string('name', 100);
            $table->text('comment');
            $table->string('email', 100);
            $table->id('prefecture_id');
            $table->timestamps();

            $table
            ->foreign('prefecture_id')
            ->references('id')
            ->on('prefectures')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //外部キーを削除したうえでテーブル削除
        Schema::dropIfExists('tables');
    }
};
