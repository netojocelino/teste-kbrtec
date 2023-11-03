<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Championship extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'title',
        'city_state',
        'city_id',
        'state_id',
        'date',
        'about',
        'gym_place',
        'info',
        'public_entrance',
        'type',
        'phase',
        'active_status',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function getDateFormatedAttribute ()
    {
        return $this->date->format('Y, d ') . __($this->date->format('M'));
    }
}
