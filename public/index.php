<?php include 'init_data.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller PHP Avanzado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #39d44eff 0%, #1c611dff 100%);
            color: white;
            padding: 80px 0;
        }
        .feature-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-building me-2"></i>
                Sistema 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="empleados.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ventas.php">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="init_data.php?reset=1">
                            <i class="fas fa-sync-alt me-1"></i>Reiniciar Datos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Sistema de Gestión</h1>
            <p class="lead mb-5">Gestiona empleados, ventas y genera reportes</p>
            <div class="d-flex justify-content-around">
                <a href="empleados.php" class="btn btn-light btn-lg">
                    <i class="fas fa-users me-2"></i>
                    Gestionar Empleados
                </a>

            <a href="ventas.php" class="btn btn-light btn-lg">
                <i class="fas fa-chart-line me-2"></i>
                Gestionar Ventas
            </a>
        </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-12">
                    <h2 class="fw-bold">Características del Sistema</h2>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-calculator fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">Análisis de Empleados</h5>
                            <p class="card-text">
                                Calcula promedios salariales por departamento, identifica empleados destacados
                                y genera reportes detallados.
                            </p>
                            <a href="empleados.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-chart-pie fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title">Estadísticas de Ventas</h5>
                            <p class="card-text">
                                Analiza ventas, identifica mejores clientes y productos más vendidos
                                con métricas avanzadas.
                            </p>
                            <a href="ventas.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                            </div>
                            <h5 class="card-title">Reportes PDF</h5>
                            <p class="card-text">
                                Genera reportes profesionales en PDF y envíalos por email
                                automáticamente.
                            </p>
                            <a href="empleados.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-money-bill-wave fa-3x text-warning"></i>
                            </div>
                            <h5 class="card-title">Cálculo Salarial</h5>
                            <p class="card-text">
                                Calcula salarios netos aplicando deducciones de ley colombiana
                                automáticamente.
                            </p>
                            <a href="salario_neto.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-percent fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title">Interés Compuesto</h5>
                            <p class="card-text">
                                Calcula inversiones y proyecciones financieras con
                                fórmulas de interés compuesto.
                            </p>
                            <a href="interes_compuesto.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-exchange-alt fa-3x text-secondary"></i>
                            </div>
                            <h5 class="card-title">Conversiones</h5>
                            <p class="card-text">
                                Convierte unidades de temperatura y velocidad
                                para análisis técnicos.
                            </p>
                            <a href="temperatura.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 Sistema de Gestión.</p>
            <p class="small mb-0">
                Ingenieria Informatica - Universidad de Caldas
            </p>
            <p class="small mb-0">Jhon Edison Garcia Garcia</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
