<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'map_link',
    ];

    public function lockers()

    {
        return $this-> hasMany(Locker::class);
    }
}
