<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Reporte de Ventas</title>
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
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-envelope me-2"></i>Enviar Reporte de Ventas</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($mensaje): ?>
                        <div class="alert alert-<?= strpos($mensaje, 'exitosamente') !== false ? 'success' : 'danger' ?> mb-4">
                            <i class="fas fa-<?= strpos($mensaje, 'exitosamente') !== false ? 'check-circle' : 'exclamation-triangle' ?> me-2"></i>
                            <?= htmlspecialchars($mensaje) ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Dirección de Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           placeholder="ejemplo@correo.com" required>
                                </div>
                                <div class="form-text">Se enviará un PDF con el reporte completo de ventas</div>
                            </div>
                            
                            <div class="alert alert-info">
                                <strong>El reporte incluirá:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Lista completa de ventas</li>
                                    <li>Cliente que más gastó</li>
                                    <li>Producto más vendido</li>
                                    <li>Estadísticas generales</li>
                                </ul>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="ventas.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Volver
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane me-1"></i>Enviar Reporte
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
