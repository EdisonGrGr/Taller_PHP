<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-building me-2"></i>
                Sistema
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Inicio</a>
                <a class="nav-link active" href="empleados.php">Empleados</a>
                <a class="nav-link" href="ventas.php">Ventas</a>
                <a class="nav-link text-warning" href="init_data.php?reset=1">
                            <i class="fas fa-sync-alt me-1"></i>
                        </a>
            </div>
            
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1><i class="fas fa-users me-2"></i>Gestión de Empleados</h1>
                    <div>
                        <a href="empleado_form.php" class="btn btn-primary me-2">
                            <i class="fas fa-plus me-1"></i>Nuevo Empleado
                        </a>
                        <a href="empleado_pdf.php" class="btn btn-danger me-2">
                            <i class="fas fa-file-pdf me-1"></i>Generar PDF
                        </a>
                        <a href="empleado_email.php" class="btn btn-success">
                            <i class="fas fa-envelope me-1"></i>Enviar Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            Empleado agregado exitosamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Total Empleados</h6>
                                <h2 class="mb-0"><?= count($empleados) ?></h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Departamentos</h6>
                                <h2 class="mb-0"><?= count($estadisticas['promedios']) ?></h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-building fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Sobre Promedio</h6>
                                <h2 class="mb-0"><?= count($estadisticas['empleados_sobre_promedio']) ?></h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-star fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-calculator me-2"></i>Herramientas Matemáticas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <a href="salario_neto.php" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    Calcular Salario Neto (Colombia)
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="temperatura.php" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-thermometer-half me-2"></i>
                                    Convertir Temperatura
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-chart-bar me-2"></i>Promedio Salarial por Departamento</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach ($estadisticas['promedios'] as $departamento => $data): ?>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong><?= htmlspecialchars($departamento) ?></strong>
                                <small class="text-muted">(<?= $data['cantidad_empleados'] ?> empleados)</small>
                            </div>
                            <span class="badge bg-primary">
                                $<?= number_format($data['promedio'], 0, ',', '.') ?>
                            </span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-trophy me-2"></i>Departamento Destacado</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($estadisticas['departamento_top']): ?>
                        <div class="text-center">
                            <h4 class="text-success"><?= htmlspecialchars($estadisticas['departamento_top']['departamento']) ?></h4>
                            <p class="lead">$<?= number_format($estadisticas['departamento_top']['promedio'], 0, ',', '.') ?></p>
                            <small class="text-muted">Mayor promedio salarial</small>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-list me-2"></i>Lista de Empleados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Departamento</th>
                                <th class="text-end">Salario</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($empleados as $empleado): ?>
                            <?php 
                            $sobrePromedio = false;
                            foreach ($estadisticas['empleados_sobre_promedio'] as $emp) {
                                if ($emp['empleado']->getNombre() === $empleado->getNombre()) {
                                    $sobrePromedio = true;
                                    break;
                                }
                            }
                            ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($empleado->getNombre()) ?></strong>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?= htmlspecialchars($empleado->getDepartamento()) ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <strong>$<?= number_format($empleado->getSalario(), 0, ',', '.') ?></strong>
                                </td>
                                <td class="text-center">
                                    <?php if ($sobrePromedio): ?>
                                    <span class="badge bg-success">
                                        <i class="fas fa-star me-1"></i>Sobre Promedio
                                    </span>
                                    <?php else: ?>
                                    <span class="badge bg-light text-dark">Estándar</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <?php if (!empty($estadisticas['empleados_sobre_promedio'])): ?>
        <div class="card mt-4">
            <div class="card-header">
                <h5><i class="fas fa-star me-2"></i>Empleados que Ganan Sobre el Promedio</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Departamento</th>
                                <th class="text-end">Salario</th>
                                <th class="text-end">Promedio Depto.</th>
                                <th class="text-end">Diferencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($estadisticas['empleados_sobre_promedio'] as $emp): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($emp['empleado']->getNombre()) ?></strong></td>
                                <td><?= htmlspecialchars($emp['empleado']->getDepartamento()) ?></td>
                                <td class="text-end">$<?= number_format($emp['salario'], 0, ',', '.') ?></td>
                                <td class="text-end">$<?= number_format($emp['promedio_departamento'], 0, ',', '.') ?></td>
                                <td class="text-end text-success">
                                    <strong>+$<?= number_format($emp['diferencia'], 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

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
