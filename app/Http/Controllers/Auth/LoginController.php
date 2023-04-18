<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(User $user)
    {
        auth()->login($user);

        return redirect()->route('home');
    }
}
