<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    //
    protected $table = 'ventas';

    public $fillable = ['fecha', 'semanal', 'meses', 'ruta',
        'cuenta', 'cliente', 'aval', 'domcli', 'espo', 'domaval',
        'col', 'ref2', 'domre2', 'promotor', 'ref1', 'vendedor',
        'cobrador', 'domref1', 'entrego', 'cantArt', 'articulo',
        'precio', 'enganche', 'saldo', 'estatus'];

    protected $primaryKey = 'id';

    public $timestamps = true;
}
