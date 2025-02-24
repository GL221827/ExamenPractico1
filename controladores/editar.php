<?php
include "../producto.php";
$producto = new Producto();

if (!isset($_POST["productoCodigo"]) || empty($_POST["productoCodigo"])) {
    die("Error: Código de producto no válido.");
}

$codigo = $_POST["productoCodigo"];
$nombre = $_POST["productoNombre"];
$descripcion = $_POST["productoDescripcion"];
$categoria = $_POST["productoCategoria"];
$precio = $_POST["productoPrecio"];
$existencias = $_POST["productoExistencias"];
$imagenActual = $_POST["imagenActual"] ?? ""; 

// Si el usuario sube una nueva imagen se usa esa, de lo contrario se mantiene la actual
if (!empty($_FILES["productoImagen"]["name"])) {
    $imagen = $_FILES["productoImagen"]["name"];
} else {
    $imagen = $imagenActual;
}

// llamando a la funcion para editar 
$producto->editarProducto($codigo, $nombre, $descripcion, $imagen, $categoria, $precio, $existencias);

header("Location: ../admin.php");
?>
