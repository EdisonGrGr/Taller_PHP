<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Venta</title>
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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-shopping-cart me-2"></i>Registrar Nueva Venta</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="id" class="form-label">ID de Venta</label>
                                    <input type="number" class="form-control" id="id" name="id" 
                                           value="<?= rand(1000, 9999) ?>" min="1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" 
                                           value="<?= date('Y-m-d') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cliente" class="form-label">Cliente</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="producto" class="form-label">Producto</label>
                                    <select class="form-select" id="producto" name="producto" required>
                                        <option value="">Seleccionar producto</option>
                                        <option value="Laptop HP">Laptop HP</option>
                                        <option value="Mouse Logitech">Mouse Logitech</option>
                                        <option value="Teclado Mecánico">Teclado Mecánico</option>
                                        <option value="Monitor Samsung">Monitor Samsung</option>
                                        <option value="Impresora Canon">Impresora Canon</option>
                                        <option value="Tablet iPad">Tablet iPad</option>
                                        <option value="Smartphone">Smartphone</option>
                                        <option value="Auriculares">Auriculares</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad" 
                                           min="1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" 
                                               min="1000" step="1000" required>
                                        <span class="input-group-text">COP</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="ventas.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Registrar Venta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            const cantidad = document.getElementById('cantidad');
            const precio = document.getElementById('precio_unitario');
            
            function calcularTotal() {
                const cant = parseFloat(cantidad.value) || 0;
                const prec = parseFloat(precio.value) || 0;
                const total = cant * prec;
                
                
                console.log('Total:', total.toLocaleString('es-CO'));
            }
            
            cantidad.addEventListener('input', calcularTotal);
            precio.addEventListener('input', calcularTotal);
        });
    </script>
</body>
</html>
