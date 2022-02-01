<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Init extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_hash')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nickname')->unique();
            $table->timestamps();
        });

        Schema::create('decks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_hash')->unique();
            $table->boolean('active')->default(true);
            $table->boolean('complete')->default(false);
            $table->timestamps();
        });

        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_hash', 256);
            $table->char('value', 2);
            $table->char('suit', 1);
            $table->string('deck_id');
            $table->foreign('deck_id')->references('id_hash')->on('decks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('decks');
        Schema::dropIfExists('cards');
    }
}
