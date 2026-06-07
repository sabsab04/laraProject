<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Aggiunto per evitare errori sulla classe DB
use App\Models\User;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Inseriamo gli Utenti
        DB::table('users')->insert([
            [
                'name' => 'Mario', 
                'surname' => 'Verdi', 
                'username' => 'clieclie',
                'password' => Hash::make('1234'), 
                'role' => 'user', 
                'birth_date' => '2000-01-01',
                'organization' => null,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Giulia', 
                'surname' => 'Rossi', 
                'username' => 'orgorg',
                'password' => Hash::make('1234'), 
                'role' => 'organizzatore', 
                'birth_date' => '2003-03-03',
                'organization' => 'FunForYoungs',
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);

        // 2. Inseriamo gli Eventi collegati all'organizzatore Giulia (ID: 2)
        DB::table('events')->insert([
            [
                'titolo' => 'Incontro in piazza - Benvenute matricole!',
                'descrizione' => 'Un incontro speciale per dare il benvenuto a tutti i nuovi studenti. Musica, presentazioni e tanto divertimento per iniziare l\'anno accademico al meglio.',
                'punti_riferimento' => 'Piazza Roma, vicino alla fontana.',
                'data' => '2026-09-15',
                'orario' => '18:00 - 22:00',
                'citta' => 'Ancona',
                'luogo' => 'Piazza Roma',
                'posti_disponibili' => 500,
                'costo' => 1.00,
                'immagine' => 'piazza.jpg',
                'organizer_id' => 2, // Aggiornato con il nuovo nome della colonna
                'last_minute_days' => null, // Gratuito, nessuno sconto applicabile
                'last_minute_discount_percentage' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titolo' => 'Mercoledì universitario in discoteca',
                'descrizione' => 'La classica serata universitaria per staccare dallo studio dopo le lezioni. Ingresso ridotto presentando il badge universitario.',
                'punti_riferimento' => 'Ingresso principale.',
                'data' => '2026-10-07',
                'orario' => '23:30 - 04:00',
                'citta' => 'Monsano',
                'luogo' => 'Miami Club',
                'posti_disponibili' => 300,
                'costo' => 10.00,
                'immagine' => 'incontro.jpg',
                'organizer_id' => 2,
                'last_minute_days' => 3, // Sconto applicato 3 giorni prima dell'evento
                'last_minute_discount_percentage' => 20.00, // 20% di sconto
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titolo' => 'Incontro con la Prof.ssa Maria Rossi',
                'descrizione' => 'Seminario esclusivo sulle frontiere delle Tecnologie Web e sulle nuove prospettive per gli studenti di Ingegneria Informatica.',
                'punti_riferimento' => 'Aula Magna, Facoltà di Ingegneria Brecce Bianche.',
                'data' => '2026-11-20',
                'orario' => '10:00 - 13:00',
                'citta' => 'Ancona',
                'luogo' => 'Univpm - Polo Monte Dago',
                'posti_disponibili' => 150,
                'costo' => 2.00,
                'immagine' => 'default.jpg', 
                'organizer_id' => 2,
                'last_minute_days' => null,
                'last_minute_discount_percentage' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}