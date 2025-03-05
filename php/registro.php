<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$password')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "<p class='mensaje-exito'>Registro exitoso. <a href='http://localhost/Entregable1/login.php'>Iniciar sesión</a></p>";
    } else {
        $mensaje = "<p class='mensaje-error'>Error: " . $conexion->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link rel="stylesheet" href="../css/style.css"> 
</head>

<body>
    <div class="container">
        <div class="form-box">
            <a href="http://localhost/Entregable1/index.php" class="volver-btn">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>

             <div class="avatar">
                 <i class="fa-solid fa-user"></i>
             </div>

             <form method="post">
                 <input type="text" name="nombre" placeholder="Nombre" required>
                  <input type="email" name="email" placeholder="Correo" required>
                  <input type="password" name="password" placeholder="Contraseña" required>
                  <button type="submit">Registrarse</button>
             </form>
             <a href="http://localhost/Entregable1/index.php">
                <button type="button" class="volver-btn">Volver</button>
</a>
         </div>
     </div>
</body>
</html>    
