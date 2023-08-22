<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    //indec page
    public function index(){
        return view('form');
    }

    // save records
    public function register(Request $request){
        $request->validate(
            [
            'name' => 'required',
            'email' => 'required|email',
            'pass' => 'required'
            ]
        );
        print_r($request->all());
    }
}
