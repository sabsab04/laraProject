<?php

namespace Database\Seeders;

// Tutte le importazioni necessarie, senza doppioni!
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Creiamo un utente Organizzatore (Livello 3)
        $organizer = User::create([
            'name' => 'Mario',
            'surname' => 'Rossi',
            'birth_date' => '1980-05-15', 
            'username' => 'org_mario',
            'email' => 'mario@organizzatore.it',
            'password' => Hash::make('password123'),
            'role' => 3,
            'organization' => 'Eventi Universitari SRL'
        ]);

        // 2. Creiamo gli eventi associati al suo ID
        Event::create([
            'organizer_id' => $organizer->id,
            'title' => 'Benvenute matricole - concerto',
            'description' => 'Un raduno imperdibile per tutti gli amanti del rock e dei riff taglienti.',
            'program' => 'Ore 20:00 Apertura cancelli, Ore 21:00 Inizio concerto.',
            'event_date' => '2026-07-15',
            'event_time' => '21:00:00',
            'city' => 'Milano',
            'venue' => 'Piazza Duomo',
            'ticket_price' => 25.50,
            'available_tickets' => 500,
        ]);

        Event::create([
            'organizer_id' => $organizer->id,
            'title' => 'Fiera di Ingegneria e dell\'Automazione',
            'description' => 'Le ultime novità dal mondo dei robot, dello sviluppo software e dell\'industria 4.0.',
            'program' => 'Stand espositivi e seminari accademici per tutto il giorno.',
            'event_date' => '2026-09-10',
            'event_time' => '09:00:00',
            'city' => 'Roma',
            'venue' => 'Fiera di Roma',
            'ticket_price' => 15.00,
            'available_tickets' => 1000,
        ]);
        
        Event::create([
            'organizer_id' => $organizer->id,
            'title' => 'incontro con la prof.ssa Maria Bianchi',
            'description' => 'Esposizione delle razze più belle e consigli pratici sull\'alimentazione.',
            'program' => 'Gara di bellezza e seminari nutrizionali per i nostri amici a quattro zampe.',
            'event_date' => '2026-10-05',
            'event_time' => '10:00:00',
            'city' => 'Bologna',
            'venue' => 'BolognaFiere',
            'ticket_price' => 10.00,
            'available_tickets' => 300,
        ]);
    }
}