<?php
class Producto {
    private $file = __DIR__ . '/ProductData.xml'; 

    public function __construct() {
        if (!file_exists($this->file)) {
            $this->crearXML();
        }
    }

    private function crearXML() {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><productos></productos>');
        $xml->asXML($this->file);
    }

    public function obtenerProductos() {
        if (!file_exists($this->file)) {
            $this->crearXML();
        }
        return simplexml_load_file($this->file);
    }

    public function agregarProducto($codigo, $nombre, $descripcion, $imagen, $categoria, $precio, $existencias) {
        if (!preg_match('/^PROD\\d{5}$/', $codigo)) {
            die("Error: El código debe tener el formato PROD#####.");
        }
        if (!$this->validarImagen($imagen)) {
            die("Error: La imagen debe estar en formato PNG o JPG.");
        }
        
        $xml = $this->obtenerProductos();
        foreach ($xml->producto as $producto) {
            if ($producto->codigo == $codigo) {
                die("Error: Ya existe un producto con este código.");
            }
        }

        $producto = $xml->addChild('producto');
        $producto->addChild('codigo', $codigo);
        $producto->addChild('nombre', $nombre);
        $producto->addChild('descripcion', $descripcion);
        $producto->addChild('imagen', $imagen);
        $producto->addChild('categoria', $categoria);
        $producto->addChild('precio', $precio);
        $producto->addChild('existencias', $existencias);
        $xml->asXML($this->file);
    }

    public function editarProducto($codigo, $nombre, $descripcion, $imagen, $categoria, $precio, $existencias) {
        $xml = $this->obtenerProductos();
        foreach ($xml->producto as $producto) {
            if ($producto->codigo == $codigo) {
                $producto->nombre = $nombre;
                $producto->descripcion = $descripcion;
                $producto->imagen = $imagen;
                $producto->categoria = $categoria;
                $producto->precio = $precio;
                $producto->existencias = $existencias;
                $xml->asXML($this->file);
                return;
            }
        }
        die("Error: No se encontró el producto con código $codigo.");
    }

    public function borrarProducto($codigo) {
        $xml = $this->obtenerProductos();
        $productosNuevos = new SimpleXMLElement('<productos></productos>');

        foreach ($xml->producto as $producto) {
            if ($producto->codigo != $codigo) {
                $nuevoProducto = $productosNuevos->addChild('producto');
                $nuevoProducto->addChild('codigo', $producto->codigo);
                $nuevoProducto->addChild('nombre', $producto->nombre);
                $nuevoProducto->addChild('descripcion', $producto->descripcion);
                $nuevoProducto->addChild('imagen', $producto->imagen);
                $nuevoProducto->addChild('categoria', $producto->categoria);
                $nuevoProducto->addChild('precio', $producto->precio);
                $nuevoProducto->addChild('existencias', $producto->existencias);
            }
        }
        $productosNuevos->asXML($this->file);
    }

    private function validarImagen($imagen) {
        if (empty($imagen)) {
            return false;
        }
        $extension = pathinfo($imagen, PATHINFO_EXTENSION);
        return in_array(strtolower($extension), ['jpg', 'png']);
    }
}
?>
