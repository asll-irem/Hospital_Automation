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
        Schema::create('doctor', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('clinic_id')->constrained('clinic')->onDelete('cascade')->comment('clinic_id adında yabancıl anahtar oluşturuldu, clinic tablsoundaki id değerine referans verir.');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('doctor');
    }
};
