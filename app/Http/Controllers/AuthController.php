<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function verify(Request $request) {
        $user = User::where("email", $request->email)->first();
        if($user){
            $user->update([
                "is_verified" => 1,
                "email_verified_at" => now()
            ]);
        }
        return redirect("/");
    }
}
