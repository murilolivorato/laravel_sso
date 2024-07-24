<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdminAccessArea extends Model
{
    use HasFactory;
    protected $table    =  'user_admin_access_areas';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'title',
        'label',
        'url_title',
        'url'
    ];

    public function Users(){
        return $this->belongsToMany(UserAdmin::class , 'user_admin_user_admin_access_areas' , 'area_id' , 'user_id');
    }
}
