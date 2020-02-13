<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guard = 'barber';
    protected $table = 'services';

    protected $fillable = [
        'name', 'description', 'value', 'time'
    ];

    protected $casts = [
        'value' => 'float',
        'barbers_id' => 'int',
    ];
}
