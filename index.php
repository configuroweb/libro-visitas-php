<?php
// Conexión a la base de datos (reemplazar con tus propios detalles de conexión)
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

// Recuperar las visitas de la base de datos
$sql = "SELECT nombre, mensaje, DATE_FORMAT(fecha, '%d/%m/%Y %H:%i') AS fecha_formateada FROM visitas ORDER BY fecha DESC";
$visitas = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Visitas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <h1>Libro de Visitas en PHP</h1>
    <form action="guardar_visita.php" method="post">
        <input type="text" name="nombre" placeholder="Tu nombre" required>
        <textarea name="mensaje" placeholder="Tu mensaje" required></textarea>
        <button type="submit">Enviar</button>
    </form>
    <h2>Mensajes Anteriores</h2>
    <?php if ($visitas) : ?>
        <ul>
            <?php foreach ($visitas as $visita) : ?>
                <li>
                    <strong><?= htmlspecialchars($visita['nombre'], ENT_QUOTES, 'UTF-8') ?>:</strong>
                    <?= nl2br(htmlspecialchars($visita['mensaje'], ENT_QUOTES, 'UTF-8')) ?>
                    <em>(<?= $visita['fecha_formateada'] ?>)</em>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No hay mensajes aún.</p>
    <?php endif; ?>
</body>

</html>