<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    protected $fillable = [
        'name',
        'size',
        'status',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function history() {
        return $this -> hasMany(History::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }
}
