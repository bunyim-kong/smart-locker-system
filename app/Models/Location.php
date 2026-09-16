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

    public function locker()

    {
        return $this-> hasMany(Locker::class);
    }
}
