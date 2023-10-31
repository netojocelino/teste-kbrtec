<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'city_state',
        'date',
        'about',
        'gym_place',
        'info',
        'public_entrance',
        'type',
        'phase',
        'active_status',
    ];
}
