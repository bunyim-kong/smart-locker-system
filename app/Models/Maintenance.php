<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    //
    protected $table = 'maintenances';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'locker_id',
        'issue_des',
        'report_date',
        'resolve_date',
    ];

    public function user() {
        return $this -> belongsTo(User::class);
    }

    public function locker() {
        return $this -> belongsTo(Locker::class);
    }
}
