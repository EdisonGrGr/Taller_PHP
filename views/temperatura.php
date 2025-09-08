<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Temperatura</title>
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
                        <h4><i class="fas fa-thermometer-half me-2"></i>Conversor de Temperatura</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="celsius" class="form-label">Temperatura en Celsius</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="celsius" name="celsius" 
                                           value="<?= $_POST['celsius'] ?? '' ?>" step="0.01" required>
                                    <span class="input-group-text">°C</span>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="empleados.php" class="btn btn-secondary">
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
                                    <i class="fas fa-check-circle me-2"></i>Conversiones de Temperatura
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card bg-primary text-white text-center">
                                            <div class="card-body">
                                                <i class="fas fa-thermometer-quarter fa-2x mb-2"></i>
                                                <h3><?= $resultado['celsius'] ?>°</h3>
                                                <p class="mb-0">Celsius</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-success text-white text-center">
                                            <div class="card-body">
                                                <i class="fas fa-thermometer-half fa-2x mb-2"></i>
                                                <h3><?= $resultado['fahrenheit'] ?>°</h3>
                                                <p class="mb-0">Fahrenheit</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-warning text-white text-center">
                                            <div class="card-body">
                                                <i class="fas fa-thermometer-full fa-2x mb-2"></i>
                                                <h3><?= $resultado['kelvin'] ?></h3>
                                                <p class="mb-0">Kelvin</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info mt-3">
                                    <strong>Fórmulas utilizadas:</strong><br>
                                    • Fahrenheit = (Celsius × 9/5) + 32<br>
                                    • Kelvin = Celsius + 273.15
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
