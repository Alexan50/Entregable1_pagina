<?php 
require_once '../php/db.php';

if (!isset($_GET['id'])) {
    die("Error: No se proporcionó un ID de producto.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows == 0) {
    die("Producto no encontrado.");
}

$producto = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre']; ?></title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;  
            justify-content: center;  
            min-height: 100vh;  
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .volver {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .producto {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            max-width: 800px;
            width: 90%;
            padding: 20px;
        }
        .producto img {
            width: 300px;
            border-radius: 5px;
        }
        .info {
            text-align: left;
        }
        .comprar-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: black;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .recomendaciones {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .recomendacion {
            text-align: center;
            width: 150px;
        }
        .recomendacion img {
            width: 150px; 
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        }
        .recomendacion a {
            display: block;
            text-decoration: none;
            color: black;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="volver">
        <a href="http://localhost/Entregable1/index.php">Volver</a>
    </div>

    <div class="producto">
        <div class="info">
            <h1><?php echo $producto['nombre']; ?></h1>
            <p><?php echo $producto['descripcion']; ?></p>
            <p><strong>Precio: $<?php echo $producto['precio']; ?></strong></p>
            <a class="comprar-btn" href="http://localhost/Entregable1/pago.html?nombre=<?php echo urlencode($producto['nombre']); ?>&precio=<?php echo $producto['precio']; ?>">Comprar</a>
        </div>
        <img src="/Entregable1/imagenes/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
    </div>
    
    <h2>Productos Recomendados</h2>
    <div class="recomendaciones">
    <?php
    $categoria_id = $producto['categoria_id'];
    $sql_recom = "SELECT * FROM productos WHERE categoria_id = $categoria_id AND id != $id LIMIT 3";
    $recomendaciones = $conexion->query($sql_recom);

    while ($recom = $recomendaciones->fetch_assoc()) {
        echo "<div class='recomendacion'>";
        echo "<a href='comprar.php?id=" . $recom['id'] . "'>";
        echo "<img src='/Entregable1/imagenes/" . $recom['imagen'] . "' alt='" . $recom['nombre'] . "'>";
        echo "<span>" . $recom['nombre'] . "</span>";
        echo "</a>";
        echo "</div>";
    }
    ?>
    </div>
</body>
</html>
