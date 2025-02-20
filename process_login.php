<?php
session_start();
require 'db.php';

header('Content-Type: application/json');

// Verificar que el token CSRF esté presente y válido
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
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
$username = $_POST['username'];
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username");
    if (!$stmt) {
        echo json_encode(['status' => false, 'message' => 'Error al preparar la consulta.']);
        exit;
    }

    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($user['lock_time'] && new DateTime() < new DateTime($user['lock_time'])) {
            echo json_encode(['status' => false, 'message' => 'Cuenta bloqueada. Intenta de nuevo más tarde.']);
            exit;
        }

        if (password_verify($password, $user['password_hash'])) {
            $stmt = $pdo->prepare("CALL sp_reset_failed_attempts(:username)");
            if (!$stmt) {
                echo json_encode(['status' => false, 'message' => 'Error al preparar la consulta de reset.']);
                exit;
            }

            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            echo json_encode(['status' => true, 'message' => 'Login exitoso.']);
            $_SESSION['user'] = $username;
            session_regenerate_id(true);
        } else {
            $failedAttempts = $user['failed_attempts'] + 1;
            $lockTime = null;

            if ($failedAttempts >= 3) {
                $lockTime = (new DateTime())->modify('+15 minutes')->format('Y-m-d H:i:s');
            }

            $stmt = $pdo->prepare("CALL sp_update_failed_attempts(:username, :failed_attempts, :lock_time)");
            if (!$stmt) {
                echo json_encode(['status' => false, 'message' => 'Error al preparar la consulta de actualización de intentos fallidos.']);
                exit;
            }

            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':failed_attempts', $failedAttempts, PDO::PARAM_INT);
            $stmt->bindParam(':lock_time', $lockTime, PDO::PARAM_STR);
            $stmt->execute();

            echo json_encode(['status' => false, 'message' => 'Nombre de usuario o contraseña incorrectos.']);
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Nombre de usuario o contraseña incorrectos.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()]);
}
?>