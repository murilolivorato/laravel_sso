<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class UserAdmin extends Authenticatable
{
    use HasFactory,   Notifiable , HasApiTokens;


    protected $table    =  'user_admins';
    protected $fillable = [
        'status',
        'email',
        'folder'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function Roles(){
        return $this->belongsToMany(UserAdminRole::class , 'user_user_admin_roles' , 'user_id' , 'role_id' );
    }


    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->Roles->contains('title', $role);
        }
    }


    public function AcessAreas(){
        return $this->belongsToMany(UserAdminAccessArea::class , 'user_admin_user_admin_access_areas' , 'user_id' , 'area_id' );
    }


    public function hasAcessArea($role)
    {
        if (is_string($role)) {
            return $this->Roles->contains('title', $role);
        }
    }


    public function ManagerAreas(){
        return $this->belongsToMany(UserAdminAccessArea::class , 'user_admin_managers' , 'user_id' , 'area_id' );
    }




    public function getisAdminAttribute(){
        return $this->hasRole('admin');
    }

    public function getisPublisherAttribute(){
        return $this->hasRole('publisher');
    }


    // EMPRESA
    public function AdminInfo(){
        return $this->hasOne(UserAdminInfo::class, 'user_id');
    }


    public function UserInfo($attribute)
    {
        if($this->isAdmin){
            return $this->AdminInfo->{$attribute};
        }
    }

}
