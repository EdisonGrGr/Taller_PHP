<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private Dompdf $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);
        
        $this->dompdf = new Dompdf($options);
    }

    /**
     * Genera un PDF de reporte de empleados
     * @param array $empleados
     * @param array $estadisticas
     * @return string
     */
    public function generarReporteEmpleados(array $empleados, array $estadisticas): string
    {
        $html = $this->generarHtmlEmpleados($empleados, $estadisticas);
        
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        
        return $this->dompdf->output();
    }

    /**
     * Genera un PDF de reporte de ventas
     * @param array $ventas
     * @param array $estadisticas
     * @return string
     */
    public function generarReporteVentas(array $ventas, array $estadisticas): string
    {
        $html = $this->generarHtmlVentas($ventas, $estadisticas);
        
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        
        return $this->dompdf->output();
    }

    private function generarHtmlEmpleados(array $empleados, array $estadisticas): string
    {
        $fecha = date('d/m/Y H:i:s');
        
        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Reporte de Empleados</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; }
                .header { text-align: center; margin-bottom: 20px; }
                .header h1 { color: #333; margin-bottom: 5px; }
                .fecha { color: #666; font-size: 10px; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; font-weight: bold; }
                .stats { background-color: #f9f9f9; padding: 15px; margin: 20px 0; }
                .stats h3 { margin-top: 0; color: #333; }
                .stat-item { margin: 5px 0; }
                .numero { text-align: right; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h1>Reporte de Empleados</h1>
                <p class='fecha'>Generado el: {$fecha}</p>
            </div>
            
            <div class='stats'>
                <h3>Estadísticas Generales</h3>";
        
        if (isset($estadisticas['promedios'])) {
            $html .= "<h4>Promedio de Salarios por Departamento</h4>";
            foreach ($estadisticas['promedios'] as $depto => $data) {
                $promedio = number_format($data['promedio'], 0, ',', '.');
                $html .= "<div class='stat-item'><strong>{$depto}:</strong> \${$promedio} ({$data['cantidad_empleados']} empleados)</div>";
            }
        }
        
        if (isset($estadisticas['departamento_top'])) {
            $deptoTop = $estadisticas['departamento_top'];
            $promedio = number_format($deptoTop['promedio'], 0, ',', '.');
            $html .= "<h4>Departamento con Mayor Promedio Salarial</h4>";
            $html .= "<div class='stat-item'><strong>{$deptoTop['departamento']}:</strong> \${$promedio}</div>";
        }
        
        $html .= "</div>";
        
        if (!empty($empleados)) {
            $html .= "
            <h3>Lista de Empleados</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Departamento</th>
                        <th class='numero'>Salario</th>
                    </tr>
                </thead>
                <tbody>";
            
            foreach ($empleados as $empleado) {
                $salario = number_format($empleado->getSalario(), 0, ',', '.');
                $html .= "
                    <tr>
                        <td>{$empleado->getNombre()}</td>
                        <td>{$empleado->getDepartamento()}</td>
                        <td class='numero'>\${$salario}</td>
                    </tr>";
            }
            
            $html .= "
                </tbody>
            </table>";
        }
        
        if (isset($estadisticas['empleados_sobre_promedio'])) {
            $html .= "
            <h3>Empleados que Ganan Sobre el Promedio de su Departamento</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Departamento</th>
                        <th class='numero'>Salario</th>
                        <th class='numero'>Promedio Depto.</th>
                        <th class='numero'>Diferencia</th>
                    </tr>
                </thead>
                <tbody>";
            
            foreach ($estadisticas['empleados_sobre_promedio'] as $emp) {
                $salario = number_format($emp['salario'], 0, ',', '.');
                $promedio = number_format($emp['promedio_departamento'], 0, ',', '.');
                $diferencia = number_format($emp['diferencia'], 0, ',', '.');
                
                $html .= "
                    <tr>
                        <td>{$emp['empleado']->getNombre()}</td>
                        <td>{$emp['empleado']->getDepartamento()}</td>
                        <td class='numero'>\${$salario}</td>
                        <td class='numero'>\${$promedio}</td>
                        <td class='numero'>\${$diferencia}</td>
                    </tr>";
            }
            
            $html .= "
                </tbody>
            </table>";
        }
        
        $html .= "
        </body>
        </html>";
        
        return $html;
    }

    private function generarHtmlVentas(array $ventas, array $estadisticas): string
    {
        $fecha = date('d/m/Y H:i:s');
        
        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Reporte de Ventas</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; }
                .header { text-align: center; margin-bottom: 20px; }
                .header h1 { color: #333; margin-bottom: 5px; }
                .fecha { color: #666; font-size: 10px; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; font-weight: bold; }
                .stats { background-color: #f9f9f9; padding: 15px; margin: 20px 0; }
                .stats h3 { margin-top: 0; color: #333; }
                .stat-item { margin: 5px 0; }
                .numero { text-align: right; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h1>Reporte de Ventas</h1>
                <p class='fecha'>Generado el: {$fecha}</p>
            </div>
            
            <div class='stats'>
                <h3>Estadísticas Generales</h3>
                <div class='stat-item'><strong>Total de Ventas:</strong> {$estadisticas['total_ventas']}</div>";
        
        if (isset($estadisticas['ingresos_totales'])) {
            $ingresos = number_format($estadisticas['ingresos_totales'], 0, ',', '.');
            $html .= "<div class='stat-item'><strong>Ingresos Totales:</strong> \${$ingresos}</div>";
        }
        
        if (isset($estadisticas['cliente_top'])) {
            $clienteTop = $estadisticas['cliente_top'];
            $gasto = number_format($clienteTop['total_gastado'], 0, ',', '.');
            $html .= "<div class='stat-item'><strong>Cliente que más gastó:</strong> {$clienteTop['cliente']} (\${$gasto})</div>";
        }
        
        if (isset($estadisticas['producto_top'])) {
            $productoTop = $estadisticas['producto_top'];
            $html .= "<div class='stat-item'><strong>Producto más vendido:</strong> {$productoTop['producto']} ({$productoTop['cantidad_total']} unidades)</div>";
        }
        
        $html .= "</div>";
        
        if (!empty($ventas)) {
            $html .= "
            <h3>Detalle de Ventas</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th class='numero'>Cantidad</th>
                        <th class='numero'>Precio Unit.</th>
                        <th class='numero'>Total</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>";
            
            foreach ($ventas as $venta) {
                $precioUnit = number_format($venta->getPrecioUnitario(), 0, ',', '.');
                $total = number_format($venta->getTotal(), 0, ',', '.');
                
                $html .= "
                    <tr>
                        <td>{$venta->getId()}</td>
                        <td>{$venta->getCliente()}</td>
                        <td>{$venta->getProducto()}</td>
                        <td class='numero'>{$venta->getCantidad()}</td>
                        <td class='numero'>\${$precioUnit}</td>
                        <td class='numero'>\${$total}</td>
                        <td>{$venta->getFecha()}</td>
                    </tr>";
            }
            
            $html .= "
                </tbody>
            </table>";
        }
        
        $html .= "
        </body>
        </html>";
        
        return $html;
    }
}
