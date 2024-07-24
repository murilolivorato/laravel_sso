<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdminRole extends Model
{
    use HasFactory;
    protected $table    =  'user_admin_roles';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'title',
        'label'
    ];

    public function users(){
        return $this->belongsToMany(UserAdmin::class , 'user_user_admin_roles' , 'role_id' , 'user_id');
    }
}
