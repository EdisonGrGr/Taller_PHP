<?php

namespace App\Services;

use App\Models\Venta;

class VentaService
{
    /**
     * @var Venta[]
     */
    private array $ventas;

    public function __construct()
    {
        $this->ventas = [];
    }

    public function agregarVenta(Venta $venta): void
    {
        $this->ventas[] = $venta;
    }

    public function setVentas(array $ventas): void
    {
        $this->ventas = $ventas;
    }

    public function getVentas(): array
    {
        return $this->ventas;
    }

    /**
     * Calcula el total de ventas realizadas
     * @return int
     */
    public function calcularTotalVentas(): int
    {
        return count($this->ventas);
    }

    /**
     * Encuentra el cliente que ha gastado más dinero
     * @return array|null
     */
    public function clienteQueMasGasto(): ?array
    {
        if (empty($this->ventas)) {
            return null;
        }
        
        $gastoPorCliente = [];
        
        foreach ($this->ventas as $venta) {
            $cliente = $venta->getCliente();
            $total = $venta->getTotal();
            
            if (!isset($gastoPorCliente[$cliente])) {
                $gastoPorCliente[$cliente] = [
                    'total_gastado' => 0,
                    'cantidad_compras' => 0
                ];
            }
            
            $gastoPorCliente[$cliente]['total_gastado'] += $total;
            $gastoPorCliente[$cliente]['cantidad_compras']++;
        }
        
        $mayorGasto = 0;
        $clienteGanador = '';
        
        foreach ($gastoPorCliente as $cliente => $data) {
            if ($data['total_gastado'] > $mayorGasto) {
                $mayorGasto = $data['total_gastado'];
                $clienteGanador = $cliente;
            }
        }
        
        return [
            'cliente' => $clienteGanador,
            'total_gastado' => $mayorGasto,
            'cantidad_compras' => $gastoPorCliente[$clienteGanador]['cantidad_compras']
        ];
    }

    /**
     * Determina el producto más vendido
     * @return array|null
     */
    public function productoMasVendido(): ?array
    {
        if (empty($this->ventas)) {
            return null;
        }
        
        $ventasPorProducto = [];
        
        foreach ($this->ventas as $venta) {
            $producto = $venta->getProducto();
            $cantidad = $venta->getCantidad();
            
            if (!isset($ventasPorProducto[$producto])) {
                $ventasPorProducto[$producto] = [
                    'cantidad_total' => 0,
                    'numero_ventas' => 0,
                    'ingresos_totales' => 0
                ];
            }
            
            $ventasPorProducto[$producto]['cantidad_total'] += $cantidad;
            $ventasPorProducto[$producto]['numero_ventas']++;
            $ventasPorProducto[$producto]['ingresos_totales'] += $venta->getTotal();
        }
        
        $mayorCantidad = 0;
        $productoGanador = '';
        
        foreach ($ventasPorProducto as $producto => $data) {
            if ($data['cantidad_total'] > $mayorCantidad) {
                $mayorCantidad = $data['cantidad_total'];
                $productoGanador = $producto;
            }
        }
        
        return [
            'producto' => $productoGanador,
            'cantidad_total' => $mayorCantidad,
            'numero_ventas' => $ventasPorProducto[$productoGanador]['numero_ventas'],
            'ingresos_totales' => $ventasPorProducto[$productoGanador]['ingresos_totales']
        ];
    }

    /**
     * Obtiene estadísticas completas de ventas
     * @return array
     */
    public function obtenerEstadisticas(): array
    {
        $totalVentas = $this->calcularTotalVentas();
        $clienteTop = $this->clienteQueMasGasto();
        $productoTop = $this->productoMasVendido();
        
        // Calcular ingresos totales
        $ingresosTotales = 0;
        foreach ($this->ventas as $venta) {
            $ingresosTotales += $venta->getTotal();
        }
        
        return [
            'total_ventas' => $totalVentas,
            'ingresos_totales' => $ingresosTotales,
            'cliente_top' => $clienteTop,
            'producto_top' => $productoTop
        ];
    }

    /**
     * Crea ventas de muestra para testing
     * @return void
     */
    public function crearVentasMuestra(): void
    {
        $ventasMuestra = [
            new Venta(1, "Daniel Arias", "Laptop HP", 2, 2500000, "2025-01-15"),
            new Venta(2, "Ana Silva", "Mouse Logitech", 5, 80000, "2025-02-16"),
            new Venta(3, "Stiven Martinez", "Teclado Mecánico", 3, 150000, "2025-03-17"),
            new Venta(4, "María Fernández", "Monitor Samsung", 1, 800000, "2025-04-18"),
            new Venta(5, "Carlos Mendoza", "Impresora Canon", 1, 600000, "2025-05-19"),
            new Venta(6, "Ana Silva", "Laptop HP", 1, 2500000, "2025-06-20"),
            new Venta(7, "Pedro Ramírez", "Mouse Logitech", 10, 80000, "2025-07-21"),
            new Venta(8, "Luis González", "Tablet iPad", 2, 1200000, "2024-12-22"),
            new Venta(9, "María Fernández", "Teclado Mecánico", 2, 150000, "2024-11-23"),
            new Venta(10, "Sofia Herrera", "Laptop HP", 1, 2500000, "2024-10-24"),
            new Venta(11, "Carlos Mendoza", "Mouse Logitech", 3, 80000, "2024-01-25"),
            new Venta(12, "Ana Silva", "Monitor Samsung", 2, 800000, "2024-01-26")
        ];
        
        $this->ventas = $ventasMuestra;
    }
}
