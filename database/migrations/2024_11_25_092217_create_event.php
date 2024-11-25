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
        Schema::create('akad', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->date('date');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string('location');
            $table->string('address');
            $table->string('link_maps');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('resepsi', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->date('date');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string('location');
            $table->string('address');
            $table->string('link_maps');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('events');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akad');
    }
};
