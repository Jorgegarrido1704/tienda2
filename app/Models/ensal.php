<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ensal extends Model
{
    //
    protected $table = 'ensal';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'fecha',
        'producto',
        'cantidad',
        'concepto',
    ];
}
