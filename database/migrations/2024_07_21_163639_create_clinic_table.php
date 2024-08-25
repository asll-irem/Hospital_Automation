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
        Schema::create('clinic', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId("hospital_id")->constrained('hospital')->onDelete('cascade')->comment('hospital_id adında yabancıl anahtar oluşturuldu.Bu hospital tablosundaki id değerine referans verir.');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('clinic');
    }
};
