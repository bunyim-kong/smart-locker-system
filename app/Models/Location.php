<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'map_link',
    ];
    // public function lockers(): HasMany

    // {
    //     return $this-> hasMany(locker::class) 
    //         ->orderBy('title');
    // }
}
