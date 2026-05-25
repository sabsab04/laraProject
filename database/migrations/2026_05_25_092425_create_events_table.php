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
        $table->string('title');
        $table->text('description');
        $table->text('program');
        $table->date('event_date');
        $table->time('event_time');
        $table->string('city');
        $table->string('venue');
        $table->decimal('ticket_price', 8, 2);
        $table->integer('available_tickets');
        $table->text('directions')->nullable();
        
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
