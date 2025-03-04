<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar contraseña

    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$password')";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>

<form method="post">
    <input type="text" name="nombre" placeholder="Nombre" reqired>
    <input type="email" name="email" placeholder="Correo" reqired>
    <input type="password" name="password" placeholder="Contraseña" reqired>
    <button type="submit">Registrarse</button>
</form>    