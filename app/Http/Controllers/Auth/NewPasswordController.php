<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $loginField = filter_var(
            $request->input('login'),
            FILTER_VALIDATE_EMAIL
        )
            ? 'email'
            : 'username';
        $request->merge([$loginField => $request->input('login')]);
        $request->validate([
            'email' => 'required_without:username|email|exists:users,email',
            'username' =>
            'required_without:email|string|exists:users,username'
        ]);
        $status = Password::sendResetLink(
            $request->only($loginField)
        );
        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }
        throw ValidationException::withMessages([
            $loginField => [trans($status)],
        ]);
    }
}
