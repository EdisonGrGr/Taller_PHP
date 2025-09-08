<?php

namespace App\Controllers;

use App\Models\Venta;
use App\Services\VentaService;
use App\Services\PdfService;
use App\Services\EmailService;

class VentaController
{
    private VentaService $ventaService;
    private PdfService $pdfService;
    private EmailService $emailService;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->ventaService = new VentaService();
        $this->pdfService = new PdfService();
        $this->emailService = new EmailService();
        
        
        if (isset($_SESSION['ventas'])) {
            $ventas = [];
            foreach ($_SESSION['ventas'] as $ventaData) {
                $ventas[] = new Venta(
                    $ventaData['id'], 
                    $ventaData['cliente'], 
                    $ventaData['producto'], 
                    $ventaData['cantidad'], 
                    $ventaData['precio_unitario'], 
                    $ventaData['fecha']
                );
            }
            $this->ventaService->setVentas($ventas);
        }
    }

    
    public function index(): void
    {
        $ventas = $this->ventaService->getVentas();
        $estadisticas = $this->ventaService->obtenerEstadisticas();

        include __DIR__ . '/../../views/ventas.php';
    }

    
    public function crear(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            $cliente = $_POST['cliente'] ?? '';
            $producto = $_POST['producto'] ?? '';
            $cantidad = intval($_POST['cantidad'] ?? 0);
            $precioUnitario = floatval($_POST['precio_unitario'] ?? 0);
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            if ($id > 0 && $cliente && $producto && $cantidad > 0 && $precioUnitario > 0) {
                $venta = new Venta($id, $cliente, $producto, $cantidad, $precioUnitario, $fecha);
                $this->ventaService->agregarVenta($venta);
                
                
                $this->guardarVentasEnSesion();
                
                header('Location: ventas.php?success=1');
                exit;
            }
        }

        include __DIR__ . '/../../views/venta_form.php';
    }

    
    public function calcularInteres(): void
    {
        $resultado = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $capital = floatval($_POST['capital'] ?? 0);
            $tasa = floatval($_POST['tasa'] ?? 0);
            $tiempo = intval($_POST['tiempo'] ?? 0);
            
            if ($capital > 0 && $tasa > 0 && $tiempo > 0) {
                $venta = new Venta(1, "", "", 1, 1, "");
                $resultado = $venta->calcularInteresCompuesto($capital, $tasa, $tiempo);
            }
        }

        include __DIR__ . '/../../views/interes_compuesto.php';
    }

    
    public function convertirVelocidad(): void
    {
        $resultado = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $valor = floatval($_POST['valor'] ?? 0);
            $unidadOrigen = $_POST['unidad_origen'] ?? '';
            $unidadDestino = $_POST['unidad_destino'] ?? '';
            
            if ($valor > 0 && $unidadOrigen && $unidadDestino) {
                $venta = new Venta(1, "", "", 1, 1, "");
                $resultado = $venta->convertirVelocidad($valor, $unidadOrigen, $unidadDestino);
            }
        }

        include __DIR__ . '/../../views/velocidad.php';
    }

    
    public function generarPdf(): void
    {
        
        if (empty($this->ventaService->getVentas())) {
            $this->ventaService->crearVentasMuestra();
        }

        $ventas = $this->ventaService->getVentas();
        $estadisticas = $this->ventaService->obtenerEstadisticas();

        $pdf = $this->pdfService->generarReporteVentas($ventas, $estadisticas);

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="reporte_ventas_' . date('Y-m-d') . '.pdf"');
        echo $pdf;
        exit;
    }

    
    public function enviarReporte(): void
    {
        $mensaje = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                
                if (empty($this->ventaService->getVentas())) {
                    $this->ventaService->crearVentasMuestra();
                }

                $ventas = $this->ventaService->getVentas();
                $estadisticas = $this->ventaService->obtenerEstadisticas();

                $pdf = $this->pdfService->generarReporteVentas($ventas, $estadisticas);
                $contenidoEmail = $this->emailService->generarContenidoVentas($estadisticas);

                $enviado = $this->emailService->enviarReporte(
                    $email,
                    'Reporte de Ventas - ' . date('d/m/Y'),
                    $contenidoEmail,
                    $pdf,
                    'reporte_ventas_' . date('Y-m-d') . '.pdf'
                );

                $mensaje = $enviado ? 'Reporte enviado exitosamente' : 'Error al enviar el reporte';
            } else {
                $mensaje = 'Email inválido';
            }
        }

        include __DIR__ . '/../../views/enviar_reporte_ventas.php';
    }

    
    private function guardarVentasEnSesion(): void
    {
        $_SESSION['ventas'] = [];
        foreach ($this->ventaService->getVentas() as $venta) {
            $_SESSION['ventas'][] = $venta->toArray();
        }
    }
}
