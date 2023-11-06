<?php

namespace Tests\Feature\Services\Admin;

use App\Exceptions\DuplicateRecord;
use App\Exceptions\InvalidAttributeUpdateException;
use App\Helpers\Helpers;
use App\Models\Athlete;
use App\Models\Championship;
use App\Models\Competitor;
use App\Models\CompetitorGroups;
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

    public function testShouldCreateChampionshipWhenHasConstraintInfoExistentExceptDate(): void
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
            'attribute' => __('validation.attributes.title'),
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
            'attribute' => __('validation.attributes.code'),
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

    public function testMustRegisterACompetitorForAChampionship(): void
    {
        $service = new ChampionshipService;
        $athlete = Athlete::factory()->make([])->toArray();
        $championship = Championship::factory()->create([
            'title'      => 'Campeonato da KBRTec',
            'city_state' => 'Santos (SP)',
            'phase'      => 'open_register',
        ]);

        $service->registerCompetitor($athlete, $championship);

        $championshipExpected = [
            'code'            => $championship->code,
            'title'           => $championship->title,
            'city_state'      => $championship->city_state,
            'city_id'         => $championship->city_id,
            'state_id'        => $championship->state_id,
            'date'            => $championship->date,
            'about'           => $championship->about,
            'gym_place'       => $championship->gym_place,
            'info'            => $championship->info,
            'public_entrance' => $championship->public_entrance,
            'type'            => $championship->type,
            'phase'           => $championship->phase,
            'active_status'   => $championship->active_status,
            'feature_order'   => $championship->feature_order,
        ];
        $athleteExpected = [
            'code'            => $athlete['code'],
            'full_name'       => $athlete['full_name'],
            'birthdate'       => $athlete['birthdate'],
            'document_number' => Helpers::onlyNumbers($athlete['document_number']),
            'team'            => $athlete['team'],
            'gender'          => $athlete['gender'],
            'belt'            => $athlete['belt'],
            'weight'          => $athlete['weight'],
            'email'           => $athlete['email'],
        ];
        $competitorExpected = [
            'belt'   => $athlete['belt'],
            'weight' => $athlete['weight'],
            'team'   => $athlete['team'],

            'championship_id' => $championship->id,
            // 'athlete_id'      => $athlete->id,
        ];

        $this->assertDatabaseHas(Championship::class, $championshipExpected);
        $this->assertDatabaseCount(Championship::class, 1);
        $this->assertDatabaseHas(Athlete::class, $athleteExpected);
        $this->assertDatabaseCount(Athlete::class, 1);
        $this->assertDatabaseHas(Competitor::class, $competitorExpected);
        $this->assertDatabaseCount(Competitor::class, 1);
    }

    public function ttestMustStartFightingPhaseForChampionship(): void
    {
        $championship = Championship::factory()->create([
            'title' => 'Campeonato da KBRTec',
            'city_state' => 'Santos, São Paulo',
            'phase' => 'open_register'
        ]);
        $service = new ChampionshipService;

        $service->startFighting($championship->id);

        $this->assertDatabaseHas(Championship::class, [
            'id' => $championship->id,
            'phase' => 'fighting',
        ]);
        $this->assertDatabaseCount(Championship::class, 1);
    }

    public function testMustStartFightingPhaseForChampionshipAndCreateLightBrownMaleGroups(): void
    {
        $competitorCount = 10;
        $championship = Championship::factory()->create([
            'title' => 'Campeonato da KBRTec',
            'city_state' => 'Santos, São Paulo',
            'phase' => 'open_register'
        ]);
        $service = new ChampionshipService;
        for ($i=0; $i < $competitorCount; $i++) {
            $athlete = Athlete::factory()->create([
                'gender' => 'male',
                'belt'   => 'brown',
                'weight' => 'light',
            ]);
            Competitor::factory()->create([
                'belt'   => 'brown',
                'weight' => 'light',
                'team'   => $athlete->team,
                "championship_id" => $championship->id,
                "athlete_id"      => $athlete->id,

            ]);
        }

        $champ = $service->startFighting($championship->id);

        $this->assertDatabaseHas(Championship::class, [
            'id' => $championship->id,
            'phase' => 'fighting',
        ]);
        $this->assertDatabaseCount(Championship::class, 1);
        $this->assertDatabaseCount(Competitor::class, $competitorCount);
        $this->assertDatabaseCount(CompetitorGroups::class, ceil($competitorCount/2));
        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'            => 'brown',
            'weight'          => 'light',
            'match_level'     => 1,
            'championship_id' => $championship->id,
        ]);
    }

    public function testMustStartFightingPhaseForChampionshipWithTwoKindsOfGroup(): void
    {
        $competitorCount = 9;
        $championship = Championship::factory()->create([
            'title' => 'Campeonato da KBRTec',
            'city_state' => 'Santos, São Paulo',
            'phase' => 'open_register'
        ]);
        $service = new ChampionshipService;
        for ($i=0; $i < $competitorCount; $i++) {
            $athleteA = Athlete::factory()->create([
                'gender' => 'male',
                'belt'   => 'brown',
                'weight' => 'light',
            ]);
            Competitor::factory()->create([
                'belt'   => 'brown',
                'weight' => 'light',
                'team'   => $athleteA->team,
                "championship_id" => $championship->id,
                "athlete_id"      => $athleteA->id,

            ]);
        }

        $athlete = Athlete::factory()->create([
            'gender' => 'female',
            'belt'   => 'black',
            'weight' => 'strong',
        ]);
        Competitor::factory()->create([
            'belt'   => 'black',
            'weight' => 'strong',
            'team'   => $athlete->team,
            "championship_id" => $championship->id,
            "athlete_id"      => $athlete->id,

        ]);

        $service->startFighting($championship->id);

        $this->assertDatabaseHas(Championship::class, [
            'id' => $championship->id,
            'phase' => 'fighting',
        ]);
        $this->assertDatabaseCount(Championship::class, 1);
        $this->assertDatabaseCount(Competitor::class, $competitorCount+1);
        $this->assertDatabaseCount(CompetitorGroups::class, ceil($competitorCount/2)+1);
        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'            => 'brown',
            'weight'          => 'light',
            'match_level'     => 1,
            'championship_id' => $championship->id,
        ]);
        $this->assertDatabaseHas(CompetitorGroups::class, [
            'first_athlete_id'  => $athlete->id,
            'second_athlete_id' => null,
            'belt'              => 'black',
            'weight'            => 'strong',
            'match_level'       => 1,
            'championship_id'   => $championship->id,
        ]);
    }

    public function testMustMarkAWinnerFighterForChampionshipWithTwoKindsOfGroup(): void
    {
        $competitorCount = 10;
        $championship = Championship::factory()->create([
            'title' => 'Campeonato da KBRTec',
            'city_state' => 'Santos, São Paulo',
            'phase' => 'open_register'
        ]);
        $service = new ChampionshipService;
        for ($i=0; $i < $competitorCount; $i++) {
            $athleteA = Athlete::factory()->create([
                'gender' => 'male',
                'belt'   => 'brown',
                'weight' => 'light',
            ]);
            Competitor::factory()->create([
                'belt'   => 'brown',
                'weight' => 'light',
                'team'   => $athleteA->team,
                "championship_id" => $championship->id,
                "athlete_id"      => $athleteA->id,

            ]);
        }

        $service->startFighting($championship->id);
        $service->winnerOfGroup($athleteA->id, $championship->id);

        $this->assertDatabaseHas(Championship::class, [
            'id' => $championship->id,
            'phase' => 'fighting',
        ]);
        $this->assertDatabaseCount(Championship::class, 1);
        $this->assertDatabaseCount(Competitor::class, $competitorCount);
        $this->assertDatabaseCount(CompetitorGroups::class, ceil($competitorCount/2)+1);
        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'            => 'brown',
            'weight'          => 'light',
            'match_level'     => 1,
            'championship_id' => $championship->id,
        ]);
        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'            => 'brown',
            'weight'          => 'light',
            'match_level'     => 1,
            'championship_id' => $championship->id,
        ]);

        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'              => 'brown',
            'weight'            => 'light',
            'match_level'       => 1,
            'winner_athlete_id' => $athleteA->id,
            'championship_id'   => $championship->id,
        ]);

        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'            => 'brown',
            'weight'          => 'light',
            'match_level'     => 2,
            'championship_id' => $championship->id,
        ]);
    }

    public function testSmallCompetitionComplete(): void
    {
        $competitorCount = 4;
        $championship = Championship::factory()->create([
            'title' => 'Campeonato da KBRTec',
            'city_state' => 'Santos, São Paulo',
            'phase' => 'open_register'
        ]);
        $service = new ChampionshipService;
        $teams = ['mugiwara', 'heart', 'red hair', 'barto club', 'tontatta', 'foxy'];

        for ($i=0; $i < $competitorCount; $i++) {
            $team = data_get($teams, random_int(0, count($teams)), $teams[0]);

            $athlete = Athlete::factory()->create([
                'gender' => 'male',
                'belt'   => 'brown',
                'weight' => 'light',
                'team'   => $team,
            ]);
            Competitor::factory()->create([
                'belt'   => 'brown',
                'weight' => 'light',
                'team'   => $team,
                "championship_id" => $championship->id,
                "athlete_id"      => $athlete->id,
            ]);
        }

        $service->startFighting($championship->id);

        $groups = CompetitorGroups::where([ 'championship_id' => $championship->id, 'match_level' => 1,])
            ->get('first_athlete_id')->pluck('first_athlete_id')->toArray();

        foreach ($groups as $i => $id) {
            $service->winnerOfGroup($id, $championship->id);
        }

        $groups = CompetitorGroups::where([ 'championship_id' => $championship->id, 'match_level' => 2,])
            ->get('first_athlete_id')->pluck('first_athlete_id')->toArray();

        foreach ($groups as $i => $id) {
            $service->winnerOfGroup($id, $championship->id);
        }

        $this->assertDatabaseHas(Championship::class, [
            'id' => $championship->id,
            'phase' => 'fighting',
        ]);
        $this->assertDatabaseCount(Championship::class, 1);
        $this->assertDatabaseCount(Competitor::class, $competitorCount);
        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'            => 'brown',
            'weight'          => 'light',
            'match_level'     => 1,
            'championship_id' => $championship->id,
        ]);
        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'            => 'brown',
            'weight'          => 'light',
            'match_level'     => 1,
            'championship_id' => $championship->id,
        ]);

        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'              => 'brown',
            'weight'            => 'light',
            'match_level'       => 1,
            'championship_id'   => $championship->id,
        ]);

        $this->assertDatabaseHas(CompetitorGroups::class, [
            'belt'            => 'brown',
            'weight'          => 'light',
            'match_level'     => 2,
            'championship_id' => $championship->id,
        ]);
    }

}
