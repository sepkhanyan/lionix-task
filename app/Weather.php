<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected  $table = 'weathers';

    protected $fillable = [
        'time',
        'name',
        'lat',
        'long',
        'temp',
        'temp_min',
        'temp_max',
        'pressure',
        'humidity'
    ];

    public function getTimeAttribute($value)
    {
        return date('H:i', strtotime($value));
    }
}
