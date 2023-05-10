<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Request;
use App\Http\Traits\GlobalTrait;

class HomeController extends Controller
{
    use GlobalTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkCityExists()
    {
        $user = Auth::id();
        $city = $this->getCity($user);
        if ($city !== null)
            return redirect('/board');
        else return view('nameCity');

    }
    public function changePassword(Request $request)
    {

    }
    public function create(){
        return view('changePassword');
    }
}
