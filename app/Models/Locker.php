<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    //
    protected $table = 'lockers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'location_id',
        'name',
        'status',
    ];

    public function location() {
        return $this -> belongsTo(Location::class);
    }

    public function history() {
        return $this -> hasMany(History::class);
    }

    public function maintenance() {
        return $this -> hasMany(Maintenance::class);
    }
}
