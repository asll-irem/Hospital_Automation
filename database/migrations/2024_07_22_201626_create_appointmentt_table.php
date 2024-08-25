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
        Schema::create('appointmentt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->foreignId('city_id')->constrained('city')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('district')->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained('hospital')->onDelete('cascade');
            $table->foreignId('clinic_id')->constrained('clinic')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctor')->onDelete('cascade');
            $table->date('appointment_date');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('appointmentt');
    }
};
