<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trabajo_clase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (!isset($_POST['Id_producto'])) {
    die("Falta el ID del producto.");
}

$Id_producto = intval($_POST['Id_producto']);

$sql = "DELETE FROM productos WHERE Id_producto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Id_producto);

if ($stmt->execute()) {
    echo "Producto eliminado correctamente.";
} else {
    echo "Error al eliminar el producto: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
