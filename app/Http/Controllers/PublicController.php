<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // NON DIMENTICARE QUESTA RIGA! Serve a importare il Modello

class PublicController extends Controller
{
    public function home()
    {
        // Vai nel DB, prendi gli eventi dal più recente, prendine al massimo 4
        $events = Event::latest()->take(4)->get();
        
        // Passa questi eventi alla vista 'home'
        return view('home', compact('events'));
    }
}