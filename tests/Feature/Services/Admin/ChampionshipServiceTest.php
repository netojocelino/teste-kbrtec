<?php

namespace Tests\Feature\Services\Admin;

use App\Exceptions\DuplicateRecord;
use App\Exceptions\InvalidAttributeUpdateException;
use App\Models\Championship;
use App\Services\Admin\ChampionshipService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ChampionshipServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testMustCreateChampionshipWithAllValidData(): void
    {
        $data = Championship::factory()->make([
            'title' => 'Campeonato da KBRTec',
            'city_state' => 'Santos, São Paulo',
        ])->toArray();
        $service = new ChampionshipService;

        $service->store($data);

        $this->assertDatabaseHas(Championship::class, $data);
        $this->assertDatabaseCount(Championship::class, 1);
    }

    public function testShouldCreateChampionshipWhenHasConstraintInfoExistentEceptDate(): void
    {
        $title      = 'Campeonato da equipe KBRTec';
        $city_state = 'Santos, São Paulo';
        $gym_place  = "Vila Mathias";
        Championship::factory()->create(compact([
            'title', 'city_state', 'gym_place'
        ]));
        $data = Championship::factory()->make(compact([
            'title', 'city_state', 'gym_place'
        ]))->toArray();

        $service = new ChampionshipService;
        $service->store($data);

        $this->assertDatabaseHas(Championship::class, $data);
        $this->assertDatabaseCount(Championship::class, 2);
    }

    public function testShouldNotCreateChampionshipWhenHasConstraintInfoExistent(): void
    {
        $title      = 'Campeonato da equipe KBRTec';
        $city_state = 'Santos, São Paulo';
        $gym_place  = "Vila Mathias";
        $date       = now()->addDays(2)->format('Y-m-d');
        Championship::factory()->create(compact([
            'title', 'city_state', 'gym_place', 'date'
        ]));
        $data = Championship::factory()->make(compact([
            'title', 'city_state', 'gym_place', 'date'
        ]))->toArray();
        $service = new ChampionshipService;

        // Exception test
        $this->expectException(DuplicateRecord::class);
        $this->expectExceptionMessage(__('validation.unique', [
            'attribute' => 'title',
        ]));
        $service->store($data);
    }

    public function testShouldListEmptyWhenChampioshipIsEmpty(): void
    {
        $service = new ChampionshipService;

        $data = $service->list();

        $this->assertCount(0, $data);
        $this->assertDatabaseCount(Championship::class, 0);
    }

    public function testShouldListWithThree(): void
    {
        $service = new ChampionshipService;
        Championship::factory(3)->create();

        $data = $service->list();

        $this->assertCount(3, $data);
        $this->assertDatabaseCount(Championship::class, 3);
    }

    public function testShouldFilterChampioshipByTitle(): void
    {
        $title = 'Campeonato da KBRTec';
        $service = new ChampionshipService;
        Championship::factory(3)->create();
        $champ = Championship::factory()->create([
            'title' => $title,
        ]);

        $data = $service->list([
            'name' => $title,
        ]);

        $this->assertCount(1, $data);
        $this->assertEquals($title, $data[0]['title']);
        $this->assertDatabaseCount(Championship::class, 4);
    }

    public function testShouldViewChampioship(): void
    {
        $title = 'Campeonato da KBRTec';
        $service = new ChampionshipService;
        $champ = Championship::factory()->create([
            'title' => $title,
        ]);

        $data = $service->getById($champ->id);

        $this->assertJson($data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('code', $data);
        $this->assertArrayHasKey('date', $data);
        $this->assertDatabaseCount(Championship::class, 1);
    }

    public function testShouldUpdateTitleChampionshipSuccessfullyWhenHasAllData(): void
    {
        $title = 'Campeonato da KBRTec';
        $service = new ChampionshipService;
        $champ = Championship::factory()->create();

        $data = $service->update($champ->id, compact([
            'title',
        ]));

        $this->assertJson($data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('code', $data);
        $this->assertArrayHasKey('date', $data);
        $this->assertDatabaseCount(Championship::class, 1);
        $this->assertDatabaseHas(Championship::class, [
            'id' => $champ->id,
            'title' => $title,
        ]);
    }


    public function testMustNotUpdateCodeChampionship(): void
    {
        $title = 'Campeonato da KBRTec';
        $code = 'C-001';
        $service = new ChampionshipService;
        $champ = Championship::factory()->create();


        // Exception test
        $this->expectException(InvalidAttributeUpdateException::class);
        $this->expectExceptionMessage(__('validation.prohibited', [
            'attribute' => 'code',
        ]));

        $data = $service->update($champ->id, compact([
            'code',
            'title',
        ]));
    }

    public function testShouldDeleteChampionshipById(): void
    {
        $service = new ChampionshipService;
        $champ = Championship::factory()->create();

        $isDeleted = $service->delete($champ->id);

        $this->assertDatabaseCount(Championship::class, 1);
        $this->assertDatabaseMissing(Championship::class, $champ->toArray());
        $this->assertTrue($isDeleted);
    }

}
