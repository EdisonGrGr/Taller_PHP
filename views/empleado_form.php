<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Empleado</title>
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
                <a class="nav-link active" href="empleados.php">Empleados</a>
                <a class="nav-link" href="ventas.php">Ventas</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-user-plus me-2"></i>Agregar Nuevo Empleado</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="departamento" class="form-label">Departamento</label>
                                    <select class="form-select" id="departamento" name="departamento" required>
                                        <option value="">Seleccionar departamento</option>
                                        <option value="Desarrollo">Desarrollo</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Ventas">Ventas</option>
                                        <option value="Recursos Humanos">Recursos Humanos</option>
                                        <option value="Gerencia">Gerencia</option>
                                        <option value="Contabilidad">Contabilidad</option>
                                        <option value="Soporte">Soporte</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="salario" class="form-label">Salario</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="salario" name="salario" 
                                               min="1160000" step="1000" required>
                                        <span class="input-group-text">COP</span>
                                    </div>
                                    <div class="form-text">Salario mínimo en Colombia: $1.160.000</div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="empleados.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Guardar Empleado
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
