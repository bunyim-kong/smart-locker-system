<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    protected $fillable = [
        'name',
        'status',
        'location_id',
    ];

    // public function location()
    // {
    //     return $this->belongsTo(Location::class);
    // }

    // public function userHistories()
    // {
    //     return $this->hasMany(UserHistory::class);
    // }

    // public function maintenances()
    // {
    //     return $this->hasMany(Maintenance::class);
    // }
}
