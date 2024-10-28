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
        Schema::create('blood_donates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age');
            $table->string('blood_type');
            $table->string('address');
            $table->boolean('seen_by_an_admin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_donates');
    }
};
