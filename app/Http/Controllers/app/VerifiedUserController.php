<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class VerifiedUserController extends Controller
{
    public function VerifiedUser($id){
        $user = User::findOrFail($id);

        if($user){
            $user->is_verified = 1;
            $user->save();


        }
    }

    public function UnverifiedUser($id){
        $user = User::findOrFail($id);

        if($user){
            $user->is_verified = 0;
            $user->save();
        }
    }
}
