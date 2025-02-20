<?php
$host = 'localhost';
$db   = 'secure_login';
$user = 'root'; // Cambiar por el usuario de la base de datos
$pass = '';     // Cambiar por la contraseña de la base de datos

try {
    // Crear una conexión PDO a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    
    // Configurar atributos de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Excepciones en caso de errores
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Recuperar resultados como arrays asociativos
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Desactivar la emulación de preparaciones

} catch (PDOException $e) {
    // Registrar el error en el archivo de log del servidor
    error_log("No se pudo conectar a la base de datos: " . $e->getMessage());

    // Enviar una respuesta de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode([
        'status' => false,
        'message' => 'Error al conectar con la base de datos.'
    ]);

    // Detener la ejecución del script
    exit;
}
?>