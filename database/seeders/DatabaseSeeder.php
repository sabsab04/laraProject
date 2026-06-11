<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'         => 'Clie',
                'surname'      => 'Clie',
                'username'     => 'clieclie',
                'email'        => 'clieclie@unifun.it',
                'password'     => Hash::make('KjbnKjbn'),
                'role'         => 'user',
                'birth_date'   => '2000-01-01',
                'organization' => null,
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'name'         => 'Orga',
                'surname'      => 'Orga',
                'username'     => 'orgaorga',
                'email'        => 'orgaorga@unifun.it',
                'password'     => Hash::make('KjbnKjbn'),
                'role'         => 'organizzatore',
                'birth_date'   => '2000-01-01',
                'organization' => 'FunForYoungs',
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'name'         => 'Admin',
                'surname'      => 'Admin',
                'username'     => 'adminadmin',
                'email'        => 'adminadmin@unifun.it',
                'password'     => Hash::make('KjbnKjbn'),
                'role'         => 'admin',
                'birth_date'   => '2000-01-01',
                'organization' => null,
                'created_at'   => now(),
                'updated_at'   => now()
            ],
        ]);

        DB::table('events')->insert([
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Incontro in piazza - Benvenute matricole!',
                'descrizione'                   => 'Un incontro speciale per dare il benvenuto a tutti i nuovi studenti. Musica, presentazioni e tanto divertimento.',
                'punti_riferimento'             => 'Piazza Roma, vicino alla fontana.',
                'data'                          => '2026-09-15',
                'orario'                        => '18:00 - 22:00',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Piazza Roma',
                'posti_disponibili'             => 500,
                'costo'                         => 1.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => null,
                'last_minute_discount_percentage' => null,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Mercoledì universitario in discoteca',
                'descrizione'                   => 'La classica serata universitaria. Ingresso ridotto presentando il badge universitario.',
                'punti_riferimento'             => 'Ingresso principale.',
                'data'                          => '2026-10-07',
                'orario'                        => '23:30 - 04:00',
                'citta'                         => 'Monsano',
                'luogo'                         => 'Miami Club',
                'posti_disponibili'             => 300,
                'costo'                         => 10.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => 3,
                'last_minute_discount_percentage' => 20.00,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Incontro con la Prof.ssa Maria Rossi',
                'descrizione'                   => 'Seminario esclusivo sulle frontiere delle Tecnologie Web.',
                'punti_riferimento'             => 'Aula Magna, Facoltà di Ingegneria.',
                'data'                          => '2026-11-20',
                'orario'                        => '10:00 - 13:00',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Univpm - Polo Monte Dago',
                'posti_disponibili'             => 150,
                'costo'                         => 2.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => null,
                'last_minute_discount_percentage' => null,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Fiera del lavoro universitaria',
                'descrizione'                   => 'Incontra le migliori aziende del territorio. Porta il tuo CV!',
                'punti_riferimento'             => 'Padiglione centrale.',
                'data'                          => '2026-10-15',
                'orario'                        => '09:00 - 18:00',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Fiera di Ancona',
                'posti_disponibili'             => 1000,
                'costo'                         => 0.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => null,
                'last_minute_discount_percentage' => null,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Concerto studentesco di fine anno',
                'descrizione'                   => 'Grande concerto con band universitarie per festeggiare la fine dell\'anno accademico.',
                'punti_riferimento'             => 'Ingresso da Via Brecce Bianche.',
                'data'                          => '2026-12-20',
                'orario'                        => '20:00 - 24:00',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Auditorium Univpm',
                'posti_disponibili'             => 400,
                'costo'                         => 5.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => 5,
                'last_minute_discount_percentage' => 15.00,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Workshop di fotografia urbana',
                'descrizione'                   => 'Impara a fotografare la città con i migliori fotografi professionisti.',
                'punti_riferimento'             => 'Ritrovo in Piazza Cavour.',
                'data'                          => '2026-09-28',
                'orario'                        => '14:00 - 18:00',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Centro storico',
                'posti_disponibili'             => 30,
                'costo'                         => 15.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => 2,
                'last_minute_discount_percentage' => 25.00,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Torneo di calcetto universitario',
                'descrizione'                   => 'Sfida le altre facoltà nel torneo di calcetto più atteso dell\'anno!',
                'punti_riferimento'             => 'Campo sportivo principale.',
                'data'                          => '2026-10-25',
                'orario'                        => '15:00 - 20:00',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Centro sportivo Univpm',
                'posti_disponibili'             => 200,
                'costo'                         => 3.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => null,
                'last_minute_discount_percentage' => null,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Aperitivo di networking',
                'descrizione'                   => 'Incontra professionisti e altri studenti in un ambiente informale.',
                'punti_riferimento'             => 'Bar all\'ingresso.',
                'data'                          => '2026-11-05',
                'orario'                        => '18:30 - 21:00',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Hotel Jolly',
                'posti_disponibili'             => 100,
                'costo'                         => 8.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => 3,
                'last_minute_discount_percentage' => 10.00,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Hackathon 24 ore',
                'descrizione'                   => 'Sviluppa un progetto innovativo in 24 ore con il tuo team. Premi per i migliori!',
                'punti_riferimento'             => 'Aula informatica piano 2.',
                'data'                          => '2026-11-14',
                'orario'                        => '09:00 - 09:00',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Facoltà di Ingegneria',
                'posti_disponibili'             => 80,
                'costo'                         => 0.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => null,
                'last_minute_discount_percentage' => null,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Mostra d\'arte contemporanea',
                'descrizione'                   => 'Esposizione delle opere degli studenti di Belle Arti.',
                'punti_riferimento'             => 'Entrata da Via della Loggia.',
                'data'                          => '2026-12-05',
                'orario'                        => '10:00 - 19:00',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Galleria d\'Arte Moderna',
                'posti_disponibili'             => 250,
                'costo'                         => 4.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => 7,
                'last_minute_discount_percentage' => 30.00,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Gita al mare - Ultima estate',
                'descrizione'                   => 'Una giornata di relax al mare prima dell\'inizio delle lezioni.',
                'punti_riferimento'             => 'Ritrovo al parcheggio Piazza Ugo Bassi.',
                'data'                          => '2026-09-06',
                'orario'                        => '09:00 - 20:00',
                'citta'                         => 'Senigallia',
                'luogo'                         => 'Spiaggia di Velluto',
                'posti_disponibili'             => 50,
                'costo'                         => 12.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => 2,
                'last_minute_discount_percentage' => 20.00,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
            [
                'organizer_id'                  => 2,
                'titolo'                        => 'Serata cinema all\'aperto',
                'descrizione'                   => 'Proiezione di film classici sotto le stelle nel cortile dell\'università.',
                'punti_riferimento'             => 'Cortile interno, ingresso da Via Monte d\'Ago.',
                'data'                          => '2026-09-20',
                'orario'                        => '21:00 - 23:30',
                'citta'                         => 'Ancona',
                'luogo'                         => 'Cortile Univpm',
                'posti_disponibili'             => 120,
                'costo'                         => 3.00,
                'immagine'                      => 'default.jpg',
                'last_minute_days'              => null,
                'last_minute_discount_percentage' => null,
                'created_at'                    => now(),
                'updated_at'                    => now()
            ],
        ]);
    }
}