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
        .search-bar { margin: 20px; }
        .search-bar input { padding: 10px; width: 300px; border: 1px solid #ccc; border-radius: 5px; }
        .search-bar button { padding: 10px 15px; background-color: #1a1a2e; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .search-bar button:hover { background-color: #0d0d1a; }
      
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Bienvenido a Alex.TEC</div>
        <div class="icons">
            <a href="carrito.html">🛒</a>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="php/perfil.php">👤 <?php echo $_SESSION['nombre']; ?></a>
                <a href="cierre.php">🚪 Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php">👤 Iniciar Sesión</a>
                <a href="php/registro.php">📝 Registrarse</a>
            <?php endif; ?>           
        </div>
    </div>


    <form method="GET" class="search-bar">
        <input type="text" name="buscar" placeholder="Buscar productos...">
        <button type="submit"> Buscar</button>
    </form>

    <h2>Productos Disponibles</h2>

    <div class="container">
    <?php

    if (!isset($conexion)) {
        die("<p>Error de conexión con la base de datos.</p>");
    }

   
    $filtro = "";
    if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
        $busqueda = $conexion->real_escape_string($_GET['buscar']);
        $filtro = " WHERE nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%'";
    }

    $sql = "SELECT * FROM productos" . $filtro;
    $resultado = $conexion->query($sql);

    
    if ($resultado && $resultado->num_rows > 0) {
        while ($producto = $resultado->fetch_assoc()) {
            echo "<div class='item' onclick=\"location.href='php/comprar.php?id=" . $producto['id'] . "'\">
                    <img src='imagenes/" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'>
                    <h4>" . $producto['nombre'] . "</h4>
                    <p>" . $producto['descripcion'] . "</p>
                    <p>Precio: $" . $producto['precio'] . "</p>
                  </div>";
        }
    } else {
        echo "<p>No se encontraron productos.</p>";
    }
    ?>
    </div>                           
</body>
</html>
