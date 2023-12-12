<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('interaccions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PerroInteresado_id');
            $table->unsignedBigInteger('PerroCandidato_id');
            $table->string('preferencia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interaccions');
    }
};
