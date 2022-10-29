<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangeUserPassordController extends Controller
{
    //
    public function index(){
        return view('auth.change-password');
    }
    public function update(Request $request){
        $user=$request->user();
        $request->validate([
            //current_password :check if the password old same new password
            'password'=>['required','current_password'],
            //confirmed : cheack the tow colum are identical
            'new_password'=>['required','min:8','confirmed']
        ]);
        $user->forceFill([
            'password' => Hash::make($request->post('new_password')),
            'remember_token' => null,
        ])->save();

        //use force fill to update if the coulmn not in fillabel
        // $request->forceFill([
        //     'password'=>Hash::make($request->post('new_password')),
        //     'remember_token'=>null,//or cane use randome number
        // ])->save();

        return redirect()->route('profile')
        ->with('success','Password Updated !');

    }
}
