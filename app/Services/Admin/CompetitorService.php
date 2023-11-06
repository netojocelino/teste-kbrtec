<?php

namespace App\Services\Admin;

use App\Exceptions\ChampionshipClosesRegisterException;
use App\Models\Athlete;
use App\Models\Championship;
use App\Models\Competitor;
use App\Models\CompetitorGroups;

class CompetitorService
{
    protected readonly Competitor $competitor;
    protected readonly CompetitorGroups $competitorGroup;

    public function __construct ()
    {
        $this->competitor = new Competitor();
        $this->competitorGroup = new CompetitorGroups();
    }

    public function query (array $filter = [])
    {
        return $this->competitor
            ->query()
            ->when(!is_null(data_get($filter, 'belt')), function ($when) use ($filter) {
                return $when->where('belt', $filter['belt']);
            })
            ->when(!is_null(data_get($filter, 'weight')), function ($when) use ($filter) {
                return $when->where('weight', $filter['weight']);
            })
            ->when(!is_null(data_get($filter, 'gender')), function ($when) use ($filter) {
                return $when->where('gender', $filter['gender']);
            })
            ->when(!is_null(data_get($filter, 'championship_id')), function ($when) use ($filter) {
                return $when->where('championship_id', $filter['championship_id']);
            });
    }

    public function store (Athlete $athlete, Championship $championship)
    {
        if ($championship->phase != 'open_register')
        {
            throw new ChampionshipClosesRegisterException(__('validation.prohibited_unless', [
                'attribute' => __('validation.attributes.subscription'),
                'other'     => __('validation.attributes.phase'),
                'values'    => __('validation.attributes.open_register'),
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

    public function addToGroup (Championship $championship, Competitor $competitor)
    {
        $data = [
            'belt'            => $competitor->belt,
            'weight'          => $competitor->weight,
            'championship_id' => $championship->id,
        ];

        $group = $this->competitorGroup->where($data)
            ->whereNull('winner_athlete_id')
            ->where(function ($where) {
                return $where->whereNull('first_athlete_id')
                    ->orWhereNull('second_athlete_id');
            })->inRandomOrder()
            ->first();

        if ($group)
        {
            $group->update([
                ...$data,
                'first_athlete_id'  => $group->first_athlete_id ?? $competitor->athlete_id,
                'second_athlete_id' => $group->second_athlete_id ?? $competitor->athlete_id,
            ]);
        } else {
            $group = $this->competitorGroup->create([
                ...$data,
                'first_athlete_id'  => $competitor->athlete_id,
                'match_number'      => $this->competitorGroup->where($data)->count() + 1,
            ]);
        }
        return $group;
    }

    public function nextCompetition (CompetitorGroups $competition)
    {
        $data = [
            'belt'            => $competition->belt,
            'weight'          => $competition->weight,
            'championship_id' => $competition->championship_id,
            'match_level'       => $competition->match_level + 1,
        ];

        if ($competitionNext = $this->competitorGroup->where($data)->whereNull('second_athlete_id')->first())
        {
            $competitionNext->update([
                'second_athlete_id' => $competition->winner_athlete_id,
            ]);
        } else {
            $competitionNext = $this->competitorGroup->create([
                ...$data,
                'match_number'      => $this->competitorGroup->where($data)->count() + 1,
                'first_athlete_id'  => $competition->winner_athlete_id,
                'second_athlete_id' => null,
                'winner_athlete_id' => null,
            ]);
        }

        return $competitionNext;
    }

}
