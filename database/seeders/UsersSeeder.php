<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [ 'name' => 'Admin',   'email' => 'admin@kbrtec.com.br', 'role' => 'admin' ],
            [ 'name' => 'Usuário', 'email' => 'usuario@kbrtec.com.br' ],
            [ 'name' => 'Teste',   'email' => 'teste@kbrtec.com.br' ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => data_get($user, 'email')],
                [
                    'name'     => data_get($user, 'name'),
                    'password' => bcrypt('senha-de-teste'),
                    'role'     => data_get($user, 'role', 'visitor'),
                ]
            );
        }
    }
}
