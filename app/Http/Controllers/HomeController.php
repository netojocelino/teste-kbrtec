<?php

namespace App\Http\Controllers;

use App\Services\Admin\ChampionshipService;
use Illuminate\Http\Request;

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
    }

}
