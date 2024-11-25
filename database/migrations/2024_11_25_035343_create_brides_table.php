<?php

use App\Models\User;
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
        Schema::create('brides', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('men_name');
            $table->string('men_nickname');
            $table->string('men_desc');
            $table->string('women_name');
            $table->string('women_nickname');
            $table->string('women_desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brides');
    }
};
