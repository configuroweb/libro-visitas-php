<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'libro_visitas';
$user = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}

// Validar y sanitizar la entrada
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING);

// Verificar que el nombre y el mensaje no estén vacíos
if (empty($nombre) || empty($mensaje)) {
    echo "El nombre y el mensaje son obligatorios.";
    exit;
}

// Preparar la consulta SQL para insertar la visita
$sql = "INSERT INTO visitas (nombre, mensaje, fecha) VALUES (:nombre, :mensaje, NOW())";
$stmt = $pdo->prepare($sql);

// Vincular los parámetros y ejecutar la consulta
$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);

try {
    $stmt->execute();
    // Redireccionar de vuelta a la página principal
    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error al guardar la visita: " . $e->getMessage();
}
