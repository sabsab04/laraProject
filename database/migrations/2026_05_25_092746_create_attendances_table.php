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
    Schema::create('attendances', function (Blueprint $table) {
        $table->id();
        
        // Collega il Cliente (Livello 2) 
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        // Collega l'Evento
        $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
        
        $table->timestamps();

        // Evita che lo stesso utente clicchi "parteciperò" due volte per lo stesso evento
        $table->unique(['user_id', 'event_id']); 
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
