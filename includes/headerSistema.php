<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../templates/login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA DE INFORMACION</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body class="fondo">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Título h1 -->
            <h1 class="navbar-brand text-black font-weight-bold">NORLIAJEFF</h1>

            <!-- Botón de la barra de navegación para dispositivos pequeños -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mi-menu"> 
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenedor para los enlaces de la barra de navegación y el menú desplegable -->
            <div class="collapse navbar-collapse justify-content-center" id="mi-menu">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="../templates/preguntas.php" class="nav-link">Preguntas frecuentes</a></li>
                </ul>
            </div>
                <!-- Menú desplegable -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sistema
                        </a>

                        <!--HAY QUE MODIFICAR LAS RUTAS PARA CADA MODULO-->
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="">Clientes</a></li>
                            <li><a class="dropdown-item" href="">Productos</a></li>
                            <li><a class="dropdown-item" href="">Proveedores</a></li>
                            <li><a class="dropdown-item" href="">Compras</a></li>
                            <li><a class="dropdown-item" href="">Ventas</a></li>
                            <li><a class="dropdown-item" href="../controllers/cerrarSesion.php" id="sesion">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>