<?php
session_start();
require_once 'Conexion.php';
require_once '../models/Entidades/E_usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    // Crear una instancia de la clase Conexion y obtener la conexión
    $conexion = new Conexion();
    $conn = $conexion->getConexion();

    // Buscar usuario en la base de datos
    $sql = "SELECT ID, Contrasena FROM Usuario WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        // Verificar contraseña
        if (password_verify($contrasena, $hashed_password)) {
            $_SESSION["usuario_id"] = $id;
            header("Location: ../templates/Carga.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo electrónico no encontrado.";
    }
    $stmt->close();
    $conn->close();
}
?>
