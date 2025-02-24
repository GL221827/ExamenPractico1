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
    <title>Tienda - Productos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body { background-color:rgb(255, 255, 255); }
        .navbar { background-color:rgb(9, 9, 28); }
        .navbar-brand { color: white; font-size: 2rem; font-weight: bold; }
        .card { transition: transform 0.3s,  box-shadow 0.3s; border-radius: 10px; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); }
        
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#"> <img src="assets/img/logo.png" style="height: 55px; object-fit: cover; margin-right: 20px;" alt="">TextilExport</a>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center mb-4">Nuestros Productos</h1>

    <!-- Filtros de busqueda -->
    <div class="row mb-4">
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar productos..." onkeyup="filtrarProductos()">
        </div>
        <div class="col-md-6">
            <select id="filterCategory" class="form-control" onchange="filtrarProductos()">
                <option value="">Todas las categorías</option>
                <option value="Textil">Textil</option>
                <option value="Promocional">Promocional</option>
            </select>
        </div>
    </div>

    <div class="row" id="productosContainer">
        <?php foreach ($productos->producto as $p) : ?>
            <div class="col-md-4 producto" data-categoria="<?= $p->categoria; ?>">
                <div class="card text-center p-3">
                    <img src="assets/img/<?= $p->imagen; ?>" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $p->nombre; ?></h5>
                       
                        <p class="fw-bold text-primary">$<?= $p->precio; ?></p>
                        <!-- Boton para ver los detalles del producto -->
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalProduct<?= $p->codigo; ?>">
                            <i class="fas fa-eye"></i> Ver Detalles
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include 'modales/modalProduct.php'; ?>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
function filtrarProductos() {
    let searchInput = document.getElementById('searchInput').value.toLowerCase();
    let selectedCategory = document.getElementById('filterCategory').value.toLowerCase();
    let productos = document.querySelectorAll('.producto');

    productos.forEach(producto => {
        let nombre = producto.querySelector('.card-title').textContent.toLowerCase();
        
        let categoria = producto.getAttribute('data-categoria').toLowerCase();

        let matchesSearch = nombre.includes(searchInput);
        let matchesCategory = selectedCategory === "" || categoria === selectedCategory;

        if (matchesSearch && matchesCategory) {
            producto.style.display = "block";
        } else {
            producto.style.display = "none";
        }
    });
}
</script>

</body>
</html>
