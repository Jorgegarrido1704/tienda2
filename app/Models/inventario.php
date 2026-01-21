<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    //
    protected $table = 'inventario';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['codigo', 'product', 'qty', 'CONTADO', 'precio1', 'precio2', 'precio3', 'precio4', 'precio5', 'precio6', 'precio7',
        'precio8', 'precio9', 'precio10', 'precio11', 'precio12', 'semanal1', 'semanal2', 'semanal3', 'semanal4', 'semanal5', 'semanal6',
        'semanal7', 'semanal8', 'semanal9', 'semanal10', 'semanal11', 'semanal12', 'categoria', 'anoPrecio'];
}
