<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('codigo')->unique();
            $table->text('descripcion')->nullable();
            $table->foreignId('categoria_id')->constrained()->restrictOnDelete();
            $table->integer('stock')->default(0);
            $table->decimal('precio', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
