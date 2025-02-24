<?php
require_once '../producto.php';
$producto = new Producto();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];

    // Valida que se haya subido una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaDestino = '../assets/img/' . $nombreImagen;

        // Verifica si el archivo es una imagen válida
        $tipoArchivo = mime_content_type($_FILES['imagen']['tmp_name']);
        if (!in_array($tipoArchivo, ['image/png', 'image/jpeg'])) {
            die("Error: La imagen debe estar en formato PNG o JPG.");
        }

        // Mover la imagen a la carpeta de destino
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $producto->agregarProducto($codigo, $nombre, $descripcion, $nombreImagen, $categoria, $precio, $existencias);
            header('Location: ../admin.php');
            exit();
        } else {
            die("Error: No se pudo subir la imagen.");
        }
    } else {
        die("Error: Debe subir una imagen.");
    }
}
?>
