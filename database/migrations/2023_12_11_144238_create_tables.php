<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('local_names', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('name', 100);
            $table->timestamps();
        });

        DB::table('local_names')->insert([
            ['id' => 'hokkaido',  'name' => '北海道'],
            ['id' => 'higashinihon', 'name' => '東日本'],
            ['id' => 'kitakanto', 'name' => '北関東'],
            ['id' => 'tokyo', 'name' => '東京'],
            ['id' => 'minamikanto', 'name' => '南関東'],
            ['id' => 'chubu', 'name' => '中部'],
            ['id' => 'kansai', 'name' => '関西'],
            ['id' => 'nishinihon', 'name' => '西日本'],
        ]);

        Schema::create('prefectures', function (Blueprint $table) {
            $table->id('id')->unique();
            $table->string('name');
            $table->string('local_name_id');
            $table->timestamps();

            $table
                ->foreign('local_name_id')
                ->references('id')
                ->on('local_names');
        });

        DB::table('prefectures')->insert([
            ['name' => '北海道', 'local_name_id' => 'hokkaido'],
            ['name' => '青森', 'local_name_id' => 'higashinihon'],
            ['name' => '岩手', 'local_name_id' => 'higashinihon'],
            ['name' => '宮城', 'local_name_id' => 'higashinihon'],
            ['name' => '秋田', 'local_name_id' => 'higashinihon'],
            ['name' => '山形', 'local_name_id' => 'higashinihon'],
            ['name' => '福島', 'local_name_id' => 'higashinihon'],
            ['name' => '茨城', 'local_name_id' => 'kitakanto'],
            ['name' => '栃木', 'local_name_id' => 'kitakanto'],
            ['name' => '群馬', 'local_name_id' => 'kitakanto'],
            ['name' => '埼玉', 'local_name_id' => 'minamikanto'],
            ['name' => '千葉', 'local_name_id' => 'minamikanto'],
            ['name' => '池袋', 'local_name_id' => 'tokyo'],
            ['name' => '新宿', 'local_name_id' => 'tokyo'],
            ['name' => '渋谷品川', 'local_name_id' => 'tokyo'],
            ['name' => '都心', 'local_name_id' => 'tokyo'],
            ['name' => '区東部', 'local_name_id' => 'tokyo'],
            ['name' => '都下', 'local_name_id' => 'tokyo'],
            ['name' => '神奈川', 'local_name_id' => 'minamikanto'],
            ['name' => '新潟', 'local_name_id' => 'chubu'],
            ['name' => '富山', 'local_name_id' => 'chubu'],
            ['name' => '石川', 'local_name_id' => 'chubu'],
            ['name' => '福井', 'local_name_id' => 'chubu'],
            ['name' => '山梨', 'local_name_id' => 'chubu'],
            ['name' => '長野', 'local_name_id' => 'chubu'],
            ['name' => '岐阜', 'local_name_id' => 'chubu'],
            ['name' => '静岡', 'local_name_id' => 'chubu'],
            ['name' => '愛知', 'local_name_id' => 'chubu'],
            ['name' => '三重', 'local_name_id' => 'kansai'],
            ['name' => '滋賀', 'local_name_id' => 'kansai'],
            ['name' => '京都', 'local_name_id' => 'kansai'],
            ['name' => '大阪', 'local_name_id' => 'kansai'],
            ['name' => '兵庫', 'local_name_id' => 'kansai'],
            ['name' => '奈良', 'local_name_id' => 'kansai'],
            ['name' => '和歌山', 'local_name_id' => 'kansai'],
            ['name' => '鳥取', 'local_name_id' => 'nishinihon'],
            ['name' => '島根', 'local_name_id' => 'nishinihon'],
            ['name' => '岡山', 'local_name_id' => 'nishinihon'],
            ['name' => '広島', 'local_name_id' => 'nishinihon'],
            ['name' => '山口', 'local_name_id' => 'nishinihon'],
            ['name' => '徳島', 'local_name_id' => 'nishinihon'],
            ['name' => '香川', 'local_name_id' => 'nishinihon'],
            ['name' => '愛媛', 'local_name_id' => 'nishinihon'],
            ['name' => '高知', 'local_name_id' => 'nishinihon'],
            ['name' => '福岡', 'local_name_id' => 'nishinihon'],
            ['name' => '佐賀', 'local_name_id' => 'nishinihon'],
            ['name' => '長崎', 'local_name_id' => 'nishinihon'],
            ['name' => '熊本', 'local_name_id' => 'nishinihon'],
            ['name' => '大分', 'local_name_id' => 'nishinihon'],
            ['name' => '宮崎', 'local_name_id' => 'nishinihon'],
            ['name' => '鹿児島', 'local_name_id' => 'nishinihon'],
            ['name' => '沖縄', 'local_name_id' => 'nishinihon'],
        ]);

        Schema::create('boards', function (Blueprint $table) {
            $table->id('id');
            $table->tinyText('title');
            $table->string('name', 100);
            $table->text('body');
            $table->string('email', 100);
            $table->unsignedBigInteger('prefecture_id')->nullable();
            $table->integer('operation_key');
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
