<?php
// Configuración de conexión a la base de datos
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

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $contraseña = hash("sha256", $_POST['contraseña']); // Encriptar la contraseña con SHA-256
    $estado_id = intval($_POST['estado_id']); // Convertir el estado a entero para mayor seguridad

    // Validar datos básicos
    if (empty($username) || empty($nombres) || empty($apellidos) || empty($_POST['contraseña']) || empty($estado_id)) {
        die("Todos los campos son obligatorios.");
    }

    // Preparar la consulta SQL para evitar inyecciones
    $sql = "INSERT INTO usuarios (username, nombres, apellidos, contraseña, estado_id) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssssi", $username, $nombres, $apellidos, $contraseña, $estado_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
}
?>

