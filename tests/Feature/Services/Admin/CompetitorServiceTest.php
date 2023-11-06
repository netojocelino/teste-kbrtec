<?php

namespace Tests\Feature\Services\Admin;

use App\Exceptions\ChampionshipClosesRegisterException;
use App\Models\Athlete;
use App\Models\Championship;
use App\Models\Competitor;
use App\Services\Admin\CompetitorService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompetitorServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testMustCreateCompetitorWithAllValidData(): void
    {
        $athlete = Athlete::factory()->create();
        $championship = Championship::factory([
            'phase' => 'open_register',
        ])->create();

        $service = new CompetitorService;
        $competitor = $service->store($athlete, $championship);
        $expcted = [
            'belt'            => $competitor->belt,
            'weight'          => $competitor->weight,
            'team'            => $competitor->team,
            'championship_id' => $competitor->championship_id,
            'athlete_id'      => $competitor->athlete_id,
        ];

        $this->assertDatabaseHas(Competitor::class, $expcted);
        $this->assertDatabaseCount(Competitor::class, 1);
    }



    public function testShouldNotCreateCompetitorWithFightingPhase(): void
    {
        $athlete = Athlete::factory()->create();
        $championship = Championship::factory([
            'phase' => 'fighting',
        ])->create();

        $service = new CompetitorService;

        $this->expectException(ChampionshipClosesRegisterException::class);
        $this->expectExceptionMessage(__('validation.prohibited_unless', [
            'attribute' => __('validation.attributes.subscription'),
            'other'     => __('validation.attributes.phase'),
            'values'    => __('validation.attributes.open_register'),
        ]));
        $service->store($athlete, $championship);
    }
}
