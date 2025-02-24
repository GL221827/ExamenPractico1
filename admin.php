<?php
require_once 'producto.php';
$producto = new Producto();
$productos = $producto->obtenerProductos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Productos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color:rgb(23, 55, 87); }
        .navbar-brand { color: white; font-size: 2rem; font-weight: bold; }
        .card { transition: transform 0.3s, box-shadow 0.3s; border-radius: 10px; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); }
        .btn-add { background-color: #28a745; color: white; border-radius: 5px; }
        .btn-add:hover { background-color: #218838; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
    <a class="navbar-brand" href="#"> <img src="assets/img/logo.png" style="height: 55px; object-fit: cover; margin-right: 20px;" alt="">TextilExport - Administración</a>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center mb-4">Administración de productos</h1>
   
   
    <div class="container mt-5">
        
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdmin">Agregar Producto</button>
        <div class="row" id="productosContainer">
        <?php foreach ($productos->producto as $p) : ?>
            <div class="col-md-4 producto" data-categoria="<?= $p->categoria; ?>">
                <div class="card text-center p-3">
                        <img src="assets/img/<?= $p->imagen; ?>" class="card-img-top img-fluid" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $p->nombre; ?></h5>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalProduct<?= $p->codigo; ?>">
                                Detalles
                            </button>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar" 
                                onclick="editarProducto(
                                    '<?= $p->codigo; ?>',
                                    '<?= $p->nombre; ?>',
                                    '<?= $p->descripcion; ?>',
                                    '<?= $p->categoria; ?>',
                                    '<?= $p->precio; ?>',
                                    '<?= $p->existencias; ?>'
                                )"> Editar
                            </button>
                            <form action="controladores/borrar.php" method="POST" class="d-inline">
                                <input type="hidden" name="codigo" value="<?= $p->codigo; ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php include 'modales/modalProduct.php'; ?>
    <?php include 'modales/modalAdmin.php'; ?>
    <?php include 'modales/modalEditar.php'; ?>  

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        function editarProducto(codigo, nombre, descripcion, categoria, precio, existencias) {
            document.getElementById('productoCodigo').value = codigo;
            document.getElementById('productoNombre').value = nombre;
            document.getElementById('productoDescripcion').value = descripcion;
            document.getElementById('productoCategoria').value = categoria;
            document.getElementById('productoPrecio').value = precio;
            document.getElementById('productoExistencias').value = existencias;
        }
    </script>
</body>
</html>
