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
            $table->integer('uploader_id');
            $table->integer('rating')->default('1');
            $table->integer('score')->default('0');
            $table->boolean('locked')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->boolean('flagged_for_delete')->nullable();
            $table->integer('flagged_for_delete_votes')->default('0');
            $table->integer('views')->default('0');
            $table->timestamps();
        });

        Schema::create('boorus_flags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('booru_id')->nullable();
            $table->bigInteger('tag_id')->nullable();
            $table->bigInteger('pool_id')->nullable();
            $table->bigInteger('comment_id')->nullable();
            $table->bigInteger('thread_id')->nullable();
            $table->bigInteger('creator_id')->nullable();
            $table->timestamps();
        });

        Schema::create('boorus_sources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('booru_id');
            $table->string('source')->nullable();
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('body');
            $table->integer('user_id');
            $table->bigInteger('booru_id');
            $table->boolean('as_admin')->default('0');
            $table->boolean('as_mod')->default('0');
            $table->boolean('deleted')->default('0');
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
            $table->bigInteger('booru_id');
            $table->bigInteger('tag_id');
            $table->timestamps();
        });

        Schema::create('hashes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash');
            $table->timestamps();
        });

        Schema::create('favs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('image_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('pools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('user_id');
            $table->boolean('visible')->default('1');
            $table->timestamps();
        });

        Schema::create('boorus_pools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('booru_id');
            $table->bigInteger('pool_id');
            $table->timestamps();
        });

        Schema::create('forum_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('color');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('forum_threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('user_id');
            $table->bigInteger('category_id');
            $table->boolean('locked')->default('0');
            $table->boolean('deleted')->default('0');
            $table->boolean('pinned')->default('0');
            $table->timestamps();
        });

        Schema::create('forum_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('body');
            $table->integer('user_id');
            $table->bigInteger('thread_id');
            $table->boolean('as_admin')->default('0');
            $table->boolean('as_mod')->default('0');
            $table->boolean('deleted')->default('0');
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
        Schema::dropIfExists('comments');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('favs');
        Schema::dropIfExists('pools');
        Schema::dropIfExists('boorus_tags');
        Schema::dropIfExists('boorus_pools');
        Schema::dropIfExists('boorus_sources');
        Schema::dropIfExists('boorus_flags');
        Schema::dropIfExists('hashes');
        Schema::dropIfExists('forum_categories');
        Schema::dropIfExists('forum_threads');
        Schema::dropIfExists('forum_comments');
    }
}
