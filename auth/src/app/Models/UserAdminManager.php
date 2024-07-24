<?php

namespace App\Models;

use App\Http\Controllers\Traits\UserAdminTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdminManager extends Model
{
    use HasFactory, UserAdminTable;

    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $table    =  'user_admin_managers';
    protected $fillable = [
        'user_id',
        'area_id'
    ];
}
