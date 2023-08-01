<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    public function impersonate(User $user)
    {
        Auth::user()->impersonate($user);
        return redirect()->route('index');
    }

    public function impersonate_vendor(User $user)
    {
        if($user->group_id != "16" and $user->group_id != "32"){
            return back();
        }
        Auth::user()->impersonate($user);
        return redirect()->route('index');
    }

    public function impersonate_leave()
    {
        Auth::user()->leaveImpersonation();
        return redirect()->route('index');
    }

}
