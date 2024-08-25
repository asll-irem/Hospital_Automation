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
        Schema::create('district', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('city_id')->constrained('city')->onDelete('cascade')->comment('city_id adında yabancıl anahtar oluşturuldu. Bu city tablosundaki id değerine referans verir.Bir kayıt silindiğinde bu kayda bağlı diğer kayıtların otomatik silinmesini sağlar');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('district');
    }
};
