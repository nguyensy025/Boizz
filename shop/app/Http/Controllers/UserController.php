<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function login(){
        return view('account.login');
    }

    public function register(){
        return view('account.register');
    }

    public function postRegister(Request $request){
        // Chua validate
        try{
            DB::beginTransaction();


            DB::commit();
        } catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }
    }
}
