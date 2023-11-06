<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundRecord;
use App\Http\Requests\StoreAthleteRequest;
use App\Services\Admin\ChampionshipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected ChampionshipService $championshipService;

    public function __construct()
    {
        $this->championshipService = new ChampionshipService;
    }

    public function index (Request $request)
    {
        return response('home');
    }

    public function championships (Request $request)
    {
        $search = request()->query();
        $championships = $this->championshipService->list([
            'name'  => data_get($search, 'name'),
            'type'  => data_get($search, 'type'),
            'local' => array_filter([data_get($search, 'city'), data_get($search, 'state')]),
        ], data_get($search, 'per_page', 12));

        return view('athletes.admin.championship', compact([
            'championships',
            'search',
        ]));
    }

    public function showChampionship(string $championship)
    {
        $championship = $this->championshipService->getByCode($championship);

        return view('athletes.admin.show', compact([
            'championship',
        ]));
    }

    public function showChampionshipPhases(Request $request, int $championship_id)
    {
        $championship = $this->championshipService->getById($championship_id);
        $championshipGroups = $this->championshipService->getGroupsById($championship_id, $request->query());

        return view('athletes.admin.phases', compact([
            'championship',
            'championshipGroups',
        ]));
    }

    public function showChampionshipPhasesDetails(Request $request, int $championship_id, string $belt, string $weight, string $gender)
    {
        $championship = $this->championshipService->getById($championship_id);
        $championshipGroup = $this->championshipService->getGroupsById($championship_id, compact([
            'belt',
            'weight',
            'gender',
        ]));

        // dd($championshipGroup);

        return view('athletes.admin.view', compact([
            'championship',
            'championshipGroup',
        ]));
    }

    public function registerChampionship(string $championship)
    {
        $championship = $this->championshipService->getByCode($championship);

        return view('athletes.admin.create', compact([
            'championship',
        ]));
    }

    public function storeChampionship (StoreAthleteRequest $request, string $championshipCode )
    {
        DB::beginTransaction();

        try {
            if (!($championship = $this->championshipService->getByCode($championshipCode)))
            {
                throw new NotFoundRecord(__('validation.exists', [
                    'attribute' => __('validation.attributes.championship'),
                ]));
            }

            $competitor = $this->championshipService->registerCompetitor($request->validated(), $championship);
            DB::commit();

            return redirect()->back()->with([
                'success' => 'Criado com sucesso',
            ]); // ->withInput();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'message' => $th->getMessage(),
            ])->withInput();
        }

    }

}
