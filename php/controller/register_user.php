<?php
session_start();
require '../../db.php';

header('Content-Type: application/json');

// Validar token CSRF
// Verifica que el token CSRF esté presente
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // Responder con un mensaje de error si el token CSRF es inválido
    header('Content-Type: application/json');
    echo json_encode([
        'status' => false,
        'message' => 'Token CSRF inválido.'
    ]);
    exit;
}

// Validar Google reCAPTCHA
$recaptchaSecret = '6Lel0zIqAAAAAFVkbYCI5ERasMGHCtJfJ1E6Rv2X';
$response = $_POST['g-recaptcha-response'];
$remoteIp = $_SERVER['REMOTE_ADDR'];
$recaptchaURL = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$response&remoteip=$remoteIp";

$recaptchaResponse = file_get_contents($recaptchaURL);
if ($recaptchaResponse === FALSE) {
    echo json_encode(['status' => false, 'message' => 'Error de conexión con reCAPTCHA.']);
    exit;
}

$recaptchaData = json_decode($recaptchaResponse);
if (!$recaptchaData->success) {
    echo json_encode(['status' => false, 'message' => 'Verificación reCAPTCHA fallida.']);
    exit;
}

// Obtener datos del formulario
$username = $_POST['registerUsername'];
$email = $_POST['registerEmail'];
$password = $_POST['registerPassword'];

// Verificar si el usuario ya existe
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username OR email = :email");
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(['status' => false, 'message' => 'Nombre de usuario o email ya están en uso.']);
    exit;
}

// Generar hash de contraseña
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

try {
    $stmt = $pdo->prepare("CALL sp_register_user(:username, :email, :password_hash)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password_hash', $passwordHash);
    $stmt->execute();
    echo json_encode(['status' => true, 'message' => 'Registro exitoso.']);
} catch (PDOException $e) {
    echo json_encode(['status' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()]);
}
?>