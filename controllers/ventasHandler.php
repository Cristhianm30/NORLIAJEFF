<?php
session_start();
require_once '../models/ventas.php';
require_once '../models/conexion.php';
require_once '../controllers/ventasController.php';
require_once '../controllers/productoController.php';
require_once '../controllers/clienteController.php';

$ventasController = new VentasController();
$productoController = new ProductoController();
$clienteController = new clienteController();
$usuarioID = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        $productoNombre = $_POST['producto_name']; 
        $clienteNombre = $_POST['cliente_name']; 

        // Obtén el ID del producto y cliente basado en el nombre
        $producto = $productoController->obtenerProductoPorNombre($productoNombre, $usuario_id);
        $cliente = $clienteController->obtenerclientePorNombre($clienteNombre, $usuario_id);

        if ($producto) {
            $producto_id = $producto->getID();
        } else {
            $_SESSION['error_message'] = "Producto no encontrado.";
            header('Location: ../templates/ventas.php');
            exit();
        }

        if ($cliente) {
            $cliente_id = $cliente->getID();
        } else {
            $_SESSION['error_message'] = "Cliente no encontrado.";
            header('Location: ../templates/ventas.php');
            exit();
        }

        switch ($accion) {
            case 'crear':
                $fecha = $_POST['fecha'];
                $total = $_POST['total'];
                $cantidad = $_POST['cantidad'];
                $precio = $_POST['precio'];
                $productoID = $_POST['producto_id'];
                $clienteID = $_POST['cliente_id'];
                $usuarioID = $_POST['usuario_id']; // Asegúrate de que este valor se toma del formulario

                $ventasController->crearVenta($fecha, $total, $cantidad, $precio, $productoID, $usuarioID, $clienteID);
                header('Location: ../templates/ventas.php');
                break;

            case 'actualizar':
                $id = $_POST['id'];
                $fecha = $_POST['fecha'];
                $total = $_POST['total'];
                $cantidad = $_POST['cantidad'];
                $precio = $_POST['precio'];
                $productoID = $_POST['producto_id'];
                $clienteID = $_POST['cliente_id'];
                $usuarioID = $_POST['usuario_id']; // Asegúrate de que este valor se toma del formulario

                $ventasController->actualizarVenta($id, $fecha, $total, $cantidad, $precio, $productoID, $usuarioID, $clienteID);
                header('Location: ../templates/ventas.php');
                break;

            case 'eliminar':
                $id = $_GET['id'];
                $ventasController->eliminarVenta($id);
                header('Location: ../templates/ventas.php');
                break;

            default:
                echo "Acción no válida";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
        $id = $_GET['id'];
        $ventasController->eliminarVenta($id);
        header('Location: ../templates/ventas.php');
    }
}
?>
