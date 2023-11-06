<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CompetitorGroups extends Model
{
    use HasFactory;

    protected $fillable = [
        'belt',
        'weight',
        'match_number',
        'match_level',
        'championship_id',
        'first_athlete_id',
        'second_athlete_id',
        'winner_athlete_id',
    ];


    public function firstAthlete(): HasOne
    {
        return $this->hasOne(Athlete::class, 'id', 'first_athlete_id');
    }

    public function secondAthlete(): HasOne
    {
        return $this->hasOne(Athlete::class, 'id', 'second_athlete_id');
    }

    public function winner(): HasOne
    {
        return $this->hasOne(Athlete::class, 'id', 'winner_athlete_id');
    }
}
