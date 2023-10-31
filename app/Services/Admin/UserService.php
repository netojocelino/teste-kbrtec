<?php

namespace App\Services\Admin;

use App\Exceptions\DuplicateRecord;
use App\Models\User;

class UserService
{
    protected readonly User $user;

    public function __construct ()
    {
        $this->user = new User;
    }

    public function findByEmail (string $email)
    {
        return $this->user->whereEmail($email)->first();
    }

    public function store (array $data)
    {
        if ($this->findByEmail(data_get($data, 'email')))
        {
            throw new DuplicateRecord(__('validation.unique', ['attribute' => 'email']));
        }

        $user = $this->user->create([
            'name'     => data_get($data, 'name'),
            'email'    => data_get($data, 'email'),
            'password' => data_get($data, 'password'),
            'role'     => data_get($data, 'role'),
        ]);

        return $user;
    }

    public function query (array $filter = [])
    {
        $users = $this->user->query()
            ->when(!is_null(data_get($filter, 'name')), function ($query) use ($filter) {
                return $query->where('name', 'LIKE', '%'.$filter['name'].'%')
                    ->orWhere('email', 'LIKE', '%'.$filter['name'].'%');
            });

        return $users;
    }
}
