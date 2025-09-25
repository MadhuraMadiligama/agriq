<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // පිළිතුර දුන් user
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // කුමන ප්‍රශ්නයටද
            $table->text('body'); // පිළිතුරේ විස්තරය
            $table->boolean('is_accepted')->default(false); // පිළිගත් පිළිතුරද?
            $table->boolean('is_official')->default(false); // නිල පිළිතුරද?
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
