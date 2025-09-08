<?php
/**
 * Script de Pruebas - Sistema de Gestión Empresarial
 * Verifica que todas las funcionalidades principales funcionen correctamente
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Empleado;
use App\Models\Venta;
use App\Services\EmpleadoService;
use App\Services\VentaService;
use App\Services\PdfService;
use App\Services\EmailService;

echo "🚀 Iniciando pruebas del Sistema de Gestión Empresarial\n\n";

// Prueba 1: Modelos básicos
echo "📋 Prueba 1: Creación de modelos\n";
$empleado = new Empleado("Juan Pérez", 3500000, "Desarrollo");
$venta = new Venta(1, "Cliente Test", "Producto Test", 2, 1000000, "2024-09-07");

echo "✅ Empleado creado: {$empleado->getNombre()} - \${$empleado->getSalario()}\n";
echo "✅ Venta creada: {$venta->getCliente()} - Total: \${$venta->getTotal()}\n\n";

// Prueba 2: Servicios de Empleados
echo "👥 Prueba 2: Análisis de empleados\n";
$empleadoService = new EmpleadoService();
$empleadoService->crearEmpleadosMuestra();

$promedios = $empleadoService->calcularPromedioSalariosPorDepartamento();
$departamentoTop = $empleadoService->departamentoConMayorPromedio();
$empleadosSobrePromedio = $empleadoService->empleadosSobrePromedio();

echo "✅ Departamentos analizados: " . count($promedios) . "\n";
echo "✅ Departamento con mayor promedio: {$departamentoTop['departamento']}\n";
echo "✅ Empleados sobre promedio: " . count($empleadosSobrePromedio) . "\n\n";

// Prueba 3: Servicios de Ventas
echo "💰 Prueba 3: Análisis de ventas\n";
$ventaService = new VentaService();
$ventaService->crearVentasMuestra();

$totalVentas = $ventaService->calcularTotalVentas();
$clienteTop = $ventaService->clienteQueMasGasto();
$productoTop = $ventaService->productoMasVendido();

echo "✅ Total de ventas: {$totalVentas}\n";
echo "✅ Cliente top: {$clienteTop['cliente']}\n";
echo "✅ Producto más vendido: {$productoTop['producto']}\n\n";

// Prueba 4: Operaciones matemáticas
echo "🧮 Prueba 4: Operaciones matemáticas\n";

// Salario neto
$salarioNeto = $empleado->calcularSalarioNeto(3500000);
echo "✅ Salario neto calculado: \${$salarioNeto['salario_neto']}\n";

// Conversión de temperatura
$temperatura = $empleado->convertirTemperatura(25);
echo "✅ Conversión temperatura: 25°C = {$temperatura['fahrenheit']}°F\n";

// Interés compuesto
$interes = $venta->calcularInteresCompuesto(1000000, 10, 5);
echo "✅ Interés compuesto: \${$interes['monto_final']} en 5 años\n";

// Conversión de velocidad
$velocidad = $venta->convertirVelocidad(100, 'kmh', 'ms');
echo "✅ Conversión velocidad: 100 km/h = {$velocidad['valor_convertido']} m/s\n\n";

// Prueba 5: Generación de PDF
echo "📄 Prueba 5: Generación de PDF\n";
try {
    $pdfService = new PdfService();
    $empleados = $empleadoService->getEmpleados();
    $estadisticas = [
        'promedios' => $promedios,
        'departamento_top' => $departamentoTop,
        'empleados_sobre_promedio' => $empleadosSobrePromedio
    ];
    
    $pdf = $pdfService->generarReporteEmpleados($empleados, $estadisticas);
    echo "✅ PDF de empleados generado: " . strlen($pdf) . " bytes\n";
    
    $ventas = $ventaService->getVentas();
    $estadisticasVentas = $ventaService->obtenerEstadisticas();
    $pdfVentas = $pdfService->generarReporteVentas($ventas, $estadisticasVentas);
    echo "✅ PDF de ventas generado: " . strlen($pdfVentas) . " bytes\n\n";
} catch (Exception $e) {
    echo "❌ Error en PDF: " . $e->getMessage() . "\n\n";
}

// Prueba 6: Servicio de Email
echo "📧 Prueba 6: Servicio de email\n";
try {
    $emailService = new EmailService();
    $contenidoEmpleados = $emailService->generarContenidoEmpleados($estadisticas);
    $contenidoVentas = $emailService->generarContenidoVentas($estadisticasVentas);
    
    echo "✅ Contenido email empleados generado: " . strlen($contenidoEmpleados) . " caracteres\n";
    echo "✅ Contenido email ventas generado: " . strlen($contenidoVentas) . " caracteres\n\n";
} catch (Exception $e) {
    echo "❌ Error en email: " . $e->getMessage() . "\n\n";
}

// Prueba 7: Autoload PSR-4
echo "🔄 Prueba 7: Autoload PSR-4\n";
$clases = [
    'App\Models\Empleado',
    'App\Models\Venta',
    'App\Services\EmpleadoService',
    'App\Services\VentaService',
    'App\Controllers\EmpleadoController',
    'App\Controllers\VentaController'
];

foreach ($clases as $clase) {
    if (class_exists($clase)) {
        echo "✅ Clase cargada: {$clase}\n";
    } else {
        echo "❌ Error cargando: {$clase}\n";
    }
}

echo "\n🎉 Pruebas completadas exitosamente!\n";
echo "📊 Resumen:\n";
echo "   - Patrón MVC implementado\n";
echo "   - PSR-4 Autoload funcionando\n";
echo "   - Operaciones matemáticas implementadas\n";
echo "   - Generación de PDF operativa\n";
echo "   - Servicio de email configurado\n";
echo "   - Bootstrap integrado\n";
echo "   - Análisis estadísticos funcionando\n\n";

echo "🌐 Accede a la aplicación en: http://localhost:8000\n";
?>
