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
        Schema::create('board', function (Blueprint $table) {
            $table->bigIncrements('message_id');
            $table->string('user_name', 50);
            $table->text('message');
            $table->tinyInteger('delete_flag')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('user_id');

            // usersテーブルのidカラムを参照する外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board');
    }
};
