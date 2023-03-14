<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;


class CustomAuthcontroller extends Controller
{
    
   
    function login(){
         return view('auth.login');   
    }
    function registration(){
        return view('auth.registration');
    }


    //for registration page validation
    function registerUser(Request $req){
        $this->validate($req,
        [
            'name'=> 'required|unique:users',
            'password'=>'required|string|min:5|max:8',
            "conf_password"=>"required|same:password",
            'email'=>'required|email|unique:users'
        ]);

        $user = new User();
        $user->name = $req->name;
        $user->password= Hash::make($req->password);
        $user->email = $req->email;
        $res = $user->save(); //insert query will run
        if($res){
        //return back()->with('success','You have registered successfully');
        return redirect('login')->with('success','You have registered successfully');
        }
        else{
            return back()->with('fail','Sorry something wrong.');  
        }
    }




    ////////////////////////it works in middleware////////////////////////////////
    // function loginUser(Request $request){
    //     $this->validate($request,
    //         [
    //             'password'=>'required|',
    //             'email'=>'required|email|'
    //         ]);
    //      $request->session()->put('data', $request->all());
    //      //return session()->get('data');
    //      if($request->session()->has('data')){
    //         return redirect('products');
    //      }
    // }



 //for login page validation
    function loginUser(Request $request){
        $this->validate($request,
        [
            'password'=>'required|',
            'email'=>'required|email|'
        ]);
         
        $user = User::where('email','=',$request->email)->first();
        if($user){
            if (Hash::check($request->password, $user->password)){
              $request->Session()->put('loginId', $user->id);
                return redirect('products');
            }
            else{
                return back()->with('fail','The password not matches'); 
            }
        }
        else{
            return back()->with('fail','The email not matches'); 
        }
    
    }


        function logout(){
            if(Session::has('loginId')){
                Session::pull('loginId');
                return redirect('login');
            }
        }



}
