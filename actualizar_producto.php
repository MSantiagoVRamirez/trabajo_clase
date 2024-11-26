<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trabajo_clase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if (!isset($_POST['Id_producto'], $_POST['nom_producto'], $_POST['descrip_producto'], $_POST['valor_producto'], $_POST['estadofk'], $_POST['tipo_elemfk'])) {
    die("Faltan datos requeridos.");
}

$Id_producto = intval($_POST['Id_producto']);
$nom_producto = htmlspecialchars($_POST['nom_producto']);
$descrip_producto = htmlspecialchars($_POST['descrip_producto']);
$valor_producto = floatval($_POST['valor_producto']);
$estadofk = intval($_POST['estadofk']);
$tipo_elemfk = intval($_POST['tipo_elemfk']);

$sql = "UPDATE productos SET nom_producto=?, descrip_producto=?, valor_producto=?, estadofk=?, tipo_elemfk=? WHERE Id_producto=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdiii", $nom_producto, $descrip_producto, $valor_producto, $estadofk, $tipo_elemfk, $Id_producto);

if ($stmt->execute()) {
    echo "Producto actualizado correctamente.";
} else {
    echo "Error al actualizar el producto: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
