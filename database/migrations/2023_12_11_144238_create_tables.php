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
            $table->id('id');
            $table->string('name', 100);
            $table->timestamps();

            $table->unique(['id']);
        });

        Schema::create('prefectures', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 100);
            $table->unsignedBigInteger('local_name_id')->nullable();
            $table->timestamps();

            $table
                ->foreign('local_name_id')
                ->references('id')
                ->on('local_names')
                ->onDelete('set null');

            $table->unique(['id']);
        });

        Schema::create('boards', function (Blueprint $table) {
            $table->id('id');
            $table->tinyText('title');
            $table->string('name', 100);
            $table->text('comment');
            $table->string('email', 100);
            $table->unsignedBigInteger('prefecture_id')->nullable();
            $table->timestamps();

            $table
                ->foreign('prefecture_id')
                ->references('id')
                ->on('prefectures')
                ->onDelete('set null');

            $table->unique(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET foreign_key_checks = 0');
        Schema::dropIfExists('boards');
        Schema::dropIfExists('prefectures');
        Schema::dropIfExists('local_names');
        DB::statement('SET foreign_key_checks = 1');
    }
};
