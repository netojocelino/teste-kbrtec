<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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
        return view('admin.users.reset_password');
    }

    public function requestPassword (NewPasswordRequest $request)
    {

        $status = Password::sendResetLink(
            $request->validated()
        );

        return $status === Password::RESET_LINK_SENT
                    ? redirect()->route('login', $request->validated())
                        ->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
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

    public function getResetPassword (string $token)
    {
        return view('admin.users.reset-password', ['token' => $token]);
    }

    public function postResetPassord (ResetPasswordRequest $request)
    {
        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');
        $status = Password::reset(
            $credentials,
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET)
        {
            auth()->attempt($request->only('email', 'password'));
            auth()->user()->createToken(config('app.key'));
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }

}
