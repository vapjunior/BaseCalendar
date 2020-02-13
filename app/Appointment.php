<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guard = 'web';
    protected $table = 'appointment';

    protected $fillable = [
        'date','time','time_final','client_id','barbers_id','service_id',
    ];

    protected $casts = [
        'date' => 'datetime',
        'time' => 'time',
        'client_id' => 'int',
        'barbers_id' => 'int',
        'service_id' => 'int',
    ];
}
