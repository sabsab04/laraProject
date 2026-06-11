<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    // Controlla se l'utente è loggato e se il suo ruolo è 'admin' (o come l'hai chiamato nel DB)
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request); // Lascialo passare
    }

    // Altrimenti sbattilo fuori e rimandalo alla home
    return redirect('/')->with('error', 'Accesso negato! Area riservata agli amministratori.');
}
}
