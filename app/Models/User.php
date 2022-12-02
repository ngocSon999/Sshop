<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];
    public function roles(){
        return $this->belongsToMany(Role::class,'user_roles','user_id','role_id');
    }
    public function checkPermissionAccess($permissionChek){
        //ví dụ user đc thm sửa danh mục và xem danh sách menu
        //bước 1: lấy tất cả các quyền của user đang login va hệ thống
        //bước 2 so sánh giá trị các quyền đưa vào route hiện tại xem có tồn tại trong các quyền lấy ra đc hay ko
        $roles = Auth()->user()->roles;
        foreach ($roles as $role){
            $permission= $role->permissionRoles;
            if($permission->contains('key_code',$permissionChek)){
                return true;
            }
        }
        return false;
    }
}
