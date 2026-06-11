<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\OrganizerRequestController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckAdmin;

Route::get('/', [PublicController::class, 'home']);
Route::view('/dove-siamo', 'dove-siamo')->name('dove-siamo');
Route::get('/eventi', [EventController::class, 'index'])->name('eventi');
Route::get('/eventi/{id}', [EventController::class, 'show'])->name('evento.dettaglio');
Route::view('/contatti', 'contatti')->name('contatti');
Route::post('/contatti/richiesta', [OrganizerRequestController::class, 'store'])->name('organizer.request.store');

// Rotte login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Registrazione
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dati-personali', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/eventimiei', function () {
    return view('eventimiei');
})->middleware('auth');

// Acquisto e partecipazione
Route::post('/eventi/{id}/acquista', [PurchaseController::class, 'store'])->name('acquista')->middleware('auth');
Route::post('/eventi/{id}/partecipa', [AttendanceController::class, 'store'])->name('partecipa')->middleware('auth');

// Livello 2 - Organizzatori
Route::middleware(['auth'])->prefix('organizer')->group(function () {
    Route::get('/eventi', [OrganizerController::class, 'index'])->name('organizer.eventi');
    Route::get('/eventi/nuovo', [OrganizerController::class, 'create'])->name('organizer.create');
    Route::post('/eventi', [OrganizerController::class, 'store'])->name('organizer.store');
    Route::get('/eventi/{id}/modifica', [OrganizerController::class, 'edit'])->name('organizer.edit');
    Route::put('/eventi/{id}', [OrganizerController::class, 'update'])->name('organizer.update');
    Route::delete('/eventi/{id}', [OrganizerController::class, 'destroy'])->name('organizer.destroy');
    Route::get('/sconti', [OrganizerController::class, 'sconti'])->name('organizer.sconti');
    Route::put('/sconti/{id}', [OrganizerController::class, 'updateSconto'])->name('organizer.sconti.update');
    Route::get('/incassi', [OrganizerController::class, 'incassi'])->name('organizer.incassi');
    Route::get('/analisi-vendite', [OrganizerController::class, 'analisiVendite'])->name('organizer.analisi');
});

// Gruppo di rotte protette per l'Admin
Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->group(function () {
    
    // Le tre pagine principali
    Route::get('/organizzatori', [AdminController::class, 'organizzatori'])->name('admin.organizzatori');
    Route::get('/clienti', [AdminController::class, 'clienti'])->name('admin.clienti');
    Route::get('/vendite', [AdminController::class, 'vendite'])->name('admin.vendite');
    // Rotte per Creare e Modificare un organizzatore
    Route::get('/organizzatori/nuovo', [AdminController::class, 'createOrganizzatore'])->name('admin.organizzatori.create');
    Route::get('/organizzatori/{id}/modifica', [AdminController::class, 'editOrganizzatore'])->name('admin.organizzatori.edit');
    // Rotte per Salvare e Aggiornare nel database
    Route::post('/organizzatori', [AdminController::class, 'storeOrganizzatore'])->name('admin.organizzatori.store');
    Route::put('/organizzatori/{id}', [AdminController::class, 'updateOrganizzatore'])->name('admin.organizzatori.update');
    // Rotta per eliminare gli utenti (sia clienti che organizzatori)
    Route::delete('/utenti/{id}', [AdminController::class, 'destroyUser'])->name('admin.utenti.destroy');

});