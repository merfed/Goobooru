<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rating
        // 1 - Safe
        // 2 - Questionable
        // 3 - Explicit
        Schema::create('boorus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->unique();
            $table->string('title')->nullable();
            $table->string('source')->nullable();
            $table->integer('uploader_id');
            $table->integer('rating')->default('1');
            $table->integer('score')->default('0');
            $table->boolean('locked')->nullable();
            $table->boolean('flagged_for_delete')->nullable();
            $table->integer('views')->default('0');
            $table->timestamps();
        });

        // Types
        // 0 - General
        // 1 - Artist
        // 2 - Character
        // 3 - Copyright
        // 4 - Year
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('type');
            $table->timestamps();
        });

        Schema::create('boorus_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('booru_id');
            $table->integer('tag_id');
            $table->timestamps();
        });

        Schema::create('hashes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash');
            $table->timestamps();
        });

        Schema::create('favs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('image_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('pools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('image_id');
            $table->integer('user_id');
            $table->boolean('visible')->default('1');
            $table->timestamps();
        });

        Schema::create('boorus_pools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('booru_id');
            $table->integer('pool_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boorus');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('favs');
        Schema::dropIfExists('pools');
        Schema::dropIfExists('boorus_tags');
        Schema::dropIfExists('boorus_pools');
        Schema::dropIfExists('hashes');
    }
}
