<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkCity()
    {
        $city = City::where("idUser", Auth::id())->first();
        if ($city !== null)
            return redirect('/board');
        else return view('nameCity');

    }
    public function changePassword(Request $request)
    {
        if(!(Hash::check($request->get('current_password'),Auth::user()->password))){
            return back()->with('error','Your current password doesnt\' match with what you provided');
        }
        else dd("dziala");
    }
    public function create(){
        return view('changePassword');
    }
}
