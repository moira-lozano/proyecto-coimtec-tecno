<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ClienteController extends Controller
{
    
public function dashboard()
{
    return Inertia::render('Cliente/Dashboard', [
        'auth' => [
            'user' => Auth::user()
        ]
    ]);
}

}
