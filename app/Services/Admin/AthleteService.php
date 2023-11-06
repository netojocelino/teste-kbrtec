<?php

namespace App\Services\Admin;

use App\Exceptions\NotFoundRecord;
use App\Helpers\Helpers;
use App\Models\Athlete;
use Illuminate\Support\Str;

class AthleteService
{
    protected readonly Athlete $athlete;

    public function __construct ()
    {
        $this->athlete = new Athlete();
    }

    public function query (array $filter = [])
    {
        return $this->athlete
            ->query();
    }

    public function store (array $data = [])
    {
        $document_number = Helpers::onlyNumbers(data_get($data, 'document_number', ''));

        $attributes = [
            'full_name'       => data_get($data, 'full_name'),
            'birthdate'       => data_get($data, 'birthdate'),
            'document_number' => $document_number,
            'team'            => data_get($data, 'team'),
            'gender'          => data_get($data, 'gender'),
            'belt'            => data_get($data, 'belt'),
            'weight'          => data_get($data, 'weight'),
            'email'           => data_get($data, 'email'),
        ];

        if ($athlete = $this->getByEmail(data_get($data, 'email')))
        {
            $athlete->update([
                ...$attributes,
                'password' => bcrypt(data_get($data, 'password')),

            ]);
            return $athlete;
        }



        $athlete = $this->athlete->create([
            ...$attributes,
            'code'            => Str::slug(data_get($data, 'code') ?: data_get($data, 'full_name')),
            'password'        => bcrypt(data_get($data, 'password')),
        ]);

        return $athlete;
    }

    public function  getByEmail( string $email )
    {
        return $this->athlete->whereEmail($email)->first();
    }

    public function  getById( int $id )
    {
        return $this->athlete->find($id);
    }

    public function  getByCode( string $code )
    {
        return $this->athlete->whereCode($code);
    }

    public function list( array $filter = [] )
    {
        return $this->query($filter)
            ->orderBy('full_name', 'asc')
            ->paginate();
    }

    public function delete( int $id )
    {
        if(!($athlete = $this->getById($id)))
        {
            throw new NotFoundRecord(__('validation.exists', [
                'attribute' => __('validation.attributes.athlete'),
            ]));
        }

        return $athlete->delete();
    }



}
