<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $request->merge(['password'=>Hash::make($request->password)]);

        try{
            DB::beginTransaction();
            User::create($request->all());

            DB::commit();
        } catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }

        return redirect()->route('user.login');
    }

    public function portLogin(Request $request){
        try{
            DB::beginTransaction();
            // dd($request->password);
            if (Auth::attempt([
                'email' => $request->email, 
                'password' => $request->password
            ])){
                return redirect()->route('home.index');
            }
            // return redirect()->back()->with('error', 'Sai tài khoản hoặc mật khẩu');

            DB::commit();
        } catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }
    }
}
