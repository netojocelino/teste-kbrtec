<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Athlete extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'code',
        'full_name',
        'birthdate',
        'document_number',
        'team',
        'gender',
        'belt',
        'weight',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        // 'password' => 'hashed',
    ];
}
