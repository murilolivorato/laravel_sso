<?php

namespace App\Models;

use App\Http\Controllers\Traits\UserAdminTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdminInfo extends Model
{
    use HasFactory, UserAdminTable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = 'user_admin_infos';

    protected $fillable = [
        'name',
        'cpf',
        'code',
        'phone',
        'last_name',
        'manager_status',
        'user_admin_id',
    ];
}
