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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('varchar(255) türünde name sütunu, boş değer alabilir');
            $table->string('surname')->nullable()->comment('varchar(255) türünde surname sütunu,boş değer alabilir');
            $table->string('email')->nullable()->comment('varchar(255) tüürnde email sütunu,boş değğer alabilir');
            $table->timestamp('email_verified_at')->nullable(); //eposta adresinin doğrulanma zamanını saklar
            $table->string('password')->nullable()->comment('varchar(255) türünde password sütunu,boş değer alabilir ');
            $table->string('phone', 15)->nullable()->comment('varchar(15) türünde phone sütunu,boş değer alabilir  ');
            $table->string('tc')->unique()->comment('Türkiye Cumhuriyeti vatandaşlarının kimlik numarasını saklar.');
            $table->rememberToken();
            $table->timestamps(); //kaydın oluşturulma ve son güncellenme zamanlarını otomatik olarak kaydeder
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
