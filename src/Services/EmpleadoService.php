<?php

namespace App\Services;

use App\Models\Empleado;

class EmpleadoService
{
    /**
     * @var Empleado[]
     */
    private array $empleados;

    public function __construct()
    {
        $this->empleados = [];
    }

    public function agregarEmpleado(Empleado $empleado): void
    {
        $this->empleados[] = $empleado;
    }

    public function setEmpleados(array $empleados): void
    {
        $this->empleados = $empleados;
    }

    public function getEmpleados(): array
    {
        return $this->empleados;
    }

    /**
     * Calcula el promedio de salarios por departamento
     * @return array
     */
    public function calcularPromedioSalariosPorDepartamento(): array
    {
        $departamentos = [];
        
        foreach ($this->empleados as $empleado) {
            $depto = $empleado->getDepartamento();
            
            if (!isset($departamentos[$depto])) {
                $departamentos[$depto] = [
                    'total_salarios' => 0,
                    'cantidad_empleados' => 0,
                    'promedio' => 0
                ];
            }
            
            $departamentos[$depto]['total_salarios'] += $empleado->getSalario();
            $departamentos[$depto]['cantidad_empleados']++;
        }
        
        // Calcular promedios
        foreach ($departamentos as $depto => &$data) {
            $data['promedio'] = $data['total_salarios'] / $data['cantidad_empleados'];
        }
        
        return $departamentos;
    }

    /**
     * Determina el departamento con el salario promedio más alto
     * @return array|null
     */
    public function departamentoConMayorPromedio(): ?array
    {
        $promedios = $this->calcularPromedioSalariosPorDepartamento();
        
        if (empty($promedios)) {
            return null;
        }
        
        $mayorPromedio = 0;
        $departamentoGanador = '';
        
        foreach ($promedios as $depto => $data) {
            if ($data['promedio'] > $mayorPromedio) {
                $mayorPromedio = $data['promedio'];
                $departamentoGanador = $depto;
            }
        }
        
        return [
            'departamento' => $departamentoGanador,
            'promedio' => $mayorPromedio,
            'datos' => $promedios[$departamentoGanador]
        ];
    }

    /**
     * Lista empleados que ganan por encima del promedio de su departamento
     * @return array
     */
    public function empleadosSobrePromedio(): array
    {
        $promedios = $this->calcularPromedioSalariosPorDepartamento();
        $empleadosSobrePromedio = [];
        
        foreach ($this->empleados as $empleado) {
            $depto = $empleado->getDepartamento();
            $promedioDepto = $promedios[$depto]['promedio'];
            
            if ($empleado->getSalario() > $promedioDepto) {
                $empleadosSobrePromedio[] = [
                    'empleado' => $empleado,
                    'salario' => $empleado->getSalario(),
                    'promedio_departamento' => $promedioDepto,
                    'diferencia' => $empleado->getSalario() - $promedioDepto
                ];
            }
        }
        
        return $empleadosSobrePromedio;
    }

    /**
     * Crea empleados de muestra para testing
     * @return void
     */
    public function crearEmpleadosMuestra(): void
    {
        $empleadosMuestra = [
            new Empleado("Juan Pérez", 3500000, "Desarrollo"),
            new Empleado("María García", 4200000, "Desarrollo"),
            new Empleado("Carlos López", 2800000, "Marketing"),
            new Empleado("Ana Rodríguez", 3100000, "Marketing"),
            new Empleado("Luis Martín", 3800000, "Ventas"),
            new Empleado("Sofia Hernández", 3600000, "Ventas"),
            new Empleado("Pedro Gómez", 5000000, "Gerencia"),
            new Empleado("Laura Díaz", 2900000, "Recursos Humanos"),
            new Empleado("Miguel Torres", 3300000, "Desarrollo"),
            new Empleado("Elena Ruiz", 3700000, "Marketing")
        ];
        
        $this->empleados = $empleadosMuestra;
    }
}
