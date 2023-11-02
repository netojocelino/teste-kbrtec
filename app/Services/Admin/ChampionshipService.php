<?php

namespace App\Services\Admin;

use App\Exceptions\InvalidAttributeUpdateException;
use App\Exceptions\NotFoundRecord;
use App\Models\Championship;

class ChampionshipService
{

    protected readonly Championship $championship;

    public function __construct ()
    {
        $this->championship = new Championship;
    }

    public function store (array $data = [])
    {
        $alreadyExistsChampionship = $this->checkIfAlreadyExists($data);

        // use throw_if()?
        if ($alreadyExistsChampionship) {
            throw new \App\Exceptions\DuplicateRecord(__('validation.unique', [
                'attribute' => 'title',
            ]));
        }

        $championship = $this->championship->create([
            'code'            => data_get($data, 'code'),
            'title'           => data_get($data, 'title'),
            'city_state'      => data_get($data, 'city_state'),
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


    public function list (array $filter = [])
    {
        return $this->query($filter)->paginate();
    }

    public function getById(int $id)
    {
        return $this->championship->find($id);
    }

    public function update(int $championship_id, array $data)
    {
        if (!($championship = $this->getById($championship_id)))
        {
            throw new NotFoundRecord(__('validation.exists', [
                'attribute' => 'championship',
            ]));
        }

        if (in_array('code', array_keys($data)))
        {
            throw new InvalidAttributeUpdateException(__('validation.prohibited', [
                'attribute' => 'code',
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
                'attribute' => 'championship',
            ]));
        }

        return $championship->delete();
    }


    public function query (array $filter = [])
    {
        return $this->championship
            ->when(!is_null(data_get($filter, 'title')), function ($when) use ($filter) {
                return $when->where('title', 'LIKE', '%'.$filter['title'].'%');
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

}
