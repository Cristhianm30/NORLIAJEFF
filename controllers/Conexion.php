<?php
class Conexion {
    private $host = 'localhost';
    private $usuario = 'root';
    private $contrasena = '';
    private $base_de_datos = 'prueba_usuario';
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->usuario, $this->contrasena, $this->base_de_datos);
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function getConexion() {
        return $this->conn;
    }

    public function cerrarConexion() {
        $this->conn->close();
    }
}
?>
