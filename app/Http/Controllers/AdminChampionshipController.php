<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChampionshipRequest;
use App\Http\Requests\UpdateChampionshipRequest;
use App\Models\City;
use App\Models\State;
use App\Services\Admin\ChampionshipService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminChampionshipController extends Controller
{
    protected ChampionshipService $championshipService;

    public function __construct()
    {
        $this->championshipService = new ChampionshipService;
    }

    public function index()
    {
        $search = request()->query();
        $championships = $this->championshipService->list($search);
        $user = auth()->user();

        return view('admin.championship.index', compact([
            'championships',
            'search',
            'user',
        ]));
    }

    public function create ()
    {
        $user = auth()->user();
        $states = State::get(['id', 'name']);

        return view('admin.championship.create', compact([
            'user',
            'states',
        ]));
    }

    public function edit (int $id)
    {
        $championship = $this->championshipService->getById($id);
        $user = auth()->user();

        return view('admin.championship.edit', compact([
            'championship',
            'user',
        ]));
    }

    public function destroy (Request $request, int $id)
    {
        DB::beginTransaction();

        try {
            $this->championshipService->delete($id);

            DB::commit();
            return response()->json([], JsonResponse::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'error' => $th->getMessage(),
                'code' => $th->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store (StoreChampionshipRequest $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $state = State::find($data['state_id'], ['name', 'abbr']);
            $city = City::find($data['city_id'], ['name']);
            data_set($data, 'city_state', $city->name . " (".$state->abbr.")");

            $championship = $this->championshipService->store($data);
            $championship->cover = $request->file('image');

            DB::commit();
            return redirect()->route('admin.championship.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->withInput()->withErrors([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update (UpdateChampionshipRequest $request, int $championship_id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $championship = $this->championshipService->update($championship_id, $data);
            if ($request->hasFile('image'))
            {
                $championship->cover = $request->file('image');
            }

            DB::commit();
            return redirect()->route('admin.championship.edit', [
                'championship' => $championship_id,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->withInput()->withErrors([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function listFeatures (Request $request)
    {
        $championships = $this->championshipService->features();
        $user = auth()->user();

        return view('admin.championship.features.index', compact([
            'championships',
            'user',
        ]));
    }


    public function updateFeatures (Request $request, int $championship_id )
    {
        DB::beginTransaction();

        try {
            $championship = $this->championshipService->changeFeature($championship_id);

            DB::commit();
            return response()->json([
                'isFeature' => (bool)$championship->feature_order,
            ], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'error' => $th->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
