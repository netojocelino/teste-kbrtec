<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    public function index (Request $request)
    {
        $user = (object) [
            'name' => 'Jocelino',
        ];

        return view('admin.users.index', compact(['user']));
    }

    public function create (Request $request)
    {
        $user = (object) [
            'name' => 'Jocelino',
        ];

        return view('admin.users.create', compact(['user']));
    }

    public function edit (Request $request)
    {
        $user = (object) [
            'name' => 'Jocelino',
        ];

        return view('admin.users.edit', compact(['user']));
    }

    public function resetPassword (Request $request)
    {
        $user = (object) [
            'name' => 'Jocelino',
        ];

        return view('admin.users.reset_password', compact(['user']));
    }

    public function login (Request $request)
    {
        return view('admin.users.login');
    }

    public function authenticate (LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials))
        {
            return back()->withErrors([
                'error' => __('auth.failed'),
            ]);
        }

        auth()->user()->createToken(config('app.key'));

        return redirect()->route('admin.index');
    }

    public function logout (Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
