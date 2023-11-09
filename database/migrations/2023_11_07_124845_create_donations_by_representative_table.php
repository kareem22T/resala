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
        Schema::create('donations_by_representative', function (Blueprint $table) {
            $table->id();
            // TYPE 1 => "تبرع عيني"
            // TYPE 2 => "تبرع مالي"
            $table->boolean('type'); 
            $table->text('name');
            $table->text('phone');
            $table->text('address');
            $table->boolean('seen_by_an_admin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations_by_representative');
    }
};
