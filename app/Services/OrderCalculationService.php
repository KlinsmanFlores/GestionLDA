<?php
namespace App\Services;

/**
 * Class OrderCalculationService
 *
 * Servicio encargado de los cálculos de un pedido 
 * - subtotal (pvp × cantidad)
 * - IGV (18% sobre el subtotal)
 * - total (subtotal + IGV)
 * - volumen total (volumen_unitario × cantidad)
 * - peso total (peso × cantidad)
 */
class OrderCalculationService
{
    
    private const IGV_RATE = 0.18;

    public function calculateSubtotal(array $items): float
    {
        $subtotal = 0.0;
        foreach ($items as $item) {
            // precio unitario por cantidad
            $subtotal += $item['pvp'] * $item['cantidad'];
        }
        return round($subtotal, 2);
    }

    /**
     * Calcula el IGV a partir del subtotal.
     *
      */
    public function calculateIGV(float $subtotal): float
    {
        return round($subtotal * self::IGV_RATE, 2);
    }

    /**
     * Calcula el total del pedido (subtotal + IGV).
     *    
     */
    public function calculateTotal(float $subtotal, float $igv): float
    {
        return round($subtotal + $igv, 2);
    }

    /**
     * Calcula el volumen total del pedido.
     *
     * @param  array $items
     *         Cada ítem debe incluir:
     *           - 'volumen_unitario' (float): en m³
     *           - 'cantidad' (int)
     * @return float Volumen total redondeado a 2 decimales.
     */
    public function calculateVolumen(array $items): float
    {
        $volumenTotal = 0.0;
        foreach ($items as $item) {
            // volumen unitario por cantidad
            $volumenTotal += $item['volumen_unitario'] * $item['cantidad'];
        }
        return round($volumenTotal, 2);
    }

    /**
     * Calcula el peso total del pedido.
     *
     * @param  array $items
     *         Cada ítem debe incluir:
     *           - 'peso' (float): en kg
     *           - 'cantidad' (int)
     * @return float Peso total redondeado a 2 decimales.
     */
    public function calculatePeso(array $items): float
    {
        $pesoTotal = 0.0;
        foreach ($items as $item) {
            // peso unitario por cantidad
            $pesoTotal += $item['peso'] * $item['cantidad'];
        }
        return round($pesoTotal, 2);
    }
}
