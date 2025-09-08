<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Interés Compuesto</title>
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
                <a class="nav-link" href="ventas.php">Ventas</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-percent me-2"></i>Calculadora de Interés Compuesto</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="capital" class="form-label">Capital Inicial</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="capital" name="capital" 
                                               value="<?= $_POST['capital'] ?? '' ?>" min="1000" step="1000" required>
                                        <span class="input-group-text">COP</span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="tasa" class="form-label">Tasa de Interés Anual</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="tasa" name="tasa" 
                                               value="<?= $_POST['tasa'] ?? '' ?>" min="0.1" step="0.1" required>
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="tiempo" class="form-label">Tiempo</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="tiempo" name="tiempo" 
                                               value="<?= $_POST['tiempo'] ?? '' ?>" min="1" required>
                                        <span class="input-group-text">años</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="ventas.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-calculator me-1"></i>Calcular
                                </button>
                            </div>
                        </form>

                        <?php if ($resultado): ?>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-success mb-3">
                                    <i class="fas fa-chart-line me-2"></i>Resultado de la Inversión
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card bg-primary text-white text-center">
                                            <div class="card-body">
                                                <i class="fas fa-piggy-bank fa-2x mb-2"></i>
                                                <h4>$<?= number_format($resultado['capital_inicial'], 0, ',', '.') ?></h4>
                                                <p class="mb-0">Capital Inicial</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-success text-white text-center">
                                            <div class="card-body">
                                                <i class="fas fa-money-bill-wave fa-2x mb-2"></i>
                                                <h4>$<?= number_format($resultado['monto_final'], 0, ',', '.') ?></h4>
                                                <p class="mb-0">Monto Final</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td><strong>Capital Inicial:</strong></td>
                                                <td class="text-end">$<?= number_format($resultado['capital_inicial'], 0, ',', '.') ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tasa de Interés:</strong></td>
                                                <td class="text-end"><?= $resultado['tasa_anual'] ?>% anual</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tiempo:</strong></td>
                                                <td class="text-end"><?= $resultado['tiempo_anos'] ?> años</td>
                                            </tr>
                                            <tr class="table-success">
                                                <td><strong>Intereses Ganados:</strong></td>
                                                <td class="text-end"><strong>$<?= number_format($resultado['intereses_ganados'], 0, ',', '.') ?></strong></td>
                                            </tr>
                                            <tr class="table-warning">
                                                <td><strong>Monto Final:</strong></td>
                                                <td class="text-end"><strong>$<?= number_format($resultado['monto_final'], 0, ',', '.') ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
