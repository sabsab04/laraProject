<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Purchase;
use App\Models\Attendance;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'birth_date',
        'username',
        'password',
        'role',
        'organization',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function purchases()
{
    return $this->hasMany(Purchase::class);
}

public function attendances()
{
    return $this->hasMany(Attendance::class);
}
}