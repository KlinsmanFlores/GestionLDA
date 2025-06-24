<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto'; // nombre exacto de tu tabla
    protected $primaryKey = 'id_producto'; // clave primaria personalizada

    protected $fillable = [
        'nombre',
        'peso',
        'unidad_medida',
        'alto',
        'ancho',
        'largo',
        'pvp',
        'costo_con_igv',
        'stock_mano',
        'stock_transito',
    ];

    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class, 'producto_id');
    }
}
