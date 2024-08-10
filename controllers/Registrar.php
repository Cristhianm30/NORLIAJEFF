<?php
require_once '../models/Entidades/E_usuario.php';
require_once 'Conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["email"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

    // Crear una instancia de la clase Usuario
    $usuario = new Usuario(null, $nombre, $apellido, $correo, $contrasena);

    // Crear una instancia de la clase Conexion y obtener la conexión
    $conexion = new Conexion();
    $conn = $conexion->getConexion();

    // Insertar los datos del usuario en la base de datos
    $sql = "INSERT INTO Usuario (Nombre, Apellido, Email, Contrasena) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("ssss", $usuario->getNombre(), $usuario->getApellido(), $usuario->getEmail(), $usuario->getContrasena());

    if ($stmt->execute() === TRUE) {
        header("Location: ../templates/login.php");
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
