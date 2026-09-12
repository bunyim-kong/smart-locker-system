<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'locations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'map_link',
    ];

    public function locker() {
        return $this -> hasMany(Locker::class);
    }
}
