<?php
include 'db.php'; 


$sql = "SELECT nombre, email, contraseña FROM usuarios WHERE id = 1"; 
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    echo "No se encontraron datos del usuario.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h2>Perfil de Usuario</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <td><?php echo $usuario['nombre']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $usuario['email']; ?></td>
            </tr>
            <tr>
                <th>Contraseña</th>
                <td><?php echo $usuario['contraseña']; ?></td>
            </tr>
        </table>
        <a href="http://localhost/Entregable1/index.php" class="volver-btn"><i class="fa-solid fa-arrow-left"></i> Volver</a>
    </div>
</body>
</html>
