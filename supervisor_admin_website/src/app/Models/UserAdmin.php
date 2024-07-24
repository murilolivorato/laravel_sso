<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class UserAdmin extends Authenticatable
{
    use HasApiTokens, HasFactory , Notifiable;

    protected $table = 'user_admins';

    protected $fillable = [
        'status',
        'email',
        'folder',
        'auth_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getisAdminAttribute()
    {
        return $this->hasRole('admin');
    }

    public function getisPublisherAttribute()
    {
        return $this->hasRole('publisher');
    }

    // ADMIN INFO
    public function AdminInfo()
    {
        return $this->hasOne(UserAdminInfo::class, 'user_id');
    }

    public function UserInfo($attribute)
    {
        if ($this->isAdmin) {
            return $this->AdminInfo->{$attribute};
        }
    }

    /*  public function ImageProfile() {
          return $this->hasOne(UserAdminProfileImage::class , 'user_id');
      }*/

    public function getPathURLAttribute()
    {
        return '/assets/files/users';
    }

    public function getPathURLTempAttribute()
    {
        return '/assets/temp';
    }
}
