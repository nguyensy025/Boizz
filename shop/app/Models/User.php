<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function checkPermissionAccess($permissionCheck){
        // B1: Lay duoc cac quyen cua user dang login he thong
        // B2: So sanh gia tri dua vao cua route hien tai xem co ton tai trong cac quyen ma minh lay duoc hay khong
        $roles = auth()->user()->roles;
        foreach($roles as $role){
            $permissions = $role->permissions;
            if($permissions->contains('key_code', $permissionCheck)){
                return true;
            }
        }
        return false;
    }
}
