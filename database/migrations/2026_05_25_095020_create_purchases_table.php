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
    Schema::create('purchases', function (Blueprint $table) {
        $table->id();
        
        // Collegamenti
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Cliente che compra
        $table->foreignId('event_id')->constrained('events')->onDelete('cascade'); // Evento acquistato
        
        // Dettagli Transazione
        $table->integer('tickets_count'); // Numero di biglietti acquistati
        $table->string('payment_method'); // Modalità di pagamento (es. Carta, PayPal, ecc.)
        
        $table->timestamps(); // Genera in automatico 'created_at' (data dell'acquisto)
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
