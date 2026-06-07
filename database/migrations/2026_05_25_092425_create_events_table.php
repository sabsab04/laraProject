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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        // Collegamento all'organizzatore (Utente Livello 3)
        $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade'); 
        
        // Dati Base
        $table->string('titolo');
        $table->text('descrizione');
        $table->string('punti_riferimento')->nullable();
        
        $table->date('data');
        $table->string('orario'); // Es: "10:00 - 12:00"
        $table->string('citta');
        $table->string('luogo');
        $table->integer('posti_disponibili');
        $table->decimal('costo', 8, 2)->default(0.00);
        $table->string('immagine')->default('default.jpg'); // Salveremo qui il nome del file (es: "evento1.jpg")
        
        // Funzionalità Opzionale: Sconti Last-Minute 
        $table->integer('last_minute_days')->nullable(); 
        $table->decimal('last_minute_discount_percentage', 5, 2)->nullable(); 

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
