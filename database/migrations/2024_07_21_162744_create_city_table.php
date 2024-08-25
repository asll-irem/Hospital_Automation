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
        Schema::create('city', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('varchar(255) türünde name sütunu,boş değer alabilir ');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('city');
    }
};
