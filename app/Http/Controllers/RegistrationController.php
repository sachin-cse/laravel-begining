<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models;
use App\Models\UserRegistration;
use Brian2694\Toastr\Facades\Toastr;


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
            'msg' => 'required',
            'attachment' => 'required|nullable|max:2048',
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
                $user->message = $data['msg'];

                // handle the upload
                if($request->hasFile('attachment')){
                    $attachment = $request->file('attachment');
                    $extension = $attachment->getClientOriginalExtension();

                    if(!in_array($extension, ['pdf', 'doc', 'docx', 'csv', 'xlsx'])){
                        return redirect('/register')->with('failed', 'Invalid file format');
                    }

                    // echo($extension); exit;
                    // print_r($attachment); exit;
                    $attachmentName = time() . '_' . $attachment->getClientOriginalName();
                    $attachment->move(public_path('media'), $attachmentName);
                    $user->attachment = $attachmentName;
                }
                $user->save();

                // send receipt with email address
                $emailData = [
                    'email' => $user->email,
                    'title' => 'File Attachment Confirmation',
                    // 'body' => 'hare keishna',
                ];

                $attachmentpath = public_path('media/' . $user->attachment);
                Mail::send('emails.Registration_receipt', $emailData, function ($message) use ($emailData, $attachmentpath){
                    $message->to($emailData['email'])->subject($emailData['title'])->attach($attachmentpath);
                });
                return redirect('/register')->with('status', 'attachement sent successfully given your respective email address');
            }
            catch(Exception $e){
                return redirect('/register')->with('failed', 'something is wrong');
            }
        }
    }
}
