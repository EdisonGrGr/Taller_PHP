<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Velocidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-building me-2"></i>
                Sistema Empresarial
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Inicio</a>
                <a class="nav-link" href="empleados.php">Empleados</a>
                <a class="nav-link" href="ventas.php">Ventas</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-tachometer-alt me-2"></i>Conversor de Velocidad</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="valor" class="form-label">Valor</label>
                                    <input type="number" class="form-control" id="valor" name="valor" 
                                           value="<?= $_POST['valor'] ?? '' ?>" min="0" step="0.01" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="unidad_origen" class="form-label">Unidad Origen</label>
                                    <select class="form-select" id="unidad_origen" name="unidad_origen" required>
                                        <option value="">Seleccionar</option>
                                        <option value="kmh" <?= ($_POST['unidad_origen'] ?? '') === 'kmh' ? 'selected' : '' ?>>Km/h (Kilómetros por hora)</option>
                                        <option value="mph" <?= ($_POST['unidad_origen'] ?? '') === 'mph' ? 'selected' : '' ?>>Mph (Millas por hora)</option>
                                        <option value="ms" <?= ($_POST['unidad_origen'] ?? '') === 'ms' ? 'selected' : '' ?>>m/s (Metros por segundo)</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="unidad_destino" class="form-label">Unidad Destino</label>
                                    <select class="form-select" id="unidad_destino" name="unidad_destino" required>
                                        <option value="">Seleccionar</option>
                                        <option value="kmh" <?= ($_POST['unidad_destino'] ?? '') === 'kmh' ? 'selected' : '' ?>>Km/h (Kilómetros por hora)</option>
                                        <option value="mph" <?= ($_POST['unidad_destino'] ?? '') === 'mph' ? 'selected' : '' ?>>Mph (Millas por hora)</option>
                                        <option value="ms" <?= ($_POST['unidad_destino'] ?? '') === 'ms' ? 'selected' : '' ?>>m/s (Metros por segundo)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="ventas.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-exchange-alt me-1"></i>Convertir
                                </button>
                            </div>
                        </form>

                        <?php if ($resultado): ?>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-success mb-3">
                                    <i class="fas fa-check-circle me-2"></i>Resultado de la Conversión
                                </h5>
                                
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                        <div class="card bg-primary text-white text-center">
                                            <div class="card-body">
                                                <i class="fas fa-play fa-2x mb-2"></i>
                                                <h3><?= $resultado['valor_original'] ?></h3>
                                                <p class="mb-0">
                                                    <?php
                                                    $unidades = [
                                                        'kmh' => 'Km/h',
                                                        'mph' => 'Mph', 
                                                        'ms' => 'm/s'
                                                    ];
                                                    echo $unidades[$resultado['unidad_origen']];
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-arrow-right fa-2x text-muted"></i>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card bg-success text-white text-center">
                                            <div class="card-body">
                                                <i class="fas fa-flag-checkered fa-2x mb-2"></i>
                                                <h3><?= $resultado['valor_convertido'] ?></h3>
                                                <p class="mb-0">
                                                    <?= $unidades[$resultado['unidad_destino']] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info mt-3">
                                    <strong>Conversión realizada:</strong><br>
                                    <?= $resultado['valor_original'] ?> <?= $unidades[$resultado['unidad_origen']] ?> = 
                                    <?= $resultado['valor_convertido'] ?> <?= $unidades[$resultado['unidad_destino']] ?>
                                </div>
                                
                                <div class="alert alert-secondary">
                                    <strong>Factores de conversión:</strong><br>
                                    • 1 Km/h = 0.278 m/s<br>
                                    • 1 Mph = 0.447 m/s<br>
                                    • 1 m/s = 3.6 Km/h = 2.237 Mph
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
