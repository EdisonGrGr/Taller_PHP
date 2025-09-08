<?php

namespace App\Controllers;

use App\Models\Empleado;
use App\Services\EmpleadoService;
use App\Services\PdfService;
use App\Services\EmailService;

class EmpleadoController
{
    private EmpleadoService $empleadoService;
    private PdfService $pdfService;
    private EmailService $emailService;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->empleadoService = new EmpleadoService();
        $this->pdfService = new PdfService();
        $this->emailService = new EmailService();
        
        
        if (isset($_SESSION['empleados'])) {
            $empleados = [];
            foreach ($_SESSION['empleados'] as $empData) {
                $empleados[] = new Empleado($empData['nombre'], $empData['salario'], $empData['departamento']);
            }
            $this->empleadoService->setEmpleados($empleados);
        }
    }

    
    public function index(): void
    {
        $empleados = $this->empleadoService->getEmpleados();
        $promedios = $this->empleadoService->calcularPromedioSalariosPorDepartamento();
        $departamentoTop = $this->empleadoService->departamentoConMayorPromedio();
        $empleadosSobrePromedio = $this->empleadoService->empleadosSobrePromedio();

        $estadisticas = [
            'promedios' => $promedios,
            'departamento_top' => $departamentoTop,
            'empleados_sobre_promedio' => $empleadosSobrePromedio
        ];

        include __DIR__ . '/../../views/empleados.php';
    }

    
    public function crear(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $salario = floatval($_POST['salario'] ?? 0);
            $departamento = $_POST['departamento'] ?? '';

            if ($nombre && $salario > 0 && $departamento) {
                $empleado = new Empleado($nombre, $salario, $departamento);
                $this->empleadoService->agregarEmpleado($empleado);
                
                
                $this->guardarEmpleadosEnSesion();
                
                header('Location: empleados.php?success=1');
                exit;
            }
        }

        include __DIR__ . '/../../views/empleado_form.php';
    }

    
    public function calcularSalarioNeto(): void
    {
        $resultado = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $salario = floatval($_POST['salario'] ?? 0);
            
            if ($salario > 0) {
                $empleado = new Empleado("Temporal", $salario, "Temporal");
                $resultado = $empleado->calcularSalarioNeto($salario);
            }
        }

        include __DIR__ . '/../../views/salario_neto.php';
    }

    
    public function convertirTemperatura(): void
    {
        $resultado = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $celsius = floatval($_POST['celsius'] ?? 0);
            
            $empleado = new Empleado("Temporal", 0, "Temporal");
            $resultado = $empleado->convertirTemperatura($celsius);
        }

        include __DIR__ . '/../../views/temperatura.php';
    }

    
    public function generarPdf(): void
    {
        
        if (empty($this->empleadoService->getEmpleados())) {
            $this->empleadoService->crearEmpleadosMuestra();
        }

        $empleados = $this->empleadoService->getEmpleados();
        $promedios = $this->empleadoService->calcularPromedioSalariosPorDepartamento();
        $departamentoTop = $this->empleadoService->departamentoConMayorPromedio();
        $empleadosSobrePromedio = $this->empleadoService->empleadosSobrePromedio();

        $estadisticas = [
            'promedios' => $promedios,
            'departamento_top' => $departamentoTop,
            'empleados_sobre_promedio' => $empleadosSobrePromedio
        ];

        $pdf = $this->pdfService->generarReporteEmpleados($empleados, $estadisticas);

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="reporte_empleados_' . date('Y-m-d') . '.pdf"');
        echo $pdf;
        exit;
    }

    
    public function enviarReporte(): void
    {
        $mensaje = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Cargar datos si no existen
                if (empty($this->empleadoService->getEmpleados())) {
                    $this->empleadoService->crearEmpleadosMuestra();
                }

                $empleados = $this->empleadoService->getEmpleados();
                $promedios = $this->empleadoService->calcularPromedioSalariosPorDepartamento();
                $departamentoTop = $this->empleadoService->departamentoConMayorPromedio();
                $empleadosSobrePromedio = $this->empleadoService->empleadosSobrePromedio();

                $estadisticas = [
                    'promedios' => $promedios,
                    'departamento_top' => $departamentoTop,
                    'empleados_sobre_promedio' => $empleadosSobrePromedio
                ];

                $pdf = $this->pdfService->generarReporteEmpleados($empleados, $estadisticas);
                $contenidoEmail = $this->emailService->generarContenidoEmpleados($estadisticas);

                $enviado = $this->emailService->enviarReporte(
                    $email,
                    'Reporte de Empleados - ' . date('d/m/Y'),
                    $contenidoEmail,
                    $pdf,
                    'reporte_empleados_' . date('Y-m-d') . '.pdf'
                );

                $mensaje = $enviado ? 'Reporte enviado exitosamente' : 'Error al enviar el reporte';
            } else {
                $mensaje = 'Email inválido';
            }
        }

        include __DIR__ . '/../../views/enviar_reporte.php';
    }

    
    private function guardarEmpleadosEnSesion(): void
    {
        $_SESSION['empleados'] = [];
        foreach ($this->empleadoService->getEmpleados() as $empleado) {
            $_SESSION['empleados'][] = $empleado->toArray();
        }
    }
}
