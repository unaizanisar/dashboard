<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permissions = $user->role->permissions->pluck('name')->toArray();
        // dd($user->role->permissions);
        // dd($permissions);
        return view('dashboard', compact('permissions'));
    }
}
