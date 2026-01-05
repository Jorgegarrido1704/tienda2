<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class abono extends Model
{
    //
    protected $table = 'abonos';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'fechab',
        'cuenta',
        'client',
        'abono',
        'noRec',
    ];
}
