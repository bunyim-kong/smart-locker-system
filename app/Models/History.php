<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class History extends Model
{
    protected $fillable = [
        'locker_id',
        'user_id',
        'start_time',
        'end_time',
    ];
    
    public function lockers(): HasMany

    {
        return $this-> hasMany(Locker::class) 
            ->orderBy('title');
    }
}
