<?php
/**
 * Configuración de la aplicación
 */

return [
    'app' => [
        'name' => 'Sistema de Gestión Empresarial',
        'version' => '1.0.0',
        'url' => 'http://localhost:8000',
        'timezone' => 'America/Bogota'
    ],
    
    'database' => [
        // Para futuras implementaciones
        'default' => 'sqlite',
        'connections' => [
            'sqlite' => [
                'driver' => 'sqlite',
                'database' => __DIR__ . '/database/database.sqlite'
            ]
        ]
    ],
    
    'mail' => [
        'default' => 'smtp',
        'from' => [
            'address' => 'admin@empresa.com',
            'name' => 'Sistema Empresarial'
        ],
        'smtp' => [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => '', // Configurar en producción
            'password' => ''  // Configurar en producción
        ]
    ],
    
    'pdf' => [
        'default_font' => 'Arial',
        'default_paper' => 'A4',
        'orientation' => 'portrait'
    ],
    
    'colombia' => [
        'salario_minimo' => 1160000, // 2024
        'salud_empleado' => 0.04,    // 4%
        'pension_empleado' => 0.04,  // 4%
        'retencion_base' => 2620000  // ~2.5 SMMLV
    ]
];
?>
