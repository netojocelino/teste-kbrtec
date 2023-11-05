<?php

namespace App\Services\Admin;

use App\Exceptions\ChampionshipClosesRegisterException;
use App\Exceptions\DuplicateRecord;
use App\Exceptions\NotFoundRecord;
use App\Helpers\Helpers;
use App\Models\Athlete;
use App\Models\Championship;
use App\Models\Competitor;

class CompetitorService
{
    protected readonly Competitor $competitor;

    public function __construct ()
    {
        $this->competitor = new Competitor();
    }

    public function query (array $filter = [])
    {
        return $this->competitor
            ->query();
    }

    public function store (Athlete $athlete, Championship $championship)
    {
        if ($championship->phase != 'open_register')
        {
            throw new ChampionshipClosesRegisterException(__('validation.prohibited_unless', [
                'attribute' => 'subscription',
                'other'     => 'phase',
                'values'    => 'open_register',
            ]));
        }

        $competitor = $this->competitor->create([
            'belt'   => $athlete->belt,
            'weight' => $athlete->weight,
            'team'   => $athlete->team,

            'championship_id' => $championship->id,
            'athlete_id'      => $athlete->id,
        ]);

        return $competitor;
    }

}
