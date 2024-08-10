<?php
require_once __DIR__ . '/../models/Clases/Cliente.php';

class ClienteController {

    public function manejarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['BtnRegistrar'])) {
                $this->registrarCliente();
            } elseif (isset($_POST['BtnActualizar'])) {
                $this->actualizarCliente();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['accion'])) {
                switch ($_GET['accion']) {
                    case 'eliminar':
                        $this->eliminarCliente();
                        break;
                    case 'mostrar':
                        // Asegúrate de que el usuario_id esté disponible
                        if (isset($_SESSION['usuario_id'])) {
                            $this->mostrarClientes($_SESSION['usuario_id']); // Pasar usuario_id
                        } else {
                            echo "Usuario no autenticado";
                        }
                        break;
                }
            }
        }
    }

    // Método para obtener clientes por usuario
    public function mostrarClientes($usuario_id) {
        $clientes = Cliente::obtenerPorUsuario($usuario_id);
        return $clientes; // Devuelve los clientes en lugar de imprimirlos directamente
    }

    private function registrarCliente() {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $usuario_id = $_POST['usuario_id'];

        $cliente = new Cliente(null, $nombre, $apellido, $correo, $direccion, $telefono, $usuario_id);
        if ($cliente->crear()) {
            header("Location: /templates/Base.php?mensaje=Cliente registrado correctamente");
            exit();
        } else {
            echo "Error al registrar cliente.";
        }
    }

    private function actualizarCliente() {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        $cliente = new Cliente($id, $nombre, $apellido, $correo, $direccion, $telefono, null);
        if ($cliente->actualizar()) {
            header("Location: /templates/Base.php?mensaje=Cliente actualizado correctamente");
            exit();
        } else {
            echo "Error al actualizar el cliente.";
        }
    }

    private function eliminarCliente() {
        $cliente_id = intval($_GET['id']);
        if (Cliente::eliminar($cliente_id)) {
            header('Location: /templates/Base.php?mensaje=Cliente eliminado correctamente');
            exit();
        } else {
            echo "Error al eliminar el cliente.";
        }
    }
}

// Crear una instancia del controlador y manejar la solicitud
$controller = new ClienteController();
$controller->manejarSolicitud();
?>
