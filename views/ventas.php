<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas</title>
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
                <a class="nav-link" href="empleados.php">Empleados</a>
                <a class="nav-link active" href="ventas.php">Ventas</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1><i class="fas fa-chart-line me-2"></i>Gestión de Ventas</h1>
                    <div>
                        <a href="venta_form.php" class="btn btn-primary me-2">
                            <i class="fas fa-plus me-1"></i>Nueva Venta
                        </a>
                        <a href="venta_pdf.php" class="btn btn-danger me-2">
                            <i class="fas fa-file-pdf me-1"></i>Generar PDF
                        </a>
                        <a href="venta_email.php" class="btn btn-success">
                            <i class="fas fa-envelope me-1"></i>Enviar Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            Venta registrada exitosamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

       
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Total Ventas</h6>
                                <h2 class="mb-0"><?= $estadisticas['total_ventas'] ?></h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Ingresos Totales</h6>
                                <h3 class="mb-0">$<?= number_format($estadisticas['ingresos_totales'], 0, ',', '.') ?></h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Cliente Top</h6>
                                <p class="mb-0 small"><?= htmlspecialchars($estadisticas['cliente_top']['cliente']) ?></p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-user-tie fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Producto Top</h6>
                                <p class="mb-0 small"><?= htmlspecialchars($estadisticas['producto_top']['producto']) ?></p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-box fa-2x"></i>
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
                        <h5><i class="fas fa-calculator me-2"></i>Herramientas Financieras</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <a href="interes_compuesto.php" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-percent me-2"></i>
                                    Calcular Interés Compuesto
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="velocidad.php" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-tachometer-alt me-2"></i>
                                    Convertir Velocidad
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
                        <h5><i class="fas fa-trophy me-2"></i>Cliente que Más Gastó</h5>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="text-primary"><?= htmlspecialchars($estadisticas['cliente_top']['cliente']) ?></h4>
                        <p class="lead text-success">$<?= number_format($estadisticas['cliente_top']['total_gastado'], 0, ',', '.') ?></p>
                        <small class="text-muted"><?= $estadisticas['cliente_top']['cantidad_compras'] ?> compras realizadas</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-star me-2"></i>Producto Más Vendido</h5>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="text-warning"><?= htmlspecialchars($estadisticas['producto_top']['producto']) ?></h4>
                        <p class="lead text-info"><?= $estadisticas['producto_top']['cantidad_total'] ?> unidades</p>
                        <small class="text-muted">
                            <?= $estadisticas['producto_top']['numero_ventas'] ?> ventas | 
                            $<?= number_format($estadisticas['producto_top']['ingresos_totales'], 0, ',', '.') ?> en ingresos
                        </small>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-list me-2"></i>Lista de Ventas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio Unit.</th>
                                <th class="text-end">Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventas as $venta): ?>
                            <tr>
                                <td><strong>#<?= $venta->getId() ?></strong></td>
                                <td><?= htmlspecialchars($venta->getCliente()) ?></td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?= htmlspecialchars($venta->getProducto()) ?>
                                    </span>
                                </td>
                                <td class="text-center"><?= $venta->getCantidad() ?></td>
                                <td class="text-end">$<?= number_format($venta->getPrecioUnitario(), 0, ',', '.') ?></td>
                                <td class="text-end">
                                    <strong class="text-success">
                                        $<?= number_format($venta->getTotal(), 0, ',', '.') ?>
                                    </strong>
                                </td>
                                <td><?= htmlspecialchars($venta->getFecha()) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
