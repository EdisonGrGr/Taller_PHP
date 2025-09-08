<?php

namespace App\Models;

class Venta
{
    private int $id;
    private string $cliente;
    private string $producto;
    private int $cantidad;
    private float $precioUnitario;
    private string $fecha;

    public function __construct(int $id, string $cliente, string $producto, int $cantidad, float $precioUnitario, string $fecha)
    {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->precioUnitario = $precioUnitario;
        $this->fecha = $fecha;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCliente(): string
    {
        return $this->cliente;
    }

    public function getProducto(): string
    {
        return $this->producto;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    public function getPrecioUnitario(): float
    {
        return $this->precioUnitario;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getTotal(): float
    {
        return $this->cantidad * $this->precioUnitario;
    }

    /**
     * Calcula el interés compuesto
     * @param float $capital Capital inicial
     * @param float $tasa Tasa de interés anual (en porcentaje)
     * @param int $tiempo Tiempo en años
     * @return array Array con detalles del cálculo
     */
    public function calcularInteresCompuesto(float $capital, float $tasa, int $tiempo): array
    {
        $tasaDecimal = $tasa / 100;
        $montoFinal = $capital * pow(1 + $tasaDecimal, $tiempo);
        $intereses = $montoFinal - $capital;
        
        return [
            'capital_inicial' => $capital,
            'tasa_anual' => $tasa,
            'tiempo_anos' => $tiempo,
            'monto_final' => round($montoFinal, 2),
            'intereses_ganados' => round($intereses, 2)
        ];
    }

    /**
     * Convierte velocidades entre diferentes unidades
     * @param float $valor Valor a convertir
     * @param string $unidadOrigen Unidad origen (kmh, mph, ms)
     * @param string $unidadDestino Unidad destino (kmh, mph, ms)
     * @return array Array con la conversión
     */
    public function convertirVelocidad(float $valor, string $unidadOrigen, string $unidadDestino): array
    {
        
        $valorEnMS = 0;
        
        switch ($unidadOrigen) {
            case 'kmh':
                $valorEnMS = $valor / 3.6;
                break;
            case 'mph':
                $valorEnMS = $valor * 0.44704;
                break;
            case 'ms':
                $valorEnMS = $valor;
                break;
        }
        
        
        $resultado = 0;
        switch ($unidadDestino) {
            case 'kmh':
                $resultado = $valorEnMS * 3.6;
                break;
            case 'mph':
                $resultado = $valorEnMS / 0.44704;
                break;
            case 'ms':
                $resultado = $valorEnMS;
                break;
        }
        
        return [
            'valor_original' => $valor,
            'unidad_origen' => $unidadOrigen,
            'valor_convertido' => round($resultado, 2),
            'unidad_destino' => $unidadDestino
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'cliente' => $this->cliente,
            'producto' => $this->producto,
            'cantidad' => $this->cantidad,
            'precio_unitario' => $this->precioUnitario,
            'fecha' => $this->fecha,
            'total' => $this->getTotal()
        ];
    }
}
