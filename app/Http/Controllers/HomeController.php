<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
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
        $city = City::where('idUser', $user) -> first();

        if ($city !== null)
            return redirect('/board');
        else return view('nameCity');

    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->currentPassword, $user->password)) {
            return redirect()->back()->withErrors(['currentPassword' => 'Aktualne hasło jest nieprawidłowe.']);
        }
        if($request->newPassword !== $request->confirmPassword){
            return redirect()->back()->withErrors(['confirmPassword' => 'Nowe hasła nie są takie same.']);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return view('layouts.error', [
            'messege' => 'Hasło zostało zmienione.'
        ]);
    }
    public function create(){
        return view('changePassword');
    }
}
