<?php

namespace App\Http\Controllers\Traits;

use App\Models\UserAdmin;

trait UserAdminTable
{
    /**
     * @return bool
     */
    public function ownedBy(UserAdmin $user)
    {
        return $this->user_id == $user->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo(UserAdmin::class, 'user_id');
    }
}
