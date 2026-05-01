<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->enum('tipo', ['entrada', 'salida']);
            $table->integer('cantidad');
            $table->string('motivo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
