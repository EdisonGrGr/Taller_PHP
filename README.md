# Sistema de Gestión Empresarial - PHP

## Descripción

Aplicación web completa desarrollada en PHP que permite gestionar empleados y ventas de una empresa, con análisis estadísticos avanzados, generación de reportes PDF y envío de correos electrónicos.

## Características Principales

### 1. Gestión de Empleados
- ✅ Calcular promedio de salarios por departamento
- ✅ Determinar departamento con mayor promedio salarial  
- ✅ Listar empleados que ganan sobre el promedio de su departamento
- ✅ Calcular salario neto aplicando deducciones de ley colombiana
- ✅ Conversor de temperatura (Celsius, Fahrenheit, Kelvin)

### 2. Gestión de Ventas
- ✅ Calcular total de ventas realizadas
- ✅ Encontrar cliente que más ha gastado
- ✅ Determinar producto más vendido
- ✅ Calculadora de interés compuesto
- ✅ Conversor de velocidad (Km/h, Mph, m/s)

### 3. Arquitectura y Tecnologías
- ✅ Patrón MVC (Modelo-Vista-Controlador)
- ✅ Autoload PSR-4 con Composer
- ✅ Librerías externas integradas
- ✅ Interfaz moderna con Bootstrap 5

### 4. Librerías Utilizadas
- **DomPDF**: Generación de reportes PDF
- **Symfony Mailer**: Envío de correos electrónicos
- **Intervention Image**: Manipulación de imágenes

## Estructura del Proyecto

```
empleados-ventas-app/
├── composer.json              # Configuración de dependencias
├── composer.lock             
├── vendor/                   # Dependencias de Composer
├── public/                   # Archivos públicos
│   ├── index.php            # Página principal
│   ├── empleados.php        # Gestión de empleados
│   ├── ventas.php           # Gestión de ventas
│   ├── empleado_form.php    # Formulario nuevo empleado
│   ├── venta_form.php       # Formulario nueva venta
│   ├── salario_neto.php     # Calculadora salario neto
│   ├── temperatura.php      # Conversor temperatura
│   ├── interes_compuesto.php # Calculadora interés
│   ├── velocidad.php        # Conversor velocidad
│   ├── empleado_pdf.php     # Generar PDF empleados
│   ├── venta_pdf.php        # Generar PDF ventas
│   ├── empleado_email.php   # Enviar reporte empleados
│   └── venta_email.php      # Enviar reporte ventas
├── src/                     # Código fuente
│   ├── Controllers/         # Controladores MVC
│   │   ├── EmpleadoController.php
│   │   └── VentaController.php
│   ├── Models/              # Modelos de datos
│   │   ├── Empleado.php
│   │   └── Venta.php
│   └── Services/            # Servicios de negocio
│       ├── EmpleadoService.php
│       ├── VentaService.php
│       ├── PdfService.php
│       └── EmailService.php
└── views/                   # Plantillas HTML
    ├── empleados.php
    ├── ventas.php
    ├── empleado_form.php
    ├── venta_form.php
    ├── salario_neto.php
    ├── temperatura.php
    ├── interes_compuesto.php
    ├── velocidad.php
    ├── enviar_reporte.php
    └── enviar_reporte_ventas.php
```

## Requisitos del Sistema

- PHP 7.4 o superior
- Composer
- Extensiones PHP: mbstring, gd, xml
- Servidor web (Apache/Nginx)

## Instalación

1. **Clonar/Descargar el proyecto**
   ```bash
   cd c:\xampp\htdocs\Laravel\empleados-ventas-app
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar servidor web**
   - Apuntar el DocumentRoot a la carpeta `public/`
   - O acceder via: `http://localhost/empleados-ventas-app/public/`

4. **Verificar permisos**
   - Asegurar que PHP pueda escribir en directorios temporales para PDF

## Uso de la Aplicación

### Página Principal
- **URL**: `/index.php`
- Navegación a todas las funcionalidades
- Estadísticas generales del sistema

### Gestión de Empleados
- **URL**: `/empleados.php`
- Ver lista de empleados con estadísticas
- Agregar nuevos empleados
- Analizar promedios salariales por departamento
- Identificar empleados sobre el promedio

### Gestión de Ventas  
- **URL**: `/ventas.php`
- Ver lista de ventas con estadísticas
- Registrar nuevas ventas
- Analizar cliente top y producto más vendido
- Calcular ingresos totales

### Herramientas Matemáticas

#### Salario Neto (Colombia)
- **URL**: `/salario_neto.php`
- Calcula deducciones de salud (4%)
- Calcula deducciones de pensión (4%)
- Aplica retención en la fuente según escala
- Muestra salario neto final

#### Conversor de Temperatura
- **URL**: `/temperatura.php`
- Convierte de Celsius a Fahrenheit y Kelvin
- Fórmulas: F = (C × 9/5) + 32, K = C + 273.15

#### Interés Compuesto
- **URL**: `/interes_compuesto.php`
- Calcula inversiones a futuro
- Fórmula: Monto = Capital × (1 + tasa)^tiempo
- Muestra intereses ganados y rentabilidad

#### Conversor de Velocidad
- **URL**: `/velocidad.php`
- Convierte entre Km/h, Mph y m/s
- Factores de conversión automáticos

### Reportes PDF
- **Empleados**: `/empleado_pdf.php`
- **Ventas**: `/venta_pdf.php`
- Reportes profesionales con estadísticas completas

### Envío por Email
- **Empleados**: `/empleado_email.php`
- **Ventas**: `/venta_email.php`
- Incluye PDF adjunto (simulado en desarrollo)

## Datos de Muestra

La aplicación incluye datos de muestra que se cargan automáticamente:

### Empleados
- 10 empleados en 5 departamentos diferentes
- Rangos salariales de $2.800.000 a $5.000.000

### Ventas
- 12 ventas de diferentes productos
- Diversos clientes y fechas
- Productos tecnológicos variados

## Funcionalidades Técnicas

### Patrón MVC
- **Modelos**: `Empleado`, `Venta` con lógica de negocio
- **Vistas**: Templates HTML con Bootstrap
- **Controladores**: Manejan requests y coordinan servicios

### Autoload PSR-4
```php
"autoload": {
    "psr-4": {
        "App\\": "src/"
    }
}
```

### Servicios
- **EmpleadoService**: Lógica de análisis de empleados
- **VentaService**: Lógica de análisis de ventas  
- **PdfService**: Generación de reportes PDF
- **EmailService**: Envío de correos electrónicos

### Operaciones Matemáticas
1. **Salario Neto**: Deducciones legales Colombia
2. **Conversión Temperatura**: Fórmulas termodinámicas
3. **Interés Compuesto**: Cálculos financieros
4. **Conversión Velocidad**: Factores físicos

## Configuración de Producción

### Email SMTP
En `src/Services/EmailService.php`:
```php
// Cambiar de:
$transport = Transport::fromDsn('smtp://localhost');

// A (ejemplo Gmail):
$transport = Transport::fromDsn('smtp://usuario:password@smtp.gmail.com:587');
```

### Configuración PHP
Asegurar en `php.ini`:
```ini
extension=mbstring
extension=gd
extension=xml
memory_limit=256M
```

## Tecnologías Utilizadas

- **Backend**: PHP 7.4+
- **Gestión Dependencias**: Composer
- **PDF**: DomPDF 2.0
- **Email**: Symfony Mailer 6.4
- **Imágenes**: Intervention Image 2.7
- **Frontend**: Bootstrap 5.3, Font Awesome 6.0
- **Arquitectura**: MVC, PSR-4

## Autor

Desarrollado como proyecto académico demostrando:
- Arquitectura MVC en PHP
- Integración de librerías externas
- Análisis estadístico de datos
- Generación de reportes
- Operaciones matemáticas aplicadas
- Diseño responsivo moderno

---

**Fecha**: Septiembre 2024  
**Versión**: 1.0.0
"# Taller_PHP"  
