<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizerRequest extends Model
{
    use HasFactory;

    // Questa riga è FONDAMENTALE, senza di lei Laravel butta via i dati del form!
    protected $fillable = ['name', 'surname', 'email', 'organization', 'status'];
}