<?php

namespace App\Http\Controllers\Traits;

use App\Models\Provider;

trait ProviderTable
{
    public function Provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
