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
</head>
<body>
    <h1><?php echo $producto['nombre']; ?></h1>
    <img src="/Entregable1/imagenes/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" width="200">


    <p><?php echo $producto['descripcion']; ?></p>
    <p>Precio: $<?php echo $producto['precio']; ?></p>
    
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
    
    <a href="http://localhost/Entregable1/index.php">Volver</a>
</body>
</html>
