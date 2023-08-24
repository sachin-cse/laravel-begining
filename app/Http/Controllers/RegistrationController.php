<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models;
use App\Models\UserRegistration;

class RegistrationController extends Controller
{
    //indec page
    public function index(){
        return view('form');
    }

    // save records
    public function register(Request $request){
        $rules =
            [
            'name' => 'required',
            'email' => 'required|email',
            'pass' => 'required'
            ];
        // print_r($request->all());
        $validator = Validator::make($request->all(), $rules);
        // print_r($validator); exit;
        if($validator->fails()){
            return redirect('/register')->withInput()->withErrors($validator);
        } else {
            $data = $request->input();
            try{
                $user = new UserRegistration;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = $data['pass'];
                $user->save();
                return redirect('/register')->with('status', 'registration successfully');
            }
            catch(Exception $e){
                return redirect('/register')->with('failed', 'registeration failed');
            }
        }
    }
}
