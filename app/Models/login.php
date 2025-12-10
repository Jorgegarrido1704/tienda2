<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class login extends Model
{
    //
    private $table = 'logins';

    protected $fillable = ['username', 'password', 'role'];

    public $timestamps = true;
}
