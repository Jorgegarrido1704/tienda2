<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class personal extends Model
{
    //
    protected $table = 'personal';
    protected $primaryKey = 'id';
    protected $fillable = [ 'nombre', 'numEmp', 'puesto'];
    public $timestamps = false;

}
