<?php foreach ($productos->producto as $producto): ?>
<!--Modal unico por prodcuto, el cual mostrara los detalles del producto, tanto al administrador como al usuario publico -->
<div class="modal fade" id="modalProduct<?= $producto->codigo; ?>" tabindex="-1" aria-labelledby="modalProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <img src="assets/img/<?= $producto->imagen; ?>" class="img-fluid mb-3" alt="Producto">
                <h5><?= $producto->nombre; ?></h5>
                <p><?= $producto->descripcion; ?></p>
                <p><strong>Categoría:</strong> <?= $producto->categoria; ?></p>
                <p><strong>Precio:</strong> $<?= $producto->precio; ?></p>
                <p><strong>Disponibilidad:</strong> 
                    <?= ($producto->existencias > 0) ? $producto->existencias . " unidades" : "<span class='text-danger'>Producto no disponible</span>"; ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
