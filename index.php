<?php
include 'php/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda de Electrodomésticos</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 0; }
        .header { display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; background-color: #f8f8f8; }
        .logo { font-size: 24px; font-weight: bold; }
        .icons a { text-decoration: none; font-size: 18px; margin-left: 15px; color: black; }
        .container { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 20px; }
        .item { cursor: pointer; text-align: center; }
        .item img { width: 150px; height: auto; }
       
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Bienvenido a Alex.TEC</div>
        <div class="icons">
        <a href="carrito.html">🛒</a>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="perfil.php">👤 <?php echo $_SESSION['nombre']; ?></a>
            <a href="cierre.php">🚪 Cerrar Sesión</a>
        <?php else: ?>
            <a href="login.php">👤 Iniciar Sesión</a>
            <a href="php/registro.php">📝 Registrarse</a>
        <?php endif; ?>           
    </div>
</div>

<h2>Productos Disponibles</h2>

    <div class="container">
    <?php
    $sql = "SELECT * FROM productos";
    $resultado = $conexion->query($sql);

    while ($producto = $resultado->fetch_assoc()) {
        echo "<div class='item' onclick=\"location.href='comprar.php?id=" . $producto['id'] . "'\">
                <img src='imagenes/" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'>
                <h4>" . $producto['nombre'] . "</h4>
                <p>" . $producto['descripcion'] . "</p>
                <p>Precio: $" . $producto['precio'] . "</p>
              </div>";
    }
    ?>
    </div>                           
</body>
</html> 
