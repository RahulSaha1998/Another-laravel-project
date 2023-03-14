<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\models\Product;
use App\models\User;
use Illuminate\Support\Facades\File;
use Session;

class ProfileController extends Controller
{
    function profile(){
        $users = User::paginate(1);
        return view('profile.profile', compact('users'));
    }


    function editprofile($id){
        $users = User::find($id);
        return view('profile.editProfile', compact('users'));
    }

    function update(Request $request, $id){
        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
       // $user->password = $request->input('password');
        
        $user->update();
        return redirect()->back()->with('status', 'Profile Update Successfully!');
    }
}
