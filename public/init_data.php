<?php
session_start();


if (isset($_GET['reset'])) {
    unset($_SESSION['empleados']);
    unset($_SESSION['ventas']);
    unset($_SESSION['datos_inicializados']);
    header('Location: index.php');
    exit;
}


if (!isset($_SESSION['datos_inicializados'])) {
    
    $empleadosMuestra = [
        ['nombre' => 'Sergio Velasquez', 'salario' => 3500000, 'departamento' => 'Desarrollo'],
        ['nombre' => 'María García', 'salario' => 4200000, 'departamento' => 'Desarrollo'],
        ['nombre' => 'Andrea Martínez', 'salario' => 2800000, 'departamento' => 'Marketing'],
        ['nombre' => 'Ana Rodríguez', 'salario' => 3100000, 'departamento' => 'Marketing'],
        ['nombre' => 'Martín Rodriguez', 'salario' => 3800000, 'departamento' => 'Ventas'],
        ['nombre' => 'Sofia Hernández', 'salario' => 3600000, 'departamento' => 'Ventas'],
        ['nombre' => 'Cristian Echeverri', 'salario' => 5000000, 'departamento' => 'Gerencia'],
        ['nombre' => 'Luis Díaz', 'salario' => 2900000, 'departamento' => 'Recursos Humanos'],
        ['nombre' => 'Miguel Torres', 'salario' => 3300000, 'departamento' => 'Desarrollo'],
        ['nombre' => 'Elena Ruiz', 'salario' => 3700000, 'departamento' => 'Marketing']
    ];
    
    
    $ventasMuestra = [
        ['id' => 1, 'cliente' => 'Daniel Arias', 'producto' => 'Laptop HP', 'cantidad' => 2, 'precio_unitario' => 2500000, 'fecha' => '2025-01-15'],
        ['id' => 2, 'cliente' => 'Ana Silva', 'producto' => 'Mouse Logitech', 'cantidad' => 5, 'precio_unitario' => 80000, 'fecha' => '2025-02-16'],
        ['id' => 3, 'cliente' => 'Stiven Martinez', 'producto' => 'Teclado Mecánico', 'cantidad' => 3, 'precio_unitario' => 150000, 'fecha' => '2025-03-17'],
        ['id' => 4, 'cliente' => 'María Fernández', 'producto' => 'Monitor Samsung', 'cantidad' => 1, 'precio_unitario' => 800000, 'fecha' => '2025-04-18'],
        ['id' => 5, 'cliente' => 'Carlos Mendoza', 'producto' => 'Impresora Canon', 'cantidad' => 1, 'precio_unitario' => 600000, 'fecha' => '2025-05-19'],
        ['id' => 6, 'cliente' => 'Ana Silva', 'producto' => 'Laptop HP', 'cantidad' => 1, 'precio_unitario' => 2500000, 'fecha' => '2025-06-20'],
        ['id' => 7, 'cliente' => 'Pedro Ramírez', 'producto' => 'Mouse Logitech', 'cantidad' => 10, 'precio_unitario' => 80000, 'fecha' => '2025-07-21'],
        ['id' => 8, 'cliente' => 'Luis González', 'producto' => 'Tablet iPad', 'cantidad' => 2, 'precio_unitario' => 1200000, 'fecha' => '2024-12-22'],
        ['id' => 9, 'cliente' => 'María Fernández', 'producto' => 'Teclado Mecánico', 'cantidad' => 2, 'precio_unitario' => 150000, 'fecha' => '2024-11-23'],
        ['id' => 10, 'cliente' => 'Sofia Herrera', 'producto' => 'Laptop HP', 'cantidad' => 1, 'precio_unitario' => 2500000, 'fecha' => '2024-10-24'],
        ['id' => 11, 'cliente' => 'Carlos Mendoza', 'producto' => 'Mouse Logitech', 'cantidad' => 3, 'precio_unitario' => 80000, 'fecha' => '2024-01-25'],
        ['id' => 12, 'cliente' => 'Ana Silva', 'producto' => 'Monitor Samsung', 'cantidad' => 2, 'precio_unitario' => 800000, 'fecha' => '2024-01-26']
    ];
    
    $_SESSION['empleados'] = $empleadosMuestra;
    $_SESSION['ventas'] = $ventasMuestra;
    $_SESSION['datos_inicializados'] = true;
}
?>
