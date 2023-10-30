<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index (Request $request)
    {
        $user = (object) [
            'name' => 'Jocelino',
        ];

        return view('admin.users.index', compact(['user']));
    }
}
