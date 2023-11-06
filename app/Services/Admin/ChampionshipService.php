<?php

namespace App\Services\Admin;

use App\Exceptions\InvalidAttributeUpdateException;
use App\Exceptions\InvalidFeatureQuantityException;
use App\Exceptions\NotFoundRecord;
use App\Models\Championship;
use App\Models\CompetitorGroups;
use Illuminate\Support\Str;

class ChampionshipService
{

    protected readonly Championship $championship;
    protected readonly CompetitorGroups $competitorGroup;
    protected readonly AthleteService $athleteService;
    protected readonly CompetitorService $competitorService;

    public function __construct ()
    {
        $this->championship = new Championship;
        $this->competitorGroup = new CompetitorGroups;
        $this->athleteService = new AthleteService;
        $this->competitorService = new CompetitorService;
    }

    public function store (array $data = [])
    {
        $alreadyExistsChampionship = $this->checkIfAlreadyExists($data);

        // use throw_if()?
        if ($alreadyExistsChampionship) {
            throw new \App\Exceptions\DuplicateRecord(__('validation.unique', [
                'attribute' => __('validation.attributes.title'),
            ]));
        }

        if ($this->checkIfCodeAlreadyExists($data)) {
            throw new \App\Exceptions\DuplicateRecord(__('validation.unique', [
                'attribute' => __('validation.attributes.code'),
            ]));
        }

        $championship = $this->championship->create([
            'code'            => Str::slug(data_get($data, 'code') ?: data_get($data, 'title')),
            'title'           => data_get($data, 'title'),
            'city_state'      => data_get($data, 'city_state'),
            'city_id'         => data_get($data, 'city_id'),
            'state_id'        => data_get($data, 'state_id'),
            'date'            => data_get($data, 'date'),
            'about'           => data_get($data, 'about'),
            'gym_place'       => data_get($data, 'gym_place'),
            'info'            => data_get($data, 'info'),
            'public_entrance' => data_get($data, 'public_entrance'),
            'type'            => data_get($data, 'type'),
            'phase'           => data_get($data, 'phase'),
            'active_status'   => data_get($data, 'active_status', true),
        ]);

        return $championship;
    }


    public function list (array $filter = [], int $perPage = null)
    {
        return $this->query($filter)
            ->orderBy('date', 'desc')
            ->paginate($perPage);
    }

    public function getById(int $id, array $with = [])
    {
        return $this->championship->with($with)->find($id);
    }

    public function getGroupsById(int $championship_id, array $filter = [])
    {
        return $this->competitorGroup
            ->where('championship_id', $championship_id)
            ->when(!is_null(data_get($filter, 'belt')), function ($when) use ($filter) {
                if ($filter['belt'] == 'marrom') {
                    return $when->where('belt', 'brown');
                } elseif ($filter['belt'] == 'preta') {
                    return $when->where('belt', 'black');
                }
            })
            ->orderBy('match_level', 'ASC')
            ->orderBy('match_number', 'ASC')
            ->with([
                'firstAthlete',
                'secondAthlete',
            ])
            ->get()
            ;
    }

    public function getByCode(string $code)
    {
        return $this->championship->where('code', $code)->first();
    }

    public function update(int $championship_id, array $data)
    {
        if (!($championship = $this->getById($championship_id)))
        {
            throw new NotFoundRecord(__('validation.exists', [
                'attribute' => __('validation.attributes.championship'),
            ]));
        }

        if (in_array('code', array_keys($data)))
        {
            throw new InvalidAttributeUpdateException(__('validation.prohibited', [
                'attribute' => __('validation.attributes.code'),
            ]));
        }

        $championship->fill($data);
        $championship->save();

        return $championship;
    }

    public function delete(int $championship_id)
    {
        if (!($championship = $this->getById($championship_id)))
        {
            throw new NotFoundRecord(__('validation.exists', [
                'attribute' => __('validation.attributes.championship'),
            ]));
        }

        return $championship->delete();
    }

    public function countFeatures ()
    {
        return $this->championship->whereNotNull('feature_order')->count();
    }

    public function features ()
    {
        return $this->championship->whereNotNull('feature_order')->get();
    }

    public function changeFeature (int $championship_id)
    {
        if (!($championship = $this->getById($championship_id)))
        {
            throw new NotFoundRecord(__('validation.exists', [
                'attribute' => __('validation.attributes.championship'),
            ]));
        }

        if ($this->countFeatures() >= 8)
        {
            throw new InvalidFeatureQuantityException(__('validation.max.numeric', [
                'attribute' => __('validation.attributes.feature'),
                'max'       => 8,
            ]));
        }

        $isFeature = !!$championship->feature_order;

        if ($isFeature) {
            $championship->update([
                'feature_order' => null,
            ]);
        } else {
            $championship->update([
                'feature_order' => $this->countFeatures() + 1,
            ]);
        }

        return $championship;
    }

    public function query (array $filter = [])
    {
        return $this->championship
            ->when(!is_null(data_get($filter, 'name')), function ($when) use ($filter) {
                return $when->where(function ($subwhere) use ($filter) {
                    return $subwhere->where('code', 'LIKE', '%'.$filter['name'].'%')
                        ->orWhere('title', 'LIKE', '%'.$filter['name'].'%')
                        ->orWhere('about', 'LIKE', '%'.$filter['name'].'%')
                        ->orWhere('info', 'LIKE', '%'.$filter['name'].'%');
                });
            })
            ->when(!is_null(data_get($filter, 'local')), function ($when) use ($filter) {
                $search = array_reduce($filter['local'], fn ($ac, $value) => $ac.$value.'%','%');
                return $when->where('city_state', 'LIKE', $search);
            })
            ->when(data_get($filter, 'championship_active', false), function ($when) use ($filter) {
                return $when->where('phase', '<>', 'Resultado');
            })
            ->when(!is_null(data_get($filter, 'type')), function ($when) use ($filter) {
                return $when->where('type', $filter['type']);
            });
    }

    public function checkIfAlreadyExists (array $data)
    {
        return $this->championship->where([
            'title'      => data_get($data, 'title'),
            'city_state' => data_get($data, 'city_state'),
            'date'       => data_get($data, 'date'),
            'gym_place'  => data_get($data, 'gym_place'),
        ])->exists();
    }

    public function checkIfCodeAlreadyExists (array $data)
    {
        return $this->championship->where([
            'code'  => data_get($data, 'code'),
        ])->exists();
    }

    public function startFighting (int $championship_id)
    {
        if (!($championship = $this->getById($championship_id)))
        {
            throw new NotFoundRecord(__('validation.exists', [
                'attribute' => __('validation.attributes.championship'),
            ]));
        }

        $this->registerCompetitorToRandomGroup($championship);

        $championship->update([ 'phase' => 'fighting', ]);
        return $championship->with([
            'groups',
        ]);
    }

    public function endsCompetition (int $championship_id)
    {
        if (!($championship = $this->getById($championship_id)))
        {
            throw new NotFoundRecord(__('validation.exists', [
                'attribute' => __('validation.attributes.championship'),
            ]));
        }

        $championship->update([ 'phase' => 'finished', ]);
        return $championship;
    }


    public function registerCompetitor (array $data, Championship $championship)
    {
        $athlete = $this->athleteService->store($data);
        $competitor = $this->competitorService->store($athlete, $championship);

        return $competitor;
    }

    public function registerCompetitorToRandomGroup (Championship $championship)
    {
        $competitors = collect();

        foreach ($championship->randomCompetitors as $competitor) {
            $competitors->add($this->competitorService->addToGroup($championship, $competitor));
        }

        return $competitors;
    }

    public function winnerOfGroup(int $athlete_id, int $championship_id)
    {
        $competition = $this->competitorGroup->where([
            'championship_id' => $championship_id,
        ])
        ->where(function ($where) use ($athlete_id) {
            return $where->where('first_athlete_id', $athlete_id)
                ->orWhere('second_athlete_id', $athlete_id);
        })
        ->whereNull('winner_athlete_id')
        ->first();

        if (!$competition)
        {
            throw new NotFoundRecord(__('validation.exists', [
                'attribute' => __('validation.attributes.competition'),
            ]));
        }
        $competition->update([ 'winner_athlete_id' => $athlete_id, ]);
        return $this->competitorService->nextCompetition($competition);
    }

}
