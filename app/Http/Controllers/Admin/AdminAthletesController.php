<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AthleteService;
use Illuminate\Http\Request;

class AdminAthletesController extends Controller
{
    protected AthleteService $athleteService;

    public function __construct()
    {
        $this->athleteService = new AthleteService;
    }

    public function index (Request $request)
    {
        $search = request()->query();
        $athletes = $this->athleteService->query()->paginate();
        $user = auth()->user();

        return view('admin.athletes.index', compact([
            'user',
            'athletes',
            'search'
        ]));
    }
}
