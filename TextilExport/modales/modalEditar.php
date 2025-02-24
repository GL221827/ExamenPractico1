<!-- Modal para editar los productos -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarProducto" method="POST" action="controladores/editar.php" enctype="multipart/form-data">
                    <input type="hidden" name="productoCodigo" id="productoCodigo">

                    <label>Nombre:</label>
                    <input type="text" name="productoNombre" id="productoNombre" class="form-control" required>

                    <label>Descripción:</label>
                    <textarea name="productoDescripcion" id="productoDescripcion" class="form-control" required></textarea>

                    <label>Imagen:</label>
                    <input type="file" name="productoImagen" id="productoImagen" class="form-control">

                    <label>Categoría:</label>
                    <select name="productoCategoria" id="productoCategoria" class="form-control">
                        <option value="Textil">Textil</option>
                        <option value="Promocional">Promocional</option>
                    </select>

                    <label>Precio:</label>
                    <input type="number" name="productoPrecio" id="productoPrecio" class="form-control" step="0.01" required>

                    <label>Existencias:</label>
                    <input type="number" name="productoExistencias" id="productoExistencias" class="form-control" min="0" required>

                    <button type="submit" class="btn btn-success mt-3">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
