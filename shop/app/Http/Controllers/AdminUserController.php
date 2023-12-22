<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{   
    use DeleteModelTrait;
    private $user;
    private $role;
    public function __construct(User $user, Role $role) {
        $this->user = $user;
        $this->role = $role;
    }

    public function index(){
        $users = $this->user->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create(){
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
    
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('user.index');
        } catch(\Exception $exception){
            DB::rollBack();
            Log::error("Message: " . $exception->getMessage() . '--- Line' . $exception->getLine());
        }

        // foreach($roleIds as $roleItem){
        //     DB::table('user_role')->insert([
        //         'user_id' => $user->id,
        //         'role_id' => $roleItem
        //     ]);
        // }
    }

    public function edit($id){
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $rolesUser = $user->roles;
        return view('admin.user.edit', compact('roles', 'user', 'rolesUser'));
    }

    public function update($id, Request $request){
        try{
            DB::beginTransaction();
            $user = $this->user->find($id);

            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => !empty($request->password) ? Hash::make($request->password) : $user->password,
            ]);
            
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('user.index');
        } catch(\Exception $exception){
            DB::rollBack();
            Log::error("Message: " . $exception->getMessage() . '--- Line' . $exception->getLine());
        }
    }

    public function delete($id){
        return $this->DeleteModelTrait($id, $this->user);
    }
}
