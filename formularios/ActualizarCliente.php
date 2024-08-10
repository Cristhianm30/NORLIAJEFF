<?php
    include '../includes/headerSistema.php';
?>

<?php
require_once '../models/Clases/Cliente.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cliente = Cliente::obtenerPorId($id); // Crear un nuevo método para obtener un cliente por ID
    if ($cliente) {
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="col-4 p-3" action="/../models/CRUD/ModificarCliente.php" method="POST">
                <h2 class="text-center" id="titulo">Actualizar Cliente</h2>
                <input type="hidden" name="id" value="<?php echo $cliente['ID']; ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del cliente</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $cliente['Nombre']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido del cliente</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo $cliente['Apellido']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" name="correo" value="<?php echo $cliente['Correo']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="tel" class="form-control" name="telefono" value="<?php echo $cliente['Telefono']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="direccion" value="<?php echo $cliente['Direccion']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="BtnActualizar" value="OK">Actualizar</button>
            </form>
        </div>
        <?php
    } else {
        echo "Cliente no encontrado.";
    }
} else {
    echo "ID de cliente no proporcionado.";
}
?>

<?php
    include '../includes/footer.php';
?>
