<?php
require_once '../producto.php';
$producto = new Producto();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $producto->borrarProducto($codigo);
    header('Location: ../admin.php');
    exit();
}
?>
