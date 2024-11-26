<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trabajo_clase";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (!isset($_POST['Id_producto'])) {
    die("Falta el ID del producto.");
}

// Convertir a entero el ID para mayor seguridad
$Id_producto = intval($_POST['Id_producto']);

// Consulta SQL preparada
$sql = "SELECT Id_producto, nom_producto, descrip_producto, valor_producto, desc_estado, nom_elemen 
        FROM productos 
        INNER JOIN estado_elemt ON estadofk = Id_estado 
        INNER JOIN tipo_elem ON tipo_elemfk = Id_tipo
        WHERE Id_producto = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $Id_producto);
$stmt->execute();
$result = $stmt->get_result();

// Inicia el HTML dinámico
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"] {
            padding: 8px;
            width: 300px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        button[style="background-color: red;"] {
            background-color: red;
        }
        button[style="background-color: red;"]:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <h2>Detalles del Producto</h2>

    <?php
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
        <!-- Formulario para actualizar el producto -->
        <form action="actualizar_producto.php" method="POST">
            <label for="Id_producto">ID Producto:</label>
            <input type="text" id="Id_producto" name="Id_producto" value="<?php echo htmlspecialchars($row['Id_producto']); ?>" readonly><br>

            <label for="nom_producto">Nombre del Producto:</label>
            <input type="text" id="nom_producto" name="nom_producto" value="<?php echo htmlspecialchars($row['nom_producto']); ?>"><br>

            <label for="descrip_producto">Descripción:</label>
            <input type="text" id="descrip_producto" name="descrip_producto" value="<?php echo htmlspecialchars($row['descrip_producto']); ?>"><br>

            <label for="valor_producto">Valor:</label>
            <input type="text" id="valor_producto" name="valor_producto" value="<?php echo htmlspecialchars($row['valor_producto']); ?>"><br>

            <label for="desc_estado">Estado:</label>
            <input type="text" id="desc_estado" name="desc_estado" value="<?php echo htmlspecialchars($row['desc_estado']); ?>"><br>

            <label for="nom_elemen">Tipo de Elemento:</label>
            <input type="text" id="nom_elemen" name="nom_elemen" value="<?php echo htmlspecialchars($row['nom_elemen']); ?>"><br><br>

            <button type="submit">Actualizar</button>
        </form>

        <!-- Formulario para eliminar el producto -->
        <form action="eliminar_producto.php" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
            <input type="hidden" name="Id_producto" value="<?php echo htmlspecialchars($row['Id_producto']); ?>">
            <button type="submit" style="background-color: red; color: white;">Eliminar Producto</button>
        </form>

        <!-- Botón de Cancelar que redirige al formulario de búsqueda -->
        <form action="index.html" method="GET">
            <button type="submit">Cancelar</button>
        </form>
    <?php
    } else {
        echo "<p>No se encontró el producto.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
