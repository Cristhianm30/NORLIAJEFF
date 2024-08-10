<?php

require_once __DIR__ . '/../../controllers/Conexion.php';

class Cliente {
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $direccion;
    private $telefono;
    private $usuario_id;

    public function __construct($id, $nombre, $apellido, $correo, $direccion, $telefono, $usuario_id) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->usuario_id = $usuario_id;
    }

    // Getters y Setters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getApellido() { return $this->apellido; }
    public function getCorreo() { return $this->correo; }
    public function getDireccion() { return $this->direccion; }
    public function getTelefono() { return $this->telefono; }
    public function getUsuarioId() { return $this->usuario_id; }

    public function setId($id) { $this->id = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellido($apellido) { $this->apellido = $apellido; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setUsuarioId($usuario_id) { $this->usuario_id = $usuario_id; }

    // Métodos de la base de datos
    public function crear() {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        $sql = "INSERT INTO cliente (Nombre, Apellido, Correo, Direccion, Telefono, UsuarioID) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $conn->error);
        }

        $stmt->bind_param("sssssi", $this->nombre, $this->apellido, $this->correo, $this->direccion, $this->telefono, $this->usuario_id);
        if ($stmt->execute()) {
            $this->id = $conn->insert_id;
            $stmt->close();
            $conexion->cerrarConexion();
            return true;
        } else {
            die('Error en la ejecución de la consulta: ' . $stmt->error);
            $stmt->close();
            $conexion->cerrarConexion();
            return false;
        }
    }

    public static function obtenerPorUsuario($usuario_id) {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        $sql = "SELECT * FROM cliente WHERE UsuarioID = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $conn->error);
        }

        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $clientes = [];
        while ($row = $resultado->fetch_assoc()) {
            $clientes[] = $row;
        }
        $stmt->close();
        $conexion->cerrarConexion();
        return $clientes;
    }

    public static function eliminar($id) {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        $sql = "DELETE FROM cliente WHERE ID = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $conn->error);
        }
    
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->close();
            $conexion->cerrarConexion();
            return true;
        } else {
            die('Error en la ejecución de la consulta: ' . $stmt->error);
            $stmt->close();
            $conexion->cerrarConexion();
            return false;
        }
    }

    public static function obtenerPorId($id) {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        $sql = "SELECT * FROM cliente WHERE ID = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $conn->error);
        }
    
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $cliente = $resultado->fetch_assoc();
        $stmt->close();
        $conexion->cerrarConexion();
        return $cliente;
    }
    
    public function actualizar() {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        $sql = "UPDATE cliente SET Nombre = ?, Apellido = ?, Correo = ?, Direccion = ?, Telefono = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $conn->error);
        }
    
        $stmt->bind_param("sssssi", $this->nombre, $this->apellido, $this->correo, $this->direccion, $this->telefono, $this->id);
        if ($stmt->execute()) {
            $stmt->close();
            $conexion->cerrarConexion();
            return true;
        } else {
            die('Error en la ejecución de la consulta: ' . $stmt->error);
            $stmt->close();
            $conexion->cerrarConexion();
            return false;
        }
    }
    
    
}
?>
