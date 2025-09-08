<?php
session_start();

// Reinicializar datos de muestra
if (isset($_GET['reset'])) {
    unset($_SESSION['empleados']);
    unset($_SESSION['ventas']);
    header('Location: index.php');
    exit;
}

// Cargar datos de muestra si no existen
if (!isset($_SESSION['empleados']) || !isset($_SESSION['ventas'])) {
    // Datos de muestra para empleados
    $empleadosMuestra = [
        ['nombre' => 'Juan Pérez', 'salario' => 3500000, 'departamento' => 'Desarrollo'],
        ['nombre' => 'María García', 'salario' => 4200000, 'departamento' => 'Desarrollo'],
        ['nombre' => 'Carlos López', 'salario' => 2800000, 'departamento' => 'Marketing'],
        ['nombre' => 'Ana Rodríguez', 'salario' => 3100000, 'departamento' => 'Marketing'],
        ['nombre' => 'Luis Martín', 'salario' => 3800000, 'departamento' => 'Ventas'],
        ['nombre' => 'Sofia Hernández', 'salario' => 3600000, 'departamento' => 'Ventas'],
        ['nombre' => 'Pedro Gómez', 'salario' => 5000000, 'departamento' => 'Gerencia'],
        ['nombre' => 'Laura Díaz', 'salario' => 2900000, 'departamento' => 'Recursos Humanos'],
        ['nombre' => 'Miguel Torres', 'salario' => 3300000, 'departamento' => 'Desarrollo'],
        ['nombre' => 'Elena Ruiz', 'salario' => 3700000, 'departamento' => 'Marketing']
    ];
    
    $_SESSION['empleados'] = $empleadosMuestra;
    
    // Datos de muestra para ventas
    $ventasMuestra = [
        ['id' => 1, 'cliente' => 'Carlos Mendoza', 'producto' => 'Laptop HP', 'cantidad' => 2, 'precio_unitario' => 2500000, 'fecha' => '2024-01-15'],
        ['id' => 2, 'cliente' => 'Ana Silva', 'producto' => 'Mouse Logitech', 'cantidad' => 5, 'precio_unitario' => 80000, 'fecha' => '2024-01-16'],
        ['id' => 3, 'cliente' => 'Luis González', 'producto' => 'Teclado Mecánico', 'cantidad' => 3, 'precio_unitario' => 150000, 'fecha' => '2024-01-17'],
        ['id' => 4, 'cliente' => 'María Fernández', 'producto' => 'Monitor Samsung', 'cantidad' => 1, 'precio_unitario' => 800000, 'fecha' => '2024-01-18'],
        ['id' => 5, 'cliente' => 'Carlos Mendoza', 'producto' => 'Impresora Canon', 'cantidad' => 1, 'precio_unitario' => 600000, 'fecha' => '2024-01-19'],
        ['id' => 6, 'cliente' => 'Ana Silva', 'producto' => 'Laptop HP', 'cantidad' => 1, 'precio_unitario' => 2500000, 'fecha' => '2024-01-20'],
        ['id' => 7, 'cliente' => 'Pedro Ramírez', 'producto' => 'Mouse Logitech', 'cantidad' => 10, 'precio_unitario' => 80000, 'fecha' => '2024-01-21'],
        ['id' => 8, 'cliente' => 'Luis González', 'producto' => 'Tablet iPad', 'cantidad' => 2, 'precio_unitario' => 1200000, 'fecha' => '2024-01-22'],
        ['id' => 9, 'cliente' => 'María Fernández', 'producto' => 'Teclado Mecánico', 'cantidad' => 2, 'precio_unitario' => 150000, 'fecha' => '2024-01-23'],
        ['id' => 10, 'cliente' => 'Sofia Herrera', 'producto' => 'Laptop HP', 'cantidad' => 1, 'precio_unitario' => 2500000, 'fecha' => '2024-01-24'],
        ['id' => 11, 'cliente' => 'Carlos Mendoza', 'producto' => 'Mouse Logitech', 'cantidad' => 3, 'precio_unitario' => 80000, 'fecha' => '2024-01-25'],
        ['id' => 12, 'cliente' => 'Ana Silva', 'producto' => 'Monitor Samsung', 'cantidad' => 2, 'precio_unitario' => 800000, 'fecha' => '2024-01-26']
    ];
    
    $_SESSION['ventas'] = $ventasMuestra;
}
?>
