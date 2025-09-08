<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Salario Neto</title>
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
                        <h4><i class="fas fa-money-bill-wave me-2"></i>Calculadora de Salario Neto (Colombia)</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="salario" class="form-label">Salario Bruto Mensual</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="salario" name="salario" 
                                           value="<?= $_POST['salario'] ?? '' ?>" min="1160000" step="1000" required>
                                    <span class="input-group-text">COP</span>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="empleados.php" class="btn btn-secondary">
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
                                    <i class="fas fa-check-circle me-2"></i>Resultado del Cálculo
                                </h5>
                                
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td><strong>Salario Bruto:</strong></td>
                                                <td class="text-end">$<?= number_format($resultado['salario_bruto'], 0, ',', '.') ?></td>
                                            </tr>
                                            <tr class="table-warning">
                                                <td>Salud (4%):</td>
                                                <td class="text-end">-$<?= number_format($resultado['salud_empleado'], 0, ',', '.') ?></td>
                                            </tr>
                                            <tr class="table-warning">
                                                <td>Pensión (4%):</td>
                                                <td class="text-end">-$<?= number_format($resultado['pension_empleado'], 0, ',', '.') ?></td>
                                            </tr>
                                            <tr class="table-warning">
                                                <td>Retención en la Fuente:</td>
                                                <td class="text-end">-$<?= number_format($resultado['retencion_fuente'], 0, ',', '.') ?></td>
                                            </tr>
                                            <tr class="table-danger">
                                                <td><strong>Total Deducciones:</strong></td>
                                                <td class="text-end"><strong>-$<?= number_format($resultado['total_deducciones'], 0, ',', '.') ?></strong></td>
                                            </tr>
                                            <tr class="table-success">
                                                <td><strong>Salario Neto:</strong></td>
                                                <td class="text-end"><strong>$<?= number_format($resultado['salario_neto'], 0, ',', '.') ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="alert alert-info">
                                    <strong>Nota:</strong> Este cálculo es una aproximación basada en las deducciones básicas 
                                    de ley en Colombia (salud, pensión y retención en la fuente). No incluye otras deducciones 
                                    como préstamos, embargos, etc.
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
