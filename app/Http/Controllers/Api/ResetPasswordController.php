<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function send_email_with_reset_password(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);
        $email = $request->email;
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return response([
                'message' => 'Email not exist.',
                'status' => 'failed'
            ],404);
        }

        $token = Str::random(60);
        ResetPassword::create([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // dd("http://127.0.0.1:3000/api/reset/".$token);

        Mail::send('reset', ['token'=>$token],function(Message $message)use($email){
            $message->subject('Reset your password.');
            $message->to($email);
        });

        return response([
            'message' => 'Resent mail sent ... Check now.',
            'status' => 'success'
        ]);
    }

    public function reset(Request $request, $token){
        // Delete Token older than 2 minute
        $formatted = Carbon::now()->subMinutes(2)->toDateTimeString();
        PasswordReset::where('created_at', '<=', $formatted)->delete();

        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $passwordreset = PasswordReset::where('token', $token)->first();

        if(!$passwordreset){
            return response([
                'message'=>'Token is Invalid or Expired',
                'status'=>'failed'
            ], 404);
        }

        $user = User::where('email', $passwordreset->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token after resetting password
        PasswordReset::where('email', $user->email)->delete();

        return response([
            'message'=>'Password Reset Success',
            'status'=>'success'
        ], 200);
    }
}
