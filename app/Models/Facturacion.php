<?php
// app/Models/Facturacion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    protected $table = 'facturacions';    // o 'facturas' si renombraste la tabla
    protected $primaryKey = 'id_facturacion';
    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'serie',
        'correlativo',
        'ruc',
        'razon_social',
        'direccion',
        'medio_pago',   // <— aquí
        'fecha',
        'subtotal',
        'igv',
        'total',
    ];

    /**
     * Relación con Cliente (tabla clientes)
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
