<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locker extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }
}
