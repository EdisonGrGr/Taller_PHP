<?php

namespace App\Models;

class Empleado
{
    private string $nombre;
    private float $salario;
    private string $departamento;

    public function __construct(string $nombre, float $salario, string $departamento)
    {
        $this->nombre = $nombre;
        $this->salario = $salario;
        $this->departamento = $departamento;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getSalario(): float
    {
        return $this->salario;
    }

    public function getDepartamento(): string
    {
        return $this->departamento;
    }

    /**
     * Calcula el salario neto después de aplicar deducciones de ley en Colombia
     * @param float $salario Salario bruto
     * @return array Array con detalles del cálculo
     */
    public function calcularSalarioNeto(float $salario = null): array
    {
        $salario = $salario ?? $this->salario;
        $salarioMinimo = 1160000; // Salario mínimo 2024 Colombia
        
        // Deducciones de salud (4%)
        $saludEmpleado = $salario * 0.04;
        
        // Deducciones de pensión (4%)
        $pensionEmpleado = $salario * 0.04;
        
        // Retención en la fuente (si aplica)
        $retencionFuente = 0;
        if ($salario > 2620000) { // Aproximadamente 2.5 SMMLV
            $baseRetencion = $salario - 2620000;
            $retencionFuente = $baseRetencion * 0.19; // 19% sobre el excedente
        }
        
        $totalDeducciones = $saludEmpleado + $pensionEmpleado + $retencionFuente;
        $salarioNeto = $salario - $totalDeducciones;
        
        return [
            'salario_bruto' => $salario,
            'salud_empleado' => $saludEmpleado,
            'pension_empleado' => $pensionEmpleado,
            'retencion_fuente' => $retencionFuente,
            'total_deducciones' => $totalDeducciones,
            'salario_neto' => $salarioNeto
        ];
    }

    /**
     * Convierte temperatura de Celsius a Fahrenheit y Kelvin
     * @param float $celsius Temperatura en Celsius
     * @return array Array con conversiones
     */
    public function convertirTemperatura(float $celsius): array
    {
        $fahrenheit = ($celsius * 9/5) + 32;
        $kelvin = $celsius + 273.15;
        
        return [
            'celsius' => $celsius,
            'fahrenheit' => round($fahrenheit, 2),
            'kelvin' => round($kelvin, 2)
        ];
    }

    public function toArray(): array
    {
        return [
            'nombre' => $this->nombre,
            'salario' => $this->salario,
            'departamento' => $this->departamento
        ];
    }
}
