<?php

namespace Tests\Feature\Services\Admin;

use App\Helpers\Helpers;
use App\Models\Athlete;
use App\Services\Admin\AthleteService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AthleteServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testMustCreateAthleteWithAllValidData(): void
    {
        $data = Athlete::factory()->make()->toArray();

        $service = new AthleteService;
        $service->store($data);

        data_set($data, 'document_number', Helpers::onlyNumbers(data_get($data, 'document_number', '')));

        $this->assertDatabaseHas(Athlete::class, $data);
        $this->assertDatabaseCount(Athlete::class, 1);
    }

    public function testMustUpdatePasswordForAthleteWhenEmailAlreadyExists(): void
    {
        $password = "senha-de-teste";
        $data = Athlete::factory()->create()->toArray();
        $expected = array_filter([
            ...$data,
            'password'        => $password,
            'document_number' => Helpers::onlyNumbers(data_get($data, 'document_number')),
            'password'        => null,
            'updated_at'      => null,
            'created_at'      => null,
        ]);

        $service = new AthleteService;
        $service->store($data);

        $this->assertDatabaseHas(Athlete::class, $expected);
        $this->assertDatabaseCount(Athlete::class, 1);
    }
}
